<?php

declare(strict_types=1);

namespace  App\Service\FormValidator;

use App\Service\Http\Request;


final class AddPostFormValidator
{   
    private array $fields = [];
    private array $errors = [];
    private array $success = [];



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
    
        
    public function __construct(private Request $request)
    {
        $this->fields = $this->request->getAllRequest();
    }
    
    public function getErrors() :array
    {
        return $this->errors;
    }

    public function getSuccess() :array
    {
        return $this->success;
    }

    public function isValid() :bool 
    {
        if ( !$this->validatedField($this->fields['title'])){
           // $this->session->addFlashes('error','Le titre n\'est pas valide');
            $this->errors[]='Le titre n\'est pas valide';
        }
        
        if ( !$this->validatedField($this->fields['chapo'])){
          //  $this->session->addFlashes('error','Le chapo n\'est pas valide');
            $this->errors[]='Le chapo n\'est pas valide';
        }
    
        if ( !$this->validatedField($this->fields['content'])){
            //$this->session->addFlashes('error','Le message n\'est pas valide');
            $this->errors[]='Le contenu n\'est pas valide';
        }
        if (empty($this->errors)) {
            $this->success['send'] = 'Votre post est en attente de validation.';
            return true;
        }

        return false;
    }
}
