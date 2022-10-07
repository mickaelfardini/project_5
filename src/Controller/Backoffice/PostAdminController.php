<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\View\View;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\PostRepository;
use App\Service\FormValidator\ModifyPostFormValidator;
use App\Service\FormValidator\AddPostFormValidator;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Service\Http\Request;


final class PostAdminController
{
    public function __construct(private PostRepository $postRepository, private View $view, private Session $session)
    {
    }

    public function  addPostAdminAction(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $AddPostFormValidator = new AddPostFormValidator($request);
            if ($AddPostFormValidator->isValid()) {
                var_dump('votre post est valide'); //creation du post en BDD
            }

            $this->session->addFlashes('error', $AddPostFormValidator->getErrors());
        }
        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'addpostlist',
          //  'data' => ['posts' => $posts],

        ]));
    }
    public function modifyPostAdminAction()
    {

        /*  $ModifyPost = new PostRespository($request);    
            $post = $postRespository-> findOneBy($id);

            if (!$post) {
                throw new Exception('L\'article demandé n\'existe pas !');
            }
            return new Response($this->view->render([
                'template' => 'modifypost',
    
            ]));    */

        $posts = $this->postRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'modifypost',
            'data' => ['posts' => $posts],
        ]));
    }

    public function listPostAdminAction()
    {

        $posts = $this->postRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'postlist',
            'data' => ['posts' => $posts],
        ]));
        // ajouter post / modifier /supprimer
    }

    public function deletePostAdminAction()
    {
    }
}
