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
            public function __construct(private CommentRepository $commentRepository, private View $view)
            {
            }
        
           
                public function addCommentAdminAction( )
                {
                   {
                      $comments = $this->commentRepository->create();
              
                      return new Response($this->view->render([
                        'path'=>'backoffice',
                          'template' => 'commentlist',
                             'comments' => $comments,
                      ]));
                      }
    }
        
           }
       