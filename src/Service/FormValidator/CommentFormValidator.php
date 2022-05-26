<?php

declare(strict_types=1);

namespace  App\Service\FormValidator;

use App\Service\Http\Request;


final class CommentFormValidator
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

        if (strlen($field) >=2000) {
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
    
        if ( !$this->validatedField($this->fields['message'])){
            //$this->session->addFlashes('error','Le message n\'est pas valide');
            $this->errors[]='Le message n\'est pas valide';
            $return=false;
        }

        return $return;
    }
}
