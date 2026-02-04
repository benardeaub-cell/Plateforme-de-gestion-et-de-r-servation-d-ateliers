<?php

namespace workshop_platform\Controllers;

use workshop_platform\Models\WorkshopsModel;
use workshop_platform\Models\CategoriesModel;
use workshop_platform\Entities\Workshops;

class WorkshopsController extends Controller {
    
    // Méthode pour afficher la liste des workshops 
    public function index() {
        $model = new WorkshopsModel();
        $categoriesModel = new CategoriesModel();
        
        // Récupérer les paramètres de recherche
        $search = $_GET['search'] ?? '';
        $selectedCategory = $_GET['category'] ?? '';
        
        // Appliquer les filtres
        if (!empty($search) || !empty($selectedCategory)) {
            // Vous devrez créer une méthode searchAndFilter dans WorkshopsModel
            $workshops = $model->searchAndFilter($search, $selectedCategory);
        } else {
            $workshops = $model->findAll();
        }
        
        // Récupérer toutes les catégories pour le formulaire
        $categories = $categoriesModel->findAll();
        
        $this->render('workshops/index', compact('workshops', 'categories', 'search', 'selectedCategory'));
    }

    // Méthode pour afficher un workshop spécifique
    public function show() {
        if (isset($_GET['id'])) {
            $model = new WorkshopsModel();
            $workshop = $model->find($_GET['id']);
            $this->render('workshops/show', compact('workshop'));
        }
    }

    // Méthode pour créer un nouveau workshop
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Logique de création
            $workshop = new Workshops();
            $workshop->setTitle($_POST['title']);
            $workshop->setDescription($_POST['description']);
            $workshop->setEventDate($_POST['event_date']);
            $workshop->setTotalPlaces($_POST['total_places']);
            $workshop->setAvailablePlaces($_POST['available_places']);
            $workshop->setIdCategory($_POST['id_category']);
            
            $model = new WorkshopsModel();
            $model->create($workshop);
            header('Location: index.php?controller=workshops&action=index');
        } else {
            $categoriesModel = new CategoriesModel();
            $categories = $categoriesModel->findAll();
            $this->render('workshops/create', compact('categories'));
        }
    }

    // Méthode pour éditer un workshop
    public function edit() {
    $model = new WorkshopsModel();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $workshop = new Workshops();
        $workshop->setTitle($_POST['title']);
        $workshop->setDescription($_POST['description']);
        
        // Convertir le datetime-local en format MySQL
        $eventDate = date('Y-m-d H:i:s', strtotime($_POST['event_date']));
        $workshop->setEventDate($eventDate);
        
        $workshop->setTotalPlaces($_POST['total_places']);
        $workshop->setAvailablePlaces($_POST['available_places']);
        $workshop->setIdCategory($_POST['id_category']);
        
        $model->update($_GET['id'], $workshop);
        header('Location: index.php?controller=workshops&action=index');
        exit;
    } else {
        $workshop = $model->find($_GET['id']);
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->findAll();
        $this->render('workshops/edit', compact('workshop', 'categories'));
    }
    }

    // Méthode pour supprimer un workshop
    public function delete() {
        if (isset($_GET['id'])) {
            $model = new WorkshopsModel();
            $model->delete($_GET['id']);
            header('Location: index.php?controller=workshops&action=index');
            exit;
    }
    }

    // Méthode pour trouver les workshops par catégorie
    public function findByCategory() {
        if (isset($_GET['id'])) {
            $model = new WorkshopsModel();
            $workshops = $model->findByCategory($_GET['id']);
            $this->render('workshops/index', compact('workshops'));
        }
    }
}
       