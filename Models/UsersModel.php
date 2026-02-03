<?php

namespace workshop_platform\Models;

class UsersModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    public function __construct() {
        parent::__construct();
    }

    

    public function create($user) {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} (name, email, password, id_role) VALUES (:name, :email, :password, :id_role)");
        $query->bindValue(':name', $user->getName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':id_role', $user->getId_role() ?? 2); // 2 = user par défaut
        return $query->execute();
    }

    public function update($id, $user) {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET name = :name, email = :email, password = :password WHERE id_user = :id");
        $query->bindValue(':name', $user->getName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':id', $id);
        return $query->execute();
    }

    public function find($id) {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_user = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function delete($id) {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_user = :id");
        $query->bindValue(':id', $id);
        return $query->execute();
    }

    public function findByEmail($email) {
        $query = $this->pdo->prepare("
            SELECT u.*, r.label as role_label 
            FROM {$this->table} u
            JOIN roles r ON u.id_role = r.id_role
            WHERE u.email = :email
        ");
        $query->bindValue(':email', $email);
        $query->execute();
        return $query->fetch();
    }
}