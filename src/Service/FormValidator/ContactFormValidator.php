<?php
/*
const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_LENGTH = 'Le champ doit faire entre 2 et 1° caractères';
const ERROR_EMAIL = "L'email n'est pas valide";

$errors = [
    'name' => '',
    'email' => ''
];

$_POST = filter_input_array(INPUT_POST,[
    'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
    'subject' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
    'message' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
]);

$name = $_POST['name']??'';
$email =$POST['email']??'';

if (!$name) {
    $errors ['name'] = ERROR_REQUIRED;
} elseif (mb_strlen($firstname)) < 2 || mb_strlen (($name))> 10 )) {
    $errors['name'] = ERROR_LENGTH;
}

if (!$email) {
    $errors ['email'] = ERROR_REQUIRED;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors ['email'] = ERROR_EMAIL;
}
*/
//*errors ['name] ? '<p style="color:red"> '. $errors [name] ."</p>": ''



declare(strict_types=1);

namespace  App\Service\FormValidator;

use App\Service\Http\Request;
use App\Service\Http\Session\Session;
use App\Model\Repository\UserRepository;



final class ContactFormValidator
{
    private $errorMessage = "Il y a des erreurs dans votre formulaire";
    private $successMessage = "Le formulaire a bien été soumis";
    
    public function __construct(private Request $request)
    {
        $this->request->getAllRequest();
    }

    public function isValid(): bool
    {
        if ($this->infoUser === null) {
            return false;
        }

        $user = $this->userRepository->findOneBy(['email' => $this->infoUser['email']]);

        if (!$user instanceof (User::class) || $this->infoUser['password'] !== $user->getPassword()) {
            return false;
        }

        $this->session->set('user', $user);

        return true;
    }
}
