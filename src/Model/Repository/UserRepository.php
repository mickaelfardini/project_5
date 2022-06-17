<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Service\Database;
use App\Model\Entity\User;

final class UserRepository
{
    public function __construct(private Database $database)
    {
        $this->databaseConnection = $database->getPDO();
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        $req=$this->databaseConnection->prepare('select * from user where email=:email');
        $req->execute($criteria);
        $data = $req->fetch();
       
        return $data === null ? null : new user((int)$data['id_user'], $data['username'], $data['email'], $data['password'], $data['user_role']);
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
        $verifyPassword = password_verify($password,$username['password']);

        if (password_needs_rehash($username['password'], $this->encrypt)) {
            $password = password_hash($user['password'], $this->encrypt);
            $req = $this->getDb()->prepare("UPDATE username SET password = :password WHERE id = :id");
            $req->execute(array(':password' => $password, ':id' => $username['id']));
        }

        if ($verifyPassword) {
            return $username;
        }
        
        return false;
    }
    
}
