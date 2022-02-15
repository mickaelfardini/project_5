<?php

const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_LENGTH = 'Le champ doit faire entre 2 et 1° caractères';
const ERROR_EMAIL = "L'email n'est pas valide";

$errors = [
    'firstname' => '',
    'email' => ''
];

$_POST = filter_input_array(INPUT_POST,[
    'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
    'subject' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
    'message' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
]);

$firstname = $_POST['firsname']??'';
$email =$POST['email']??'';

