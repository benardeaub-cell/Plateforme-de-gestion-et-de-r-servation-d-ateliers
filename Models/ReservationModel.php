<?php

namespace workshop_platform\Models;

use workshop_platform\Entities\Reservations;

class ReservationsModel extends Model {
    
    protected $table = 'reservations';

    public function create($reservation) {
        $query = $this->db->prepare("INSERT INTO {$this->table} (id_user, id_workshop) VALUES (:id_user, :id_workshop)");
        $query->bindValue(':id_user', $reservation->getIdUser());
        $query->bindValue(':id_workshop', $reservation->getIdWorkshop());
        return $query->execute();
    }

    public function findByUser($id_user) {
        $query = $this->db->prepare("
            SELECT r.*, w.title, w.event_date, w.description 
            FROM {$this->table} r
            JOIN workshops w ON r.id_workshop = w.id_workshop
            WHERE r.id_user = :id_user
        ");
        $query->bindValue(':id_user', $id_user);
        $query->execute();
        return $query->fetchAll();
    }

    public function findByWorkshop($id_workshop) {
        $query = $this->db->prepare("
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
        $query = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE id_user = :id_user AND id_workshop = :id_workshop");
        $query->bindValue(':id_user', $id_user);
        $query->bindValue(':id_workshop', $id_workshop);
        $query->execute();
        return $query->fetchColumn() > 0;
    }
}