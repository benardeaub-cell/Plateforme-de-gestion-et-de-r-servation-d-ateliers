<?php 

namespace workshop_platform\Core;

use PDO;
use Exception;

class DbConnect {

protected $connection;
protected $request;

const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = '';
const BASE = 'workshop_platform';

public function __construct(){

    try {
    $this->connection = new PDO ('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);
    
    //activation des erreurs PDO
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //LEs retours de requêtes seront en tableau objet par defaut
    $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
    //Encodage des caractères spéciaux en 'utf8'
    $this->connection->exec("SET NAMES 'utf8'");
    
    } catch (Exception $e) {
        die('Erreur de connexion à la BDD : ' . $e->getMessage());
    }
    
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
