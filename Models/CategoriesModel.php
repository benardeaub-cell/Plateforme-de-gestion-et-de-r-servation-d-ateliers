<?php

namespace workshop_platform\Models;

class CategoriesModel extends Model {
    protected $table = 'categories';
    protected $primaryKey = 'id_category';

    public function __construct() {
        parent::__construct();
    }

    public function create($category) {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} (name) VALUES (:name)");
        $query->bindValue(':name', $category->getName());
        return $query->execute();
    }
    public function update($id, $category) {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name WHERE id_category = :id");
        $query->bindValue(':name', $category->getName());
        $query->bindValue(':id', $id);
        return $query->execute();
    }

    public function find($id) {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_category = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function delete($id) {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_category = :id");
        $query->bindValue(':id', $id);
        return $query->execute();
    }

    public function findByCategory(int $id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM workshops WHERE id_category = :id ORDER BY id_workshop');
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}