<?php

declare(strict_types=1);

// class pour gérer la connection à la base de donnée
namespace App\Service;

use PDO;


class Database
{
  private string $dbname = 'projet_5';
  private string $host = 'localhost';
  private string $username = 'fx';
  private string $password = 'QaaUB1PWRs386Q9v';
  private string $port = '3306';
  private PDO $pdo;

  public function __construct()
//      private string $dbname, private string $host, private string $username, private string $password, private int $port)

  {
    //$this->dbname = $dbname;
    //$this->host = $host;
    //$this->username = $username;
    //$this->password = $password;
    //$this->port = $port;
    try {
     // $this->pdo = new PDO("mysql:host={$this->host},dbname={$this->dbname};chartset=utf8", $this->username, $this->password);
     $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
    } catch (\Exception $e) {
      var_dump('error');
      throw $e;
    }
  }

  public function getPDO(): PDO
  {

    return $this->pdo;
  }
}

/* PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
*/

