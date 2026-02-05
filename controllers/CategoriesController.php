<?php 

namespace workshop_platform\Controllers;

use workshop_platform\Controllers\Controller;
use workshop_platform\Models\CategoriesModel;

class CategoriesController extends Controller {

    // Afficher la liste des catégories
    public function index() {
        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->findAll();

        $this->render('categories/index', [
            'title' => 'Liste des Catégories',
            'list' => $categories
        ]);
    }

    // Afficher une catégorie spécifique
    public function show() {
        if (isset($_GET['id'])) {
            $categoriesModel = new CategoriesModel();
            $categoryData = $categoriesModel->find($_GET['id']);

            if ($categoryData) {
                $category = new \workshop_platform\Entities\Categories();
                $category->setid_category($categoryData['id_category']);
                $category->setName($categoryData['name']);

                $this->render('categories/show', [
                    'title' => 'Détails de la Catégorie',
                    'category' => $category
                ]);
            }
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new \workshop_platform\Entities\Categories();
            $category->setName($_POST['name']);
            
            

            $categoriesModel = new CategoriesModel();
            $categoriesModel->create($category);

            header('Location: index.php?controller=categories&action=index');
        } else {
            $this->render('categories/create', [
                'title' => 'Ajouter une Catégorie'
            ]);
        }
    }

    public function edit() {
        $categoriesModel = new CategoriesModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new \workshop_platform\Entities\Categories();
            $category->setName($_POST['name']);
            

            $categoriesModel->update($_GET['id'], $category);

            header('Location: index.php?controller=categories&action=index');
        } else {
            $categoryData = $categoriesModel->find($_GET['id']);

            if ($categoryData) {
                $category = new \workshop_platform\Entities\Categories();
                $category->setid_category($categoryData['id_category']);
                $category->setName($categoryData['name']);

                $this->render('categories/edit', [
                    'title' => 'Modifier la Catégorie',
                    'category' => $category
                ]);
            }
        }
    }

    public function delete() {
        $categoriesModel = new CategoriesModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriesModel->delete($_GET['id']);
            header('Location: index.php?controller=categories&action=index');
        } else {
            $categoryData = $categoriesModel->find($_GET['id']);

            if ($categoryData) {
                $category = new \workshop_platform\Entities\Categories();
                $category->setid_category($categoryData['id_category']);
                $category->setName($categoryData['name']);

                $this->render('categories/delete', [
                    'title' => 'Supprimer la Catégorie',
                    'category' => $category
                ]);
            }
        }
    }

    public function list() {
        $categoriesModel = new CategoriesModel();
        return $categoriesModel->findAll();
    }

    

}