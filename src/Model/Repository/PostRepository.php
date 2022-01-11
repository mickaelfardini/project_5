<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Post;
use App\Service\Database;
use PDO;

final class PostRepository
{   
    private PDO $databaseConnection;

    public function __construct(Database $database)
    {
        $this->databaseConnection = $database->getPDO();
    }


    public function findOneBy(array $criteria, array $orderBy = null): ?Post
    {
       // $this->database->prepare('select * from post where id=:id_post');
        //$data = $this->database->execute($criteria);
        $data = null;
       return $data === null ? $data : new Post($data['id_post'], $data['title'], $data['content']);
    }

    public function findAll(): ?array
    {
        $postData = [];
        //$this->databaseConnection->getPDO();
        $req = $this->databaseConnection->prepare('SELECT * FROM post ');
        $req->execute();
        $postData = $req->fetchAll();
       
        if (count($postData)  === 0 ) {
            return null;
        }

        
        $posts = [];
        foreach ($postData as $post) {
            $posts[] = new Post((int)$post['id_post'], $post['title'], $post['content']);
        }
        return $posts;
    }
   /*public function getPosts()
    {   $sql ="SELECT * FROM post ORDER BY creation_at "
        $stmt = $this->connect()->query($sql);
        while($row=$stmt->fetch()){
            echo $row ['post'];
        }
     */   

    }
 




