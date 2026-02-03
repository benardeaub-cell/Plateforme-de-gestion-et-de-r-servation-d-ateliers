<?php


namespace workshop_platform\Controllers;

use workshop_platform\Models\UsersModel;
use workshop_platform\Entities\Users;



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
                
                // DEBUG temporaire - vérifier ce qui est récupéré
                // echo "<pre>";
                // var_dump($user);
                // echo "</pre>";
                // echo "id_Role stocké dans session : " . $_SESSION['id_role'];
                // exit(); // SUPPRIMER APRÈS DEBUG

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $user = new Users();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setId_role(2); // 2 = user

            $usersModel = new UsersModel();
            $usersModel->create($user);

            header('Location: index.php?controller=auth&action=login');
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=home&action=index');
        exit();
    }
}
