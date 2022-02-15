<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Frontoffice\PostController;
use App\Controller\Frontoffice\UserController;
use App\Model\Repository\PostRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\UserRepository;
use App\Service\Http\Request;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\View\View;
use App\Service\Database;

final class Router
{
    private Database $database;
    private View $view;
    private Session $session;

    public function __construct(private Request $request)
    {
        
        $this->database = new Database('projet_5','localhost','root','root',3306);
        
        $this->session = new Session();
        $this->view = new View($this->session);
    }

    public function run(): Response
    {
        $action = $this->request->hasQuery('action') ? $this->request->getQuery('action') : 'post';
      
       
        if ($action === 'post') {
            
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
        }

        return new Response("Error 404 - cette page n'existe pas<br><a href='index.php?action=posts'>Aller Ici</a>", 404);
    }
}
