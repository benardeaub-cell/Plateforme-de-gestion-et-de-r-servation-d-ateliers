<?php

namespace workshop_platform\Controllers;

use workshop_platform\Models\WorkshopsModel;
use workshop_platform\Models\CategoriesModel;
use workshop_platform\Entities\Workshops;

class WorkshopsController extends Controller {
    
    public function index() {
        $model = new WorkshopsModel();
        $workshops = $model->findAll();
        $this->render('workshops/index', compact('workshops'));
    }

    public function show() {
        if (isset($_GET['id'])) {
            $model = new WorkshopsModel();
            $workshop = $model->find($_GET['id']);
            $this->render('workshops/show', compact('workshop'));
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Logique de création
            $workshop = new Workshops();
            $workshop->setTitle($_POST['title']);
            $workshop->setDescription($_POST['description']);
            $workshop->setEventDate($_POST['event_date']);
            $workshop->setTotalPlaces($_POST['total_places']);
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

    public function edit() {
        $model = new WorkshopsModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $workshop = new Workshops();
            $workshop->setTitle($_POST['title']);
            $workshop->setDescription($_POST['description']);
            $workshop->setEventDate($_POST['event_date']);
            $workshop->setTotalPlaces($_POST['total_places']);
            $workshop->setAvailablePlaces($_POST['available_places']);
            $workshop->setIdCategory($_POST['id_category']);
            
            $model->update($_GET['id'], $workshop);
            header('Location: index.php?controller=workshops&action=index');
        } else {
            $workshop = $model->find($_GET['id']);
            $categoriesModel = new CategoriesModel();
            $categories = $categoriesModel->findAll();
            $this->render('workshops/edit', compact('workshop', 'categories'));
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $model = new WorkshopsModel();
            $model->delete($_GET['id']);
            header('Location: index.php?controller=workshops&action=index');
        }
    }
}
       