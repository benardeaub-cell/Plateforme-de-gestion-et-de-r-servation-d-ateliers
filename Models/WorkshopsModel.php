<?php

namespace workshop_platform\Models;

use workshop_platform\Entities\Workshops;

class WorkshopsModel extends Model {
    protected $table = 'workshops';
    protected $primaryKey = 'id_workshop';

    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $query = $this->pdo->prepare("
            SELECT w.*, c.name as category_name 
            FROM {$this->table} w
            LEFT JOIN categories c ON w.id_category = c.id_category
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function findByCategory($id_category) {
        $query = $this->pdo->prepare("
            SELECT w.*, c.name as category_name 
            FROM {$this->table} w
            LEFT JOIN categories c ON w.id_category = c.id_category
            WHERE w.id_category = :id_category
        ");
        $query->bindValue(':id_category', $id_category);
        $query->execute();
        return $query->fetchAll();
    }

    public function create($workshop) {
        $query = $this->pdo->prepare("
            INSERT INTO {$this->table} (title, description, event_date, total_places, available_places, id_category) 
            VALUES (:title, :description, :event_date, :total_places, :available_places, :id_category)
        ");
        $query->bindValue(':title', $workshop->getTitle());
        $query->bindValue(':description', $workshop->getDescription());
        $query->bindValue(':event_date', $workshop->getEventDate());
        $query->bindValue(':total_places', $workshop->getTotalPlaces());
        $query->bindValue(':available_places', $workshop->getTotalPlaces()); // Initialement égal au total
        $query->bindValue(':id_category', $workshop->getIdCategory());
        return $query->execute();
    }

    public function update($id, $workshop) {
        $query = $this->pdo->prepare("
            UPDATE {$this->table} 
            SET title = :title, description = :description, event_date = :event_date, 
                total_places = :total_places, available_places = :available_places, id_category = :id_category 
            WHERE id_workshop = :id
        ");
        $query->bindValue(':title', $workshop->getTitle());
        $query->bindValue(':description', $workshop->getDescription());
        $query->bindValue(':event_date', $workshop->getEventDate());
        $query->bindValue(':total_places', $workshop->getTotalPlaces());
        $query->bindValue(':available_places', $workshop->getAvailablePlaces());
        $query->bindValue(':id_category', $workshop->getIdCategory());
        $query->bindValue(':id', $id);
        return $query->execute();
    }
    public function decrementAvailablePlaces($id_workshop) {    
        $sql = "UPDATE {$this->table} SET available_places = available_places - 1 WHERE {$this->primaryKey} = :id AND available_places > 0";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id_workshop);
        return $query->execute();
    }

    public function incrementAvailablePlaces($id_workshop) {
        $sql = "UPDATE {$this->table} SET available_places = available_places + 1 WHERE {$this->primaryKey} = :id AND available_places < total_places";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id_workshop);
        return $query->execute();
    }
}