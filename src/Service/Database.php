<?php

declare(strict_types=1);

// class pour gérer la connection à la base de donnée
namespace App\Service;

use PDO;


 class Database
  {  
    private $host = 'localhost';
    private $dbname = 'projet_5';
    private $username = 'root';
    private $password = 'root';
    private $port = '8889';

    private function database(){
    try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $port);
  
    echo "Connecté à $dbname sur $host avec succès.";
  
  } 
  
  catch (PDOException $e) 
    {
  die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
    }
  }
}