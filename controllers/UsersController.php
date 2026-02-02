<?php

namespace workshop_platform\Controllers;


use workshop_platform\Controllers\Controller;
use workshop_platform\Models\UsersModel;
use workshop_platform\Entities\Users;


class UsersController extends Controller {

    public function index() {
        // Méthode qui permet d'afficher la liste des créations
        $users = new UsersModel();

        // On stocke dans une variable le 'return' de la methode findAll()
        $list = $users->findAll();

        $this->render('users/index', ['list' => $list]);
        }

    public function create() {
        // Méthode qui permet d'afficher le formulaire de création
        $this->render('users/create');
    }

    public function store() {
        // Méthode qui permet de stocker les données du formulaire de création
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $user = new Users();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);

            $usersModel = new UsersModel();
            $usersModel->create($user);

            header('Location: index.php?controller=users&action=index');
            exit();
        }
    }

    public function delete() {
        // Méthode qui permet de supprimer un utilisateur
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $usersModel = new UsersModel();
            $usersModel->delete($id);

            header('Location: index.php?controller=users&action=index');
            exit();
        }
    }

    public function edit() {
        // Méthode qui permet d'afficher le formulaire d'édition
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $usersModel = new UsersModel();
            $user = $usersModel->find($id);

            $this->render('users/edit', ['user' => $user]);
        }
    }

    public function update() {
        // Méthode qui permet de mettre à jour les données d'un utilisateur
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $user = new Users();
            $user->setId_user($id);
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);

            $usersModel = new UsersModel();
            $usersModel->update($id, $user);

            header('Location: index.php?controller=users&action=index');
            exit();
        }
    }
}