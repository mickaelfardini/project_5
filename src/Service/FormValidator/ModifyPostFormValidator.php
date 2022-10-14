<?php

declare(strict_types=1);

namespace  App\Service\FormValidator;

use App\Service\Http\Request;


final class ModifyPostFormValidator
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
        if ( !$this->validatedField($this->fields['title'])){
           // $this->session->addFlashes('error','Le titre n\'est pas valide');
            $this->errors[]='Le titre n\'est pas valide';
            $return=false;
        }
        
        if ( !$this->validatedField($this->fields['chapo'])){
          //  $this->session->addFlashes('error','Le chapo n\'est pas valide');
            $this->errors[]='Le chapo n\'est pas valide';
            $return=false;
        }
    
        if ( !$this->validatedField($this->fields['message'])){
            //$this->session->addFlashes('error','Le message n\'est pas valide');
            $this->errors[]='Le message n\'est pas valide';
            $return=false;
         
        }
        
        if (!empty($this->errors)) {
            $this->success['send'] = 'Votre post est en attente de validation.';
            $return=true;
        }
      
        return $return;
    }
}
