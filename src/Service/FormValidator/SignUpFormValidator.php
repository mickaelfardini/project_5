<?php

declare(strict_types=1);

namespace  App\Service\FormValidator;

use App\Model\Entity\User;
use App\Service\Http\Request;
use App\Service\Http\Session\Session;
use App\Model\Repository\UserRepository;



final class SignUpFormValidator
{
    private ?array $infoUser = [];

    public function __construct(private Request $request, private UserRepository $userRepository, private Session $session)
    {
        $this->infoUser = $this->request->getAllRequest();
    }

    public function isValid(): bool
    {
        if ($this->infoUser === null) {
            return false;
        }

        $user = $this->userRepository->findOneBy(['email' => $this->infoUser['email']]);

        if (!$user instanceof (User::class)) {
            return true;
        }

        return false;
    }
}
