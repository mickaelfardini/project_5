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




final class ContactFormValidator
{   
    private $fields = [];
    private $errorMessage = "Il y a des erreurs dans votre formulaire";
    private $successMessage = "Le formulaire a bien été soumis";
    private function validatedName(string $lastName ) : bool
    {
        if ( !empty($lastName) && strlen($lastName) <=20 && preg_match ("^[A-Za-z '-]+$^",$lastName)){
           echo   'Le nom nest pas valide';
        }
        return true;

    }
    private function validatedFirstName(string $firstName ) : bool
    {
        if ( !empty($firstName) && strlen($firstName) <=20 && preg_match ("^[A-Za-z '-]+$^",$firstName)){
           echo   'Le firstname nest pas valide';
        }
        return true;

    }
    private function validatedEmail(string $email) 
    {
        if (var_dump(filter_var('email@test.com', FILTER_VALIDATE_EMAIL)));
        return true;
    } 
        
    public function __construct(private Request $request, private Session $session)
    {
        $this->fields = $this->request->getAllRequest();
    }

    public function isValid()/*:bool */
    {
        var_dump ($this->fields);
        if ( !$this->validatedName($this->fields['lastname'])){
            $this->session->addFlashes('error','Le nom nest pas valide');
        }
        if ( !$this->validatedFirstName($this->fields['firstname'])){
            $this->session->addFlashes('error','Le prénom nest pas valide');
        }
        if ( !$this->validatedEmail($this->fields['email'])){
            $this->session->addFlashes('error','L"email nest pas valide');
        }


    }
}
