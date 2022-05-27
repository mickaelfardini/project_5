<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Frontoffice\PostController;
use App\Controller\Frontoffice\UserController;
use App\Controller\Frontoffice\HomeController;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\UserRepository;
use App\Service\FormValidator\ContactFormValidator;
use App\Service\Http\Request;
use App\Service\Http\Response;
use App\Service\MailerService;
use App\Service\Http\Session\Session;
use App\View\View;
use App\Service\Database;

final class Router
{
    private Database $database;
    private View $view;
    private Session $session;
    private MailerService $mail;

    public function __construct(private Request $request)
    {
        
        $this->database = new Database('projet_5','localhost','root','',3306);
        
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->mail =new MailerService();
    }

    public function run(): Response
    {
        $action = $this->request->hasQuery('action') ? $this->request->getQuery('action') : 'home';
      
        if ($action === 'home') {
            
            $postRepo = new PostRepository($this->database);
            $contactformvalidator = new ContactFormValidator($this->request);
           // $result= new MailerService($this->request);
            $controller = new HomeController($postRepo, $this->view, $this->session, $this->mail);
            

        return $controller->homeAction($this->request,$contactformvalidator,/*$result*/);

        
      /*  if ($action === 'post') {
            
            $postRepo = new PostRepository($this->database);
            $controller = new PostController($postRepo, $this->view);

            return $controller->displayAllAction($this->request);

        } elseif ($action === 'home') {
            
                $postRepo = new PostRepository($this->database);
                $contactformvalidator = new ContactFormValidator($this->request,$this->session);
                $controller = new HomeController($postRepo, $this->view);
                
    
                return $controller->homeAction($this->request,$contactformvalidator);
    
            */
        } elseif ($action === 'posts') {
            
            $postRepo = new PostRepository($this->database);
            $controller = new PostController($postRepo, $this->view);

            return $controller->displayAllAction($this->request);

        } elseif ($action === 'post' && $this->request->hasQuery('id_post')) {
         
            $postRepo = new PostRepository($this->database);
            $controller = new PostController($postRepo, $this->view);

            $commentRepo = new CommentRepository($this->database);

            return $controller->displayOneAction((int) $this->request->getQuery('id_post'), $commentRepo);

        
        } elseif ($action === 'login') {
            $userRepo = new UserRepository($this->database);
            $controller = new UserController($userRepo, $this->view, $this->session);

            return $controller->loginAction($this->request);

        
        } elseif ($action === 'logout') {
            $userRepo = new UserRepository($this->database);
            $controller = new UserController($userRepo, $this->view, $this->session);

            return $controller->logoutAction();


        } elseif ($action === 'signup') {
            $userRepo = new UserRepository($this->database);
            $controller = new UserController($userRepo, $this->view, $this->session);

            return $controller->signupAction($this->request);

        } elseif ($action === 'accessAccount') {
            $userRepo = new UserRepository($this->database);
            $controller = new UserController($userRepo, $this->view, $this->session);

            return $controller->signupAction($this->request);

        }
        return new Response("Error 404 - cette page n'existe pas<br><a href='index.php?action=posts'>Aller Ici</a>", 404);
    }
}
