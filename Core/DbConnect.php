<?php

namespace workshop_platform\Core;

use PDO;
use PDOException;

class DbConnect {
    private static $instance = null;

    private function __construct() {
        // Le constructeur reste privé pour le pattern Singleton
    }

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
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
        return self::$instance;
    }
        private function __clone() {}
}
