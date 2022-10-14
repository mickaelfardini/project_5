<?php

declare(strict_types=1);

namespace  App\Service\FormValidator;

use App\Service\Http\Request;


final class ContactFormValidator
{   
    private $fields = [];
    private $errors = [];



    private function validatedField(string $field ) : bool
    {

        if (empty($field) ) {
         return false;
        }

        if (strlen($field) < 3) {
            return false;
        }

        if (strlen($field) >=20) {
            return false;
        }

        if (!preg_match ("^[A-Za-z '-]+$^",$field)) {
            return false;
        }
        return true ;
    }
    
  
    private function validatedEmail(string $email) 
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    } 
        
    public function __construct(private Request $request)
    {
        $this->fields = $this->request->getAllRequest();
    }
    
    public function getErrors() :array
    {
        return $this->errors;
    }

    public function isValid() :bool 
    {
        var_dump ($this->fields);
        $return = true;
        if ( !$this->validatedField($this->fields['lastname'])){
           // $this->session->addFlashes('error','Le nom n\'est pas valide');
            $this->errors[]='Le nom n\'est pas valide';
            $return=false;
        }
        
        if ( !$this->validatedField($this->fields['firstname'])){
          //  $this->session->addFlashes('error','Le prénom n\'est pas valide');
            $this->errors[]='Le prénom n\'est pas valide';
            $return=false;
        }

        if ( !$this->validatedEmail($this->fields['email'])){
           // $this->session->addFlashes('error','L"email n\'est pas valide');
           $this->errors[]='L\'email n\'est pas valide';
            $return=false;
        }
        
        if ( !$this->validatedField($this->fields['subject'])){
            //$this->session->addFlashes('error','L\'objet n\'est pas valide');
            $this->errors[]='L\'objet  n\'est pas valide';
            $return=false;
        }

        if ( !$this->validatedField($this->fields['message'])){
            //$this->session->addFlashes('error','Le message n\'est pas valide');
            $this->errors[]='Le message n\'est pas valide';
            $return=false;
            // if {!$lastname|| !$firstname || !$email || !$subject || !$message}
            // $this->errors[]='Veuillez remplir tous les champs du formulaire correctement';
        }
        
        if (!empty($this->errors)) {
            $this->success['send'] = 'Votre message a bien été envoyé.';
            $return=true;
        }
      
        return $return;
    }
}
