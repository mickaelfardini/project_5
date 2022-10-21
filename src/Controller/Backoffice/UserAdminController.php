<?php
//modification role (editeur / utilisateur ) pas modif role admin 
declare(strict_types=1);

namespace App\Controller\Backoffice;

use App\View\View;
use App\Service\Http\Request;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Model\Repository\UserRepository;
use JetBrains\PhpStorm\NoReturn;


final class UserAdminController
{
    public function __construct(private UserRepository $userRepository, private View $view, private Session $session )
    {

    }

    public function listAction(): Response
    {
        $users = $this->userRepository->findAll();

        return new Response($this->view->render([
            'path'=>'backoffice',
            'template' => 'userlist',
            'data' => ['users' => $users],
        ]));
    }

    public function addAction(Request $request): Response
    {
        $user = $this->userRepository->createUser($request->getAllRequest());

        $users = $this->userRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'userlist',
            'data' => ['users' => $users],
        ]));
    }

    public function editAction(Request $request): Response
    {
        $user = $this->userRepository->findOneBy(['id_user' => $request->getQuery('user')]);
        if ($user !== null) {
            if ($request->getMethod() === 'POST') {
                $this->userRepository->editUser($request->getAllRequest(), $user->getId(), $this->session->get('user'));
            }
        }

        $users = $this->userRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'userlist',
            'data' => ['users' => $users],
        ]));
    }

    public function deleteAction(Request $request): Response
    {
        $this->userRepository->delete($request->getQuery('user'));
        $users = $this->userRepository->findAll();

        return new Response($this->view->render([
            'path' => 'backoffice',
            'template' => 'userlist',
            'data' => ['users' => $users],
        ]));
    }
}