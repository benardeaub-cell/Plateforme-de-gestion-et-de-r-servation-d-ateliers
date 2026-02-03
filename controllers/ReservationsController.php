<?php

namespace workshop_platform\Controllers;

use workshop_platform\Controllers\Controller;
use workshop_platform\Models\ReservationsModel;
use workshop_platform\Models\WorkshopsModel;
use workshop_platform\Entities\Reservations;

class ReservationsController extends Controller {

    // Afficher toutes les réservations (admin) ou mes réservations (user)
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $reservationsModel = new ReservationsModel();
        
        // Si admin (id_role = 3) : voir toutes les réservations avec filtres
        if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3) {
            $search = $_GET['search'] ?? '';
            $sortBy = $_GET['sort'] ?? 'workshop';
            
            $reservations = $reservationsModel->searchAndFilter($search, $sortBy);
        } else {
            // Si user : voir uniquement ses réservations
            $reservations = $reservationsModel->findByUser($_SESSION['user_id']);
        }
        
        $this->render('reservations/index', [
            'title' => 'Mes réservations',
            'reservations' => $reservations,
            'search' => $search ?? '',
            'sortBy' => $sortBy ?? 'workshop'
        ]);
    }

    // Afficher le formulaire d'inscription à un atelier
    public function register() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $workshop_id = $_GET['workshop_id'] ?? null;
        
        if (!$workshop_id) {
            header('Location: index.php?controller=workshops&action=index');
            exit();
        }

        // Vérifier si l'utilisateur est déjà inscrit
        $reservationsModel = new ReservationsModel();
        if ($reservationsModel->checkReservationExists($_SESSION['user_id'], $workshop_id)) {
            $_SESSION['error'] = 'Vous êtes déjà inscrit à cet atelier';
            header('Location: index.php?controller=workshops&action=index');
            exit();
        }

        // Récupérer les détails de l'atelier
        $workshopsModel = new WorkshopsModel();
        $workshop = $workshopsModel->find($workshop_id);

        if (!$workshop || $workshop['available_places'] <= 0) {
            $_SESSION['error'] = 'Atelier non disponible';
            header('Location: index.php?controller=workshops&action=index');
            exit();
        }

        $this->render('reservations/register', [
            'title' => 'Inscription à l\'atelier',
            'workshop' => $workshop
        ]);
    }

    // Créer une nouvelle réservation
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $workshop_id = $_POST['workshop_id'] ?? null;
            $user_id = $_SESSION['user_id'];

            if (!$workshop_id) {
                $_SESSION['error'] = 'Atelier invalide';
                header('Location: index.php?controller=workshops&action=index');
                exit();
            }

            // Vérifier si déjà inscrit
            $reservationsModel = new ReservationsModel();
            if ($reservationsModel->checkReservationExists($user_id, $workshop_id)) {
                $_SESSION['error'] = 'Vous êtes déjà inscrit à cet atelier';
                header('Location: index.php?controller=workshops&action=index');
                exit();
            }

            // Créer la réservation
            $reservation = new Reservations();
            $reservation->setUserId($user_id);
            $reservation->setWorkshopId($workshop_id);
            $reservation->setReservationDate(date('Y-m-d H:i:s'));

            if ($reservationsModel->create($reservation)) {
                // Décrémenter les places disponibles
                $workshopsModel = new WorkshopsModel();
                $workshopsModel->decrementAvailablePlaces($workshop_id);

                $_SESSION['success'] = 'Inscription réussie !';
            } else {
                $_SESSION['error'] = 'Erreur lors de l\'inscription';
            }

            header('Location: index.php?controller=reservations&action=index');
            exit();
        }

        header('Location: index.php?controller=workshops&action=index');
        exit();
    }

    // Afficher les détails d'une réservation
    public function show() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=reservations&action=index');
            exit();
        }

        $reservationsModel = new ReservationsModel();
        $reservation = $reservationsModel->find($id);

        if (!$reservation) {
            header('Location: index.php?controller=reservations&action=index');
            exit();
        }

        // Vérifier l'autorisation : propriétaire ou admin (id_role = 3)
        if ($reservation['id_user'] != $_SESSION['user_id'] && ($_SESSION['id_role'] ?? 0) != 3) {
            header('Location: index.php?controller=reservations&action=index');
            exit();
        }

        // Récupérer les infos de l'atelier lié
        $workshopsModel = new WorkshopsModel();
        $workshop = $workshopsModel->find($reservation['id_workshop']);

        $this->render('reservations/show', [
            'title' => 'Détails de la réservation',
            'reservation' => $reservation,
            'workshop' => $workshop
        ]);
    }

    // Annuler une réservation
    public function cancel() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $reservationsModel = new ReservationsModel();
            $reservation = $reservationsModel->find($id);

            // Vérifier que c'est bien sa réservation ou que c'est un admin
            if ($reservation && ($reservation['id_user'] == $_SESSION['user_id'] || $_SESSION['id_role'] == 3)) {
                // Incrémenter les places disponibles
                $workshopsModel = new WorkshopsModel();
                $workshopsModel->incrementAvailablePlaces($reservation['id_workshop']);

                // Supprimer la réservation
                $reservationsModel->delete($id);
                $_SESSION['success'] = 'Réservation annulée';
            } else {
                $_SESSION['error'] = 'Action non autorisée';
            }
        }

        header('Location: index.php?controller=reservations&action=index');
        exit();
    }
}