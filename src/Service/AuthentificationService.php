<?php

declare(strict_types=1);

namespace App\Service;



class AuthentificationService
{


    public function setAdimSession () {}

    public function noAdminAccess(){}

// isAdmin () / is...()
//class qui permet l'autorisation a la page admin
public function isAdmin(User $user): bool
    {
        if ($user->getRole() === false || $user->getRole() === 0 || $user->getROle() === '0') {
            return false;
        }
        return true;
    }

    public function isCurrentUserAdmin(): bool
    {
        if ($this->isLoggedIn()) {
            $user = $this->userManager->read($this->session->get('id_user'));
            $role = $user->getRole();
            if ($role === false || $role === 0 || $role === '0') {
                return false;
            }
            return true;
        }
        return false;
    }

    public function getCurrentUser(): User
    {
        return $this->userManager->read($this->session->get('id_user'));
    }

    public function isDisabled(User $user): bool
    {
        if ($user->getDeleted() === true || $user->getDeleted() === 1 ||  $user->getDeleted() === '1') {
            return true;
        }
        return false;
    }
}


