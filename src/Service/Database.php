<?php

declare(strict_types=1);

// class pour gérer la connection à la base de donnée
namespace App\Service;

use PDO;


 class Database
{
    protected function Connect()
    {
        // Read data array
        $data = require __DIR__ . './connect.php';

         return new PDO('mysql:host=' . $data['host'] . ';dbname=' . $data['dbname'] . $data['port'] . ';charset=utf8',
             $data['username'], $data['password'],
         array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}
