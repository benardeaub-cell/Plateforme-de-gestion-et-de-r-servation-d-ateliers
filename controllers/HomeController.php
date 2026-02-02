<?php

namespace workshop_platform\Controllers;

use workshop_platform\Controllers\Controller;

class HomeController extends Controller {

    public function index() {
        // Affiche la page d'accueil
        $this->render('home/index', [
            'title' => 'Bienvenue'
        ]);
    }
}
