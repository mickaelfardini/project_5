<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Service\MailerService;
use App\Service\FormValidator\ContactFormValidator;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Service\Http\Request;


final class HomeController
    {
        public function __construct(private PostRepository $postRepository, private View $view, private Session $session , private MailerService $mail)
        {
    
        }
       
    
        public function homeAction(Request $request , ContactFormValidator $contactFormValidator ): Response
        {   

             if ($request->getMethod()=== 'POST') {
                $contactFormValidator = new ContactFormValidator($request);    
                if ($contactFormValidator->isValid()){
                  var_dump('valide'); //send mail 
                $this->mail->sendMessage('subject','content', 'toto@toto.fr');//récuper les info , content : email.twig
               var_dump("mail envoyé");
                die;
                $this->session->addFlashes ('success', 'Votre message à été envoyé.');
                return new Response(($this->view->render('home', ['mail'=>$message])), 200);// redirection 
              }
            
              $this->session->addFlashes('error', $contactFormValidator->getErrors('error','Formulaire non valide'));
            
            // si pas valid récupére les message flash pas de redirection de page
            // redirection si valide sur la homepage
           /* return new Response ($this->view->render('home', ['mail'=>$message]));*/


              
          }
          $posts = $this->postRepository->findAll();
    
            return new Response($this->view->render([
              'path'=>'frontoffice',
                'template' => 'home',
                'data' => ['posts' => $posts, 'user' => $this->session->get('user')],
                //redirection obligaroire à créer
                //$this->response = ['path'=> ''],
               // 'data' => ['posts' => $posts]
    
            ]));    
        }
}