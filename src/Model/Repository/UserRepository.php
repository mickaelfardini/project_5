<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Service\Database;
use App\Model\Entity\User;

final class UserRepository
{
    public function __construct(private Database $database)
    {
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        $this->pdo->prepare('select * from user where email=:email');
        $data = $this->pdo->execute($criteria);

       
        return $data === null ? null : new user((int)$data['id'], $data['username'], $data['email'], $data['password']);
    }

    //Ajouter un utilisateur

    public function createUser() {
        $newUser = [];
        $req = $this->databaseConnection->prepare('INSERT INTO user( username, email, password ) VALUES ( "username", "email" , "password")');
        $req->execute();
    
        return $createUser;
    }
}
