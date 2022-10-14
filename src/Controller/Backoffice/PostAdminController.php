<?php
declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Service\FormValidator\AddPostValidator;
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

    public function  addPostAdminAction(Request $request): Response
    {
        $errors = [];
        $data = $request->getAllRequest();

        if (empty($data['title']) || !is_string($data['title'])) {
            $errors['title'] = "le titre est invalide !";
        }
        if (empty($data['chapo']) || !is_string($data['chapo'])) {
            $errors['chapo'] = "le chapô est invalide !";
        }
        if (empty($data['content']) || !is_string($data['content'])) {
            $errors['content'] = "le contenu ou le contenu est invalide !";
        }
        if ($request->getMethod() === 'POST') {
            if (empty($errors)) {
                $this->postRepository->create($request->getAllRequest(), $this->session->get('user'));
                return new Response($this->view->render([
                    'path'=>'backoffice',
                    'template' => 'addpostlist',
                    'data' => ['user' => $this->session->get('user')],
                    'errors' => $errors,
                    200
                ]));
            }
            $this->session->addFlashes('error', $errors);
        }

        return new Response($this->view->render([
            'path'=>'backoffice',
            'template' => 'addpostlist',
            'errors' => $errors
        ]));
    }
    public function modifyPostAdminAction(Request $request): Response
    {
        $id = $request->getQuery('post');
        $post = $this->postRepository->findOneBy(['id_post' => $id]);
        if ($request->getMethod() === 'POST') {
            $postValidator = new AddPostValidator($request);
            if ($postValidator->isValid()) {
                if($this->postRepository->modifyPost($request->getAllRequest(), $id)) {
                    return new Response($this->view->render([
                        'path'=>'backoffice',
                        'template' => 'modifypost',
                        'data' => ['post' => $post, 'user' => $this->session->get('user')],
                        200
                    ]));
                }
            }
        }
        return new Response($this->view->render([
            'path'=>'backoffice',
            'template' => 'modifypost',
            'data' => ['post' => $post, 'user' => $this->session->get('user')],
        ]));

       
    }

        public function listPostAdminAction()
        {
           
            $posts = $this->postRepository->findAll();
    
            return new Response($this->view->render([
                'path'=>'backoffice',
                'template' => 'postlist',
                'data' => ['posts' => $posts, 'user' => $this->session->get('user')],
            ]));
            // ajouter post / modifier /supprimer
            }
       
                public function deletePostAdminAction()
                {
                   
              
                    
                    }
}