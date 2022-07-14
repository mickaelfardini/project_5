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
        
            public function listCommentAdminAction()
            {
               {
                  $comments = $this->commentRepository->findAll();
          
                  return new Response($this->view->render([
                      'template' => 'commentlist',
                         'comments' => $comments,
                  ]));
                  }
                    // 2 soluce : tous comment non validé $
           // : 2 page une avec liste 


            // ajouter post / modifier /supprimer
                }
    }
        
         
       