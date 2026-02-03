<?php

namespace workshop_platform\Core;

use PDO;
use PDOException;

class Db {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=workshop_platform;charset=utf8',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }
}