<?php
//modification role (editeur / utilisateur ) pas modif role admin 
declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;
use App\Service\Http\Request;
use App\Service\Http\Response;
use App\Service\Http\Session\Session;
use App\Model\Repository\UserRepository;
use App\Service\FormValidator\LoginFormValidator;
use App\Service\FormValidator\SignUpFormValidator;

//modif du statut (admin , editeur , lecteur )

final class UserAdminController
    {
        public function __construct(private UserRepository $userRepository, private View $view, private Session $session )
        {
    
        }
    
        public function userAdminAction()
        {
           var_dump("useraction");
           die;
    
            // ajouter post / modifier /supprimer
            }
}