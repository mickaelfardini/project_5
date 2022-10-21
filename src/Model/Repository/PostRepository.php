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
       /* $statement = $this->databaseConnection->prepare('select * from post where id=:id_post');
        $this->statement->execute($criteria);*/
        $statement = $this->databaseConnection->prepare('SELECT post.*, user.username FROM post INNER JOIN user ON user.id_user = post.id_user where id_post=:id_post');
        $statement->execute($criteria);
        $data = $statement->fetch();
      
       
        /*$req = $this->databaseConnection->prepare('select * from post where id=:id_post');
        $this->req->execute($criteria);
        var_dump($criteria);
        die;*/

        return !$data ? null : new Post((int)$data['id_post'], $data['title'], $data['chapo'],$data['content'],$data['created_at'],$data['update_at'],$data['id_user'],$data['username']);
    }

    public function findAll(): ?array
    {
        $postData = [];
        //$this->databaseConnection->getPDO();
        $req = $this->databaseConnection->prepare('SELECT post.*, user.username FROM post INNER JOIN user ON user.id_user = post.id_user  ORDER BY created_at DESC ');
        $req->execute();
        $postData = $req->fetchAll();
       
        if (count($postData)  === 0 ) {
            return null;
        }

        
        $posts = [];
        foreach ($postData as $post) {   
            $posts[] = new Post((int)$post['id_post'], $post['title'], $post['chapo'],$post['content'],$post['created_at'],$post['update_at'],$post['id_user'],$post['username']);
        }
        return $posts;
    }
    
    //Ajout d'un post

    public function create(array $post, array $user): bool
    {
        $createPost = [
            'title'     => $post['title'],
            'chapo'     => $post['chapo'],
            'content'   => $post['content'],
            'id_user'   => $user['id_user'],
        ];
        $req = $this->databaseConnection->prepare('INSERT INTO post (title, chapo , created_at,update_at, content , id_user ) VALUES (:title, :chapo, NOW(), NOW(), :content, :id_user)');

        return $req->execute($createPost);
    }

    // Suppression d'un post

    public function delete($id_post, $user): bool
    {
        $data = [
            'id_post' => $id_post,
            'id_user' => $user['id_user']
        ];

        $req = $this->databaseConnection->prepare('DELETE FROM post WHERE id_post = :id_post AND id_user = :id_user');

        return $req->execute($data);
    }

    //Modifier un post 

    public function modifyPost($data, $id, $user): bool
    {
        $modifyPost = [
            'title' => $data['title'],
            'chapo' => $data['chapo'],
            'content' => $data['content'],
            'id_post' => $id,
            'id_user' => $user['id_user']
        ];
        $req = $this->databaseConnection->prepare('UPDATE post SET title = :title, chapo = :chapo, update_at = NOW(), content = :content WHERE id_post = :id_post AND id_user = :id_user');

        return $req->execute($modifyPost);
    }
 
}

