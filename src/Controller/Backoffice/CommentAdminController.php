<?php
declare(strict_types=1);
        
namespace  App\Controller\Backoffice;

use App\View\View;
use App\Service\Http\Response;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Service\Http\Request;

final class CommentAdminController
{
    public function __construct(private readonly CommentRepository $commentRepository, private readonly View $view)
    {

    }

    public function addCommentAdminAction(): Response
    {
      $comments = $this->commentRepository->create();

      return new Response($this->view->render([
        'path'=>'backoffice',
          'template' => 'commentlist',
             'comments' => $comments,
      ]));
    }

    public function listCommentAction(): Response
    {
      $comments = $this->commentRepository->findAll();

      return new Response($this->view->render([
          'path'=>'backoffice',
          'template' => 'commentlist',
          'data' => ['comments' => $comments],
      ]));
    }

    public function deleteCommentAction(Request $request): Response
    {
        $id = $request->getQuery('comment');
        $this->commentRepository->delete($id);
        $comments = $this->commentRepository->findAll();

        return new Response($this->view->render([
            'path'=>'backoffice',
            'template' => 'commentlist',
            'data' => ['comments' => $comments],
        ]));
    }
}
       