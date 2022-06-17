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
       // hachage password ???
        $req = $this->databaseConnection->prepare('INSERT INTO user( username, email, password ) VALUES ( "username", "email" , "password")');
        $req->execute();
    
        return $createUser;
    }
    //Vérification utilisateur existant??? 
    public function login ($username, $password){
        $req = $this->databaseConnection->prepare('SELECT * FROM user WHERE username=:username LIMIT 1');
        $req->execute(array(':username'=> $username));
        $userFound = $req->fetch(PDO::FETCH_ASSOC);

        if (password_needs_rehash($user['password'], $this->encrypt)) {
            $password = password_hash($user['password'], $this->encrypt);
            $req = $this->getDb()->prepare("UPDATE user SET password = :password WHERE id = :id");
            $req->execute(array(':password' => $password, ':id' => $user['id']));
        }

        if ($checkPassword) {
            return $user;
        }
        
        return false;
    }
    
}
