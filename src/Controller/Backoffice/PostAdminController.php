<?php
declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\View\View;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\PostRepository;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Service\Http\Request;


final class PostAdminController
    {
        public function __construct(private PostRepository $postRepository, private View $view, private Session $session )
        {
    
        }
    
        public function addPost($username, $title, $chapo, $content)
        {
            $errors = [];
    
            if (empty($username) || !is_string($username)) {
                $errors['username'] = "username est invalide !";
            }
            if (empty($title) || !is_string($title)) {
                $errors['title'] = "le titre est invalide !";
            }
            if (empty($chapo) || !is_string($chapo)) {
                $errors['chapo'] = "le chapô est invalide !";
            }
            if (empty($content) || !is_string($content)) {
                $errors['content'] = "le contenu ou le contenu est invalide !";
            }
               
      
            return new Response($this->view->render([
                'template' => 'admin',
    
            ]));    

    }
    public function modifyPost($id)
    {
       
            $ModifyPost = new PostRespository($request);    
            $post = $postRespository-> findOneBy($id);

            if (!$post) {
                throw new Exception('L\'article demandé n\'existe pas !');
            }
            return new Response($this->view->render([
                'template' => 'postlist',
    
            ]));    

        // ajouter post / modifier /supprimer
        }
        public function listPostAdminAction()
        {
           
            $posts = $this->postRepository->findAll();
    
            return new Response($this->view->render([
                'template' => 'postlist',
                'data' => ['posts' => $posts],
            ]));
            // ajouter post / modifier /supprimer
            }
}