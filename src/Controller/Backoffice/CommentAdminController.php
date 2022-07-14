// 2 soluce : tous comment non validé $
            : 2 page une avec liste 



			// ajouter post / modifier /supprimer
        <?php

        declare(strict_types=1);
        
        namespace  App\Controller\Frontoffice;
        
        use App\View\View;
        use App\Service\Http\Response;
        use App\Model\Repository\PostRepository;
        use App\Model\Repository\CommentRepository;
        use App\Service\FormValidator\ContactFormValidator;
        use App\Service\Http\Request;

        final class CommentController
        
           { public function __construct(private PostRepository $postRepository, private View $view)
            {
            }
        
            public function AddCommentAction(int $id, CommentRepository $commentRepository): Response
            {
                {   
                   $addcomment = new Comment([
                    
                    'createdAt' => date ('y-m-d')
                    'post_id' => $id,
                    'isvalid' => 0
                   ])
               
                }
            }
            public function commentAdminAction()
            {
               var_dump("comment");
               die;
        
                // ajouter post / modifier /supprimer
                }
    }
        
         
       