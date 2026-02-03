<?php


namespace workshop_platform\Models;

use workshop_platform\Entities\Reservations;

class ReservationsModel extends Model {
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';

    public function __construct() {
        parent::__construct();
    }

    public function create($reservation) {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} (id_user, id_workshop, reservation_date) VALUES (:id_user, :id_workshop, :reservation_date)");
        $query->bindValue(':id_user', $reservation->getUserId());
        $query->bindValue(':id_workshop', $reservation->getWorkshopId());
        $query->bindValue(':reservation_date', $reservation->getReservationDate());
        return $query->execute();
    }

    // Récupérer les réservations d'un utilisateur avec les infos de l'atelier
    public function findByUser($id_user) {
        $query = $this->pdo->prepare("
            SELECT r.*, w.title, w.event_date, w.description 
            FROM {$this->table} r
            JOIN workshops w ON r.id_workshop = w.id_workshop
            WHERE r.id_user = :id_user
            ORDER BY w.event_date DESC
        ");
        $query->bindValue(':id_user', $id_user);
        $query->execute();
        return $query->fetchAll();
    }

    // Récupérer toutes les réservations triées par atelier (pour admin)
    public function findAllWithWorkshop() {
        $query = $this->pdo->prepare("
            SELECT r.*, w.title, w.event_date, w.description, u.name as user_name, u.email as user_email
            FROM {$this->table} r
            JOIN workshops w ON r.id_workshop = w.id_workshop
            JOIN users u ON r.id_user = u.id_user
            ORDER BY w.title ASC, r.reservation_date DESC
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function findByWorkshop($id_workshop) {
        $query = $this->pdo->prepare("
            SELECT r.*, u.name, u.email 
            FROM {$this->table} r
            JOIN users u ON r.id_user = u.id_user
            WHERE r.id_workshop = :id_workshop
        ");
        $query->bindValue(':id_workshop', $id_workshop);
        $query->execute();
        return $query->fetchAll();
    }

    public function checkReservationExists($id_user, $id_workshop) {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->table} WHERE id_user = :id_user AND id_workshop = :id_workshop");
        $query->bindValue(':id_user', $id_user);
        $query->bindValue(':id_workshop', $id_workshop);
        $query->execute();
        return $query->fetchColumn() > 0;
    }

     // Recherche et tri pour admin
    public function searchAndFilter($search = '', $sortBy = 'workshop') {
        $sql = "
            SELECT r.*, w.title, w.event_date, w.description, u.name as user_name, u.email as user_email
            FROM {$this->table} r
            JOIN workshops w ON r.id_workshop = w.id_workshop
            JOIN users u ON r.id_user = u.id_user
            WHERE 1=1
        ";
        
        $params = [];
        
        // Filtre de recherche (nom utilisateur ou titre atelier)
        if (!empty($search)) {
            $sql .= " AND (u.name LIKE :search OR w.title LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
        
        // Tri
        if ($sortBy === 'date') {
            $sql .= " ORDER BY r.reservation_date DESC";
        } elseif ($sortBy === 'event_date') {
            $sql .= " ORDER BY w.event_date ASC";
        } else {
            $sql .= " ORDER BY w.title ASC, r.reservation_date DESC";
        }
        
        $query = $this->pdo->prepare($sql);
        
        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }
        
        $query->execute();
        return $query->fetchAll();
    }
}