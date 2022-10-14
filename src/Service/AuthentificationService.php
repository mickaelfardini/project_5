<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Http\Session\Session;

class AuthentificationService
{
    public function __construct(private Session $session)
    {

    }
       

    public function isRole(string $role): bool
    {
        if(!$this->isConnected()){
            return false;
        }
        $user=$this->session->get('user');
        if($user->getUserRole()!== $role)
        {
            return false;
        }
        return true;
    }

    public function isConnected(): bool
    {
        if( $this->session->get('user')=== null){
            return false;
        }
        return true;
    }

// isAdmin () / is...()
//class qui permet l'autorisation a la page admin
   
}


