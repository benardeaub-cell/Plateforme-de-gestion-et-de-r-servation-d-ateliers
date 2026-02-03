<?php

namespace workshop_platform\Models;

use workshop_platform\Entities\Users;

class UsersModel extends Model {
    
    protected $table = 'users';

    public function create($user) {
        $query = $this->db->prepare("INSERT INTO {$this->table} (name, email, password, id_role) VALUES (:name, :email, :password, :id_role)");
        $query->bindValue(':name', $user->getName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':id_role', $user->getId_role() ?? 2); // 2 = user par défaut
        return $query->execute();
    }

    public function update($id, $user) {
        $query = $this->db->prepare("UPDATE {$this->table} SET name = :name, email = :email, password = :password WHERE id_user = :id");
        $query->bindValue(':name', $user->getName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':id', $id);
        return $query->execute();
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_user = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id_user = :id");
        $query->bindValue(':id', $id);
        return $query->execute();
    }

    public function findByEmail($email) {
        $query = $this->db->prepare("
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