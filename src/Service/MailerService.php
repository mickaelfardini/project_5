<?php

declare(strict_types=1);

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;


class MailerService
{
    public function sendMessage(string $subject, string $content, string $sendto){

    // Create the Transport
$transport = new \Swift_SmtpTransport('localhost', 1025);
//->setUsername('your username')
//->setPassword('your password')


// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = new Swift_Message();
$message->setTo($sendto);
$message->setSubject($subject);
$message->setFrom(['nacerasahed@blog.com' => 'Nacera SAHED']);
$message->setBody($content, 'text/html');


// Send the message
$result = $mailer->send($message);
    }

}


