<?php

declare(strict_types=1);

namespace App\Service\Http\Session;
use App\Model\Entity\User;

final class Session
{
    private array $sessionParamBag; 

    public function __construct()
    {
        session_start();
        $this->sessionParamBag = &$_SESSION;
    }

    public function set(string $name, mixed $value): void
    {
        $this->sessionParamBag[$name] = $value; //objet user
    }

    public function get(string $name): mixed
    {
        return isset($this->sessionParamBag[$name]) ? $this->sessionParamBag[$name] : null;
    }

    public function getAll(): ?array
    {
        return $this->sessionParamBag;
    }

    public function remove(string $name): void
    {
        unset($this->sessionParamBag[$name]);
    }

   
    public function addFlashes(string $type, array $message ): void
    {
        $this->set('flashes', [$type => $message]);
    }

    public function getFlashes(): ?array
    {
        $flashes = $this->get('flashes');
        $this->remove('flashes');

        return $flashes;
    }
    
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
