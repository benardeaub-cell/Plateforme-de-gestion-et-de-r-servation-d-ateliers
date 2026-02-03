<?php

namespace workshop_platform\Models;

class CategoriesModel extends Model {
    
    protected $table = 'categories';

    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $query->execute();
        return $query->fetchAll();
    }

    public function find($id) {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_category = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }
}