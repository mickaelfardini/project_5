<?php

declare(strict_types=1);

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;


class MailerService
{
    public function sendMessage()

    // Create the Transport
$transport = new \Swift_SmtpTransport('localhost', 1025)
//->setUsername('your username')
//->setPassword('your password')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Formulaire de contact'))
->setFrom(['john@doe.com' => 'John Doe'])
->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
->setBody('Votre message a été envoyé avec succès ')
;

// Send the message
$result = $mailer->send($message);
    

}


