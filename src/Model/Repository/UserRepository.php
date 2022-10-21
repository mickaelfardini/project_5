<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Service\Database;
use App\Model\Entity\User;
use PDO;

final class UserRepository
{
    private PDO $databaseConnection;

    public function __construct(private Database $database)
    {
        $this->databaseConnection = $database->getPDO();
    }

    public function findAll(): ?array
    {
        $req=$this->databaseConnection->prepare('select * from user');
        $req->execute();

        return $req->fetchAll();
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        $req=$this->databaseConnection->prepare('select * from user where email=:email');
        $req->execute($criteria);
        $data = $req->fetch();

        return !$data ? null : new user((int)$data['id_user'], $data['username'], $data['email'], $data['password'], $data['user_role']);
    }

    //Ajouter un utilisateur

    public function createUser($data): bool
    {
        $vars = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data["password"], PASSWORD_BCRYPT),
        ];
        $req = $this->databaseConnection->prepare("INSERT INTO user( username, email, password ) VALUES (:username, :email, :password)");

    
        return $req->execute($vars);
    }

    public function editUser($data, $id, $user): bool
    {
        $vars = [
            'username' => $data['username'],
            'email' => $data['email'],
            'id_user' => $user['id_user']
        ];
        if ($id === $user['id_user']) {
            $req = $this->databaseConnection->prepare('UPDATE user SET username = :username, email = :email WHERE id_user = :id_user');

            return $req->execute($vars);
        }

        return false;
    }

    //Vérification utilisateur existant??? 
    public function login ($data): mixed
    {
        $req = $this->databaseConnection->prepare('SELECT * FROM user WHERE username=:username LIMIT 1');
        $req->execute(array(':username'=> $data['username']));
        $userFound = $req->fetch(PDO::FETCH_ASSOC);
        $verifyPassword = password_verify($data['password'], $userFound['password']);

//        if (password_needs_rehash($username['password'], $this->encrypt)) {
//            $password = password_hash($user['password'], $this->encrypt);
//            $req = $this->getDb()->prepare("UPDATE username SET password = :password WHERE id = :id");
//            $req->execute(array(':password' => $password, ':id' => $username['id']));
//        }

        if ($verifyPassword) {
            return $userFound;
        }
        
        return false;
    }

    public function delete($id_user): bool
    {
        $statement = $this->databaseConnection->prepare('DELETE FROM user WHERE id_user = ?');
        return $statement->execute(array($id_user));
    }
    
}