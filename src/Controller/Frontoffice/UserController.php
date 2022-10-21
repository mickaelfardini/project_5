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

            $user = $this->userRepository->login($request->getAllRequest());
            if ($user) {
                $this->session->set('user', $user);
                return new Response($this->view->render(['path'=>'frontoffice','template' => 'home', 'data' => ['user' => $this->session->get('user')], 200]));
            }
            $this->session->addFlashes('error', ['Mauvais identifiants']);
            var_dump('bad login');
        }
        return new Response($this->view->render(['path'=>'frontoffice','template' => 'login', 'data' => ['user' => $this->session->get('user')]]));
    }
    
    public function logoutAction(): Response
    {
        session_destroy();
        return new Response($this->view->render(['path'=>'frontoffice','template' => 'home', 'data' => [], 200]));
    }

    public function signUpAction(Request $request): Response
    {
        $this->session->remove('user');
        if ($request->getMethod() === 'POST') {
            $signupFormValidator = new SignUpFormValidator($request, $this->userRepository, $this->session);
            if ($signupFormValidator->isValid()) {
                $this->userRepository->createUser($request->getAllRequest());
                return new Response($this->view->render(['path'=>'frontoffice','template' => 'home', 'data' => ['user' => $this->session->get('user')], 200]));
            }
            $this->session->addFlashes('error', ['Mauvais identifiants']);
        }
        return new Response($this->view->render([
            'path'=>'frontoffice',
            'template' => 'signup'
        ]));    
    }
}