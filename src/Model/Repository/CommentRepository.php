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
        $statement = $this->databaseConnection->prepare('select * from comment where id_post=:id_post');
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

    public function create(object $comment): bool
    {
     
        return false ;
    }
}
