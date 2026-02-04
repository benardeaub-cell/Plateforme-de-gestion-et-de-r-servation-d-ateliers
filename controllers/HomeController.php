<?php

namespace workshop_platform\Controllers;

use workshop_platform\Controllers\Controller;

class HomeController extends Controller {

    public function index() {
    $workshopsModel = new \workshop_platform\Models\WorkshopsModel();
    $upcomingWorkshops = $workshopsModel->findUpcoming(5); // ajuster le nombre si besoin
    $this->render('home/index', compact('upcomingWorkshops'));
}
}
