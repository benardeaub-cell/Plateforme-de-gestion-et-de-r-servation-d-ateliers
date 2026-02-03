<?php 

namespace workshop_platform\Entities;

class Categories {
    private $id_category;
    private $name;
    private $description;
    private $created_at;
    public function __construct($id_category, $name, $description, $created_at) {
        $this->id_category = $id_category;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at;
    }

    public function getIdCategory() {
        return $this->id_category;
    }

    public function setIdCategory($id_category) {
        $this->id_category = $id_category;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
}