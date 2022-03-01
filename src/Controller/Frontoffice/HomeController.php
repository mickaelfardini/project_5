<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;
use App\Service\Http\Response;
use App\Service\FormValidator\ContactFormValidator;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Service\Http\Request;

final class HomeController
{
    public function __construct(private PostRepository $postRepository, private View $view)
    {

    }
   

    public function homeAction(Request $request , ContactFormValidator $contactFormValidator ): Response
    {  
         if ($request->getMethod()=== 'POST') {
          if ($contactFormValidator->isValid()){
                var_dump('valide');
          }


        }
        $posts = $this->postRepository->findAll();

        return new Response($this->view->render([
            'template' => 'home',
            'data' => ['posts' => $posts]

        ]));
    }
}  