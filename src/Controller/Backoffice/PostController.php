// ajouter post / modifier /supprimer

<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\PostRepository;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Service\Http\Request;


final class AdminController
    {
        public function __construct(private CommentRepository $commentRepository,private PostRepository $postRepository, private View $view, private Session $session )
        {
    
        }
       
    
        public function adminAction(Request $request , ContactFormValidator $contactFormValidator ): Response
        {   


              
          }
      
            return new Response($this->view->render([
                'template' => 'admin',
    
            ]));    
        }
    