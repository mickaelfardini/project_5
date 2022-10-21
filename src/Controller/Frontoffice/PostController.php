<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\Service\FormValidator\AddPostFormValidator;
use App\Service\Http\Session\Session;
use App\View\View;
use App\Service\Http\Response;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Service\FormValidator\ContactFormValidator;
use App\Service\Http\Request;
use Symfony\Component\Routing\Annotation\Route;

final class PostController
{
    public function __construct(private PostRepository $postRepository, private View $view, private Session $session)
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
                'path'=>'frontoffice',
                'template' => 'post',
                'data' => [
                    'post' => $post,
                    'comments' => $comments,
                    'user' => $this->session->get('user')
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
            'path'=>'frontoffice',
            'template' => 'posts',
            'data' => ['posts' => $posts, 'user' => $this->session->get('user')],
        ]));
    }

    public function createAction(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $postFormValidator = new AddPostFormValidator($request);
            if ($postFormValidator->isValid()){
                $postRepository = $this->postRepository->create($request->getAllRequest(), $this->session->get('user'));
            }
            $this->session->addFlashes('error', $postFormValidator->getErrors());
        }

        $posts = $this->postRepository->findAll();

        return new Response($this->view->render([
            'path'=>'frontoffice',
            'template' => 'posts',
            'data' => ['posts' => $posts, 'user' => $this->session->get('user')],
        ]));
    }

    public function editAction(CommentRepository $commentRepository, Request $request): Response
    {
        $post = $this->postRepository->findOneBy(['id_post' => $request->getQuery('id_post')]);
        if ($post !== null) {
            if ($request->getMethod() === 'POST') {
                $postFormValidator = new AddPostFormValidator($request);
                if ($postFormValidator->isValid()){
                    $this->postRepository->modifyPost($request->getAllRequest(), $request->getQuery('id_post'), $this->session->get('user'));
                }
                $this->session->addFlashes('error', $postFormValidator->getErrors());
            }

            $comments = $commentRepository->findBy(['id_post' => $request->getQuery('id_post')]);

            return new Response($this->view->render(
                [
                    'path'=>'frontoffice',
                    'template' => 'post',
                    'data' => [
                        'post' => $post,
                        'comments' => $comments,
                        'user' => $this->session->get('user')
                    ],
                ],
            ));
        }

        return new Response('<h1>faire une redirection vers la page d\'erreur, ce post n\'existe pas</h1><a href="index.php?action=posts">Liste des posts</a><br>', 404);
    }

    public function deleteAction(Request $request): Response
    {
        $post = $this->postRepository->findOneBy(['id_post' => $request->getQuery('id_post')]);
        if ($post !== null) {
            if ($request->getMethod() === 'DELETE') {
                $this->postRepository->delete($request->getQuery('id_post'), $this->session->get('user'));
            }

            $posts = $this->postRepository->findAll();

            return new Response($this->view->render([
                'path'=>'frontoffice',
                'template' => 'posts',
                'data' => ['posts' => $posts, 'user' => $this->session->get('user')],
            ]));
        }

        return new Response('<h1>faire une redirection vers la page d\'erreur, ce post n\'existe pas</h1><a href="index.php?action=posts">Liste des posts</a><br>', 404);
    }
}
