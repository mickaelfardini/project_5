<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Post;
use App\Service\Database;

final class PostRepository
{
    public function __construct(private Database $database)
    {
    }



    public function findOneBy(array $criteria, array $orderBy = null): ?Post
    {
       // $this->database->prepare('select * from post where id=:id_post');
        //$data = $this->database->execute($criteria);
        $data = null;
       return $data === null ? $data : new Post($data['id_post'], $data['title'], $data['content']);
    }

    public function findAll(): ?array
    {  var_dump($this->database->getPDO());
        //$this->database->prepare('select * from post');
        //$data = $this->database->execute();
        $data = null;
        if ($data === null) {
            return null;
        }

        
        $posts = [];
        foreach ($data as $post) {
            $posts[] = new Post((int)$post['id_post'], $post['title'], $post['content']);
        }

        return $post;
    }
}



