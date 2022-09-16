<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;
use App\Service\Http\Request;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Model\Repository\UserRepository;
use App\Service\FormValidator\LoginFormValidator;
use App\Service\FormValidator\SignUpFormValidator;

final class UserController
{
    public function __construct(private UserRepository $userRepository, private View $view, private Session $session)
    {
    }

    public function loginAction(Request $request): Response
    {
       
        if ($request->getMethod() === 'POST') {
            $loginFormValidator = new LoginFormValidator($request, $this->userRepository, $this->session);

            if ($loginFormValidator->isValid()) {
                
                return new Response($this->view->render(['path'=>'frontoffice','template' => 'home', 'data' => [], 200]));
            }
            $this->session->addFlashes('error', 'Mauvais identifiants');
        }
        return new Response($this->view->render(['path'=>'frontoffice','template' => 'login', 'data' => []])); 
    }
    
    public function logoutAction(): Response
    {
        $this->session_destroy();
        return new Response($this->view->render(['path'=>'frontoffice','template' => 'home', 'data' => [], 200]));
    }

    public function SignUpAction(): Response
    {
        $this->session->remove('user');
        return new Response($this->view->render([
            'path'=>'frontoffice',
            'template' => 'signup'
        ]));    
    }
}

