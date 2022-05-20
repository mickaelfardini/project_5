<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;
use App\Service\Http\Response;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Service\FormValidator\ContactFormValidator;
use App\Service\Http\Request;
final class PostController
{
    public function __construct(private PostRepository $postRepository, private View $view)
    {
    }

    public function displayOneAction(int $id, CommentRepository $commentRepository): Response
    {
        $response = new Response('<h1>faire une redirection vers la page d\'erreur, ce post n\'existe pas</h1><a href="index.php?action=posts">Liste des posts</a><br>', 404);

        $post = $this->postRepository->findOneBy(['id_post' => $id]);
        if ($post !== null) {
            $comments = $commentRepository->findBy(['id_post' => $id]);

            $response = new Response($this->view->render(
                [
                'template' => 'post',
                'data' => [
                    'post' => $post,
                    'comments' => $comments,
                    ],
                ],
            ));
        }

        return $response;
    }

    public function displayAllAction(Request $request): Response
    {   
        if ($request->getMethod()=== 'POST') {
            $CommentFormValidator = new CommentFormValidator($request);    
            if ($CommentFormValidator->isValid()){
                var_dump('valide'); //send mail 
                //  return new Response('<h1>Utilisateur connecté</h1><h2>faire une redirection vers la page d\'accueil</h2><a href="index.php?action=posts">Liste des posts</a><br>', 200);
              }
            
              $this->session->addFlashes('error', $CommentFormValidator->getErrors());

        }
        $posts = $this->postRepository->findAll();

        return new Response($this->view->render([
            'template' => 'posts',
            'data' => ['posts' => $posts],
        ]));
    }
}
