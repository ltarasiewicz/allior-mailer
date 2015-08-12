<?php
namespace Mailer;

use Swift_Mailer;
use Swift_MailTransport;
use Swift_Message;
use Swift_SmtpTransport;

use Validator\Validator;

class MyMailer {

    public function configureTransport($smtpServer, $port, $encryption, $username, $password)
    {
        return Swift_SmtpTransport::newInstance($smtpServer, $port, $encryption)
                                        ->setUsername($username)
                                        ->setPassword($password);
    }

    public function setMessage($recipient, $text)
    {
        $message = Swift_Message::newInstance();
        $message->setTo($recipient, 'Lukasz Tarasiewicz');
        $message->setFrom('lukasz.tarasiewicz86@gmail.com', 'Lukasz Tarasiewicz');
        $message->setSubject('Informacja z Alior Forex dotycząca zakupu walut obcych.');
        $message->setBody($text);

        return $message;
    }

    public function sendNotification($transport, $message)
    {
        $mailer = Swift_Mailer::newInstance($transport);
        return $mailer->send($message);
    }

}