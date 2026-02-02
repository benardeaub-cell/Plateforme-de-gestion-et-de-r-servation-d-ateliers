<?php

namespace workshop_platform\Models;

use workshop_platform\Core\DbConnect;

abstract class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = DbConnect::getConnection();
    }

    public function findAll() {
        $query = $this->db->query("SELECT * FROM {$this->table}");
        return $query->fetchAll();
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->bindValue(':id', $id);
        return $query->execute();
    }
}