<?php

declare(strict_types=1);

namespace App\Service;



class AuthentificationService
{


    public function isAdmin (): bool
    {
        return !empty($_SESSION['admin']);
    }

    public function disconnect ()
    {
        session_destroy();
    }
    public function noAdminAccess(){}

// isAdmin () / is...()
//class qui permet l'autorisation a la page admin
   
}


