<?php

declare(strict_types=1);

// class pour gérer la connection à la base de donnée
namespace App\Service;

use PDO;


 class Database
  {  
    private $dbname = 'projet_5';
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $port = '8889';
    private $pdo;

    public function __construct(string $dbname, string $host, string $username ,string $password, string $port)
    {
      $this->dbname = $dbname;
      $this->host = $host;
      $this->username = $username;
      $this->password = $password;
      $this->port = $port;
    }

    public function getPDO():PDO
    {
      if ($this->pdo === null){
          $this->pdo = $this->pdo = new PDO ("mysql:dbname={$this->dbname};host={$this->host}",$this->username,$this->password,$this->port);
      }
    
    return $this->pdo;
}
}

/* PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
*/