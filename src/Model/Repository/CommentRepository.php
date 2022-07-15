<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Service\Database;
use App\Model\Entity\Comment;
use PDO;

final class CommentRepository
{
    private PDO $databaseConnection;

    public function __construct(private Database $database)
    {
        $this->databaseConnection = $database->getPDO();
    }

    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null): ?array
    {
        $statement = $this->databaseConnection->prepare('SELECT comment.* , user.id_user from comment inner join user ON user.id_user=comment.id_user where id_post=:id_post ');
        $statement->execute($criteria);
        $data = $statement->fetchAll();
        
        if (count($data) === 0) {
            return null;
        }

      
        $comments = [];
        foreach ($data as $comment) {
            $comments[] = new Comment((int)$comment['id_post'], $comment['id_user'], $comment['content'], (int)$comment['id_post']);
        }

        return $comments;
    }


//All comments

    public function findAll(): ?array
    {
        $commentData = [];
        //$this->databaseConnection->getPDO();
        $req = $this->databaseConnection->prepare('SELECT comment.* , user.id_user from comment inner join user ON user.id_user=comment.id_user where id_post=:id_post ');
        $req->execute();
        $commentData = $req->fetchAll();
       
        if (count($commentData)  === 0 ) {
            return null;
        }

        $comments = [];
        foreach ($commentData as $comment) {   
            $comments[] = new Comment((int)$comment['id_post'], $comment['id_user'], $comment['content']);
        }
        return $comments;
    }

    //Ajout d'un commentaire 

    public function create()
    {
        $createComment = [];
        $statement = $this->databaseConnection->prepare('INSERT INTO comment ( content, id_user, id_post , created_at) VALUES ("content","id_user","created_at",NOW())');
        $statement->execute();

        return $createComment ;
    }

    // Suppression d'un commentaire

    public function delete($id_comment)
    {
        $statement = $this->databaseConnection->prepare('DELETE FROM comment WHERE id_comment = ?');
        $commentDelete = $statement->execute(array($id_comment));

        return $commentDelete;
    }

   
}
