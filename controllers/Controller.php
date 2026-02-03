<?php

namespace workshop_platform\Controllers;

abstract class Controller{
    protected $connection;



protected function render(string $path, array $data=[]){
    
    // Permet d'extraire les données récupérées sous forme de variables 
    extract($data);

    // On créer le buffer de sortie
    ob_start();

    // Crée le chemin et inclut le fichier de la vue souhaitée
    include dirname(__DIR__) . '/Views/' . $path . '.php';

    //On vide le buffer dans les variables $title et $content
    $content = ob_get_clean();

    // On fabrique le "template" 
    include dirname(__DIR__) . '/Views/base.php';
}
protected function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Vous devez être connecté pour accéder à cette page';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
}

protected function requireAdmin() {
    $this->requireAuth();
    if ($_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Accès refusé. Droits administrateur requis.';
        header('Location: index.php?controller=home&action=index');
        exit();
    }
}

}
