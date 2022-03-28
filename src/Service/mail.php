<?php

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class sendMail
{
    public function sendMessage()

    // Create the Transport
$transport = (new Swift_SmtpTransport('nacerasahed@gmail.com', 25))
->setUsername('nacerasahed@gmail.com')
->setPassword('your password')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('blog formulaire de contact'))
->setFrom(['john@doe.com' => 'John Doe'])
->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
->setBody('Votre message a été envoyé avec succès ')
;

// Send the message
$result = $mailer->send($message);
}