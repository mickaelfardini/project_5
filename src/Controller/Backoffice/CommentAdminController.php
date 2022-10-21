<?php
declare(strict_types=1);
        
namespace  App\Controller\Backoffice;

use App\Service\Http\Session\Session;
use App\View\View;
use App\Service\Http\Response;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Service\Http\Request;

final class CommentAdminController
{
    public function __construct(private CommentRepository $commentRepository, private View $view, private Session $session)
    {

    }

    public function listAction(): Response
    {
        $comments = $this->commentRepository->findAll();

        return new Response($this->view->render([
            'path'=>'backoffice',
            'template' => 'commentlist',
            'data' => ['comments' => $comments],
        ]));
    }

    public function addAction(Request $request): Response
    {
        $comments = $this->commentRepository->create($request->getAllRequest(), $this->session->get('user'));

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'commentlist',
            'comments' => $comments,
            ]));
    }

    public function validateAction(Request $request): Response
    {
        $this->commentRepository->validate($request->getQuery('comment'));

        $comments = $this->commentRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'commentlist',
            'data' => ['comments' => $comments],
            ]));
    }

    public function deleteAction(Request $request): Response
    {
        $id = $request->getQuery('comment');
        $this->commentRepository->delete($id);
        $comments = $this->commentRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'commentlist',
            'data' => ['comments' => $comments],
        ]));
    }
}
       