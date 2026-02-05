<?php


namespace workshop_platform\Controllers;

use workshop_platform\Models\UsersModel;
use workshop_platform\Entities\Users;
use workshop_platform\Controllers\Controller;





    class AuthController extends Controller {

        public function login() {
            $this->render('auth/login', ['title' => 'Connexion']);
        }

        public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usersModel = new UsersModel();
            $user = $usersModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['label'];
                $_SESSION['id_role'] = $user['id_role']; // ATTENTION : Respecter la casse de votre BDD
                

                header('Location: index.php?controller=home&action=index');
                exit();
            } else {
                $_SESSION['error'] = 'Email ou mot de passe incorrect';
                header('Location: index.php?controller=auth&action=login');
                exit();
            }
            
        }
    }

    public function register() {
        $this->render('auth/register', ['title' => 'Inscription']);
    }
     public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=auth&action=register');
            exit();
        }

        if (session_status() === PHP_SESSION_NONE) session_start();

        $name = trim($_POST['name'] ?? '');
        $emailRaw = trim($_POST['email'] ?? '');
        $passwordRaw = $_POST['password'] ?? '';

        $errors = [];

        // CSRF check (si token présent)
        if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf'])) {
            $errors['general'] = 'Requête invalide (csrf).';
        }

        // Validation basique
        if ($name === '' || mb_strlen($name) < 2 || mb_strlen($name) > 30) {
            $errors['name'] = 'Nom requis (2 à 30 caractères).';
        }

        if ($emailRaw === '' || !filter_var($emailRaw, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide.';
        } else {
            $usersModel = new UsersModel();
            if ($usersModel->findByEmail($emailRaw)) {
                $errors['email'] = 'Cet email est déjà utilisé.';
            }
        }

        if ($passwordRaw === '' || mb_strlen($passwordRaw) < 6) {
            $errors['password'] = 'Mot de passe trop court (min 6 caractères).';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['name' => $name, 'email' => $emailRaw];
            header('Location: index.php?controller=auth&action=register');
            exit();
        }

        $password = password_hash($passwordRaw, PASSWORD_BCRYPT);

        $user = new Users();
        $user->setName($name);
        $user->setEmail($emailRaw);
        $user->setPassword($password);
        $user->setId_role(2);

        try {
            $usersModel->create($user);
            $_SESSION['success'] = 'Compte créé avec succès. Vous pouvez vous connecter.';
            header('Location: index.php?controller=auth&action=login');
            exit();
        } catch (\Exception $e) {
            // log($e) en production
            $_SESSION['errors'] = ['general' => 'Erreur serveur, réessayez plus tard.'];
            $_SESSION['old'] = ['name' => $name, 'email' => $emailRaw];
            header('Location: index.php?controller=auth&action=register');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=home&action=index');
        exit();
    }

    


    
    
}
