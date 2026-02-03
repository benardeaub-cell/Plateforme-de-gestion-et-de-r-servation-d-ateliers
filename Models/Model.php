<?php

namespace workshop_platform\Models;

use workshop_platform\Core\Db;

abstract class Model extends Db {
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {
        parent::__construct(); // Appelle Db::__construct() qui initialise $this->pdo
    }

    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->pdo->query($sql);
        return $query->fetchAll();
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id);
        return $query->execute();
    }
}