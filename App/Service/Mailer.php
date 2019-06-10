<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * La classe Mailer
 * Send mail
 */
class Mailer
{
    /**
     * Send mail
     * @param  string $from    
     * @param  string $name    user's name
     * @param  string $message message
     * @return bool
     */
    public function sendMail($from, $name, $message)
    {
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        // $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $_ENV['PHPMAILER_MAIL'];
        //Password to use for SMTP authentication
        $mail->Password = $_ENV['PHPMAILER_PASSWORD'];
        //Set who the message is to be sent from
        $mail->setFrom($from, $name);
        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress($_ENV['PHPMAILER_MAIL']);
        //Set the subject line
        $mail->Subject = 'P5 - Blog';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        //Replace the plain text body with one created manually
        $mail->Body = $message;
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        return $mail->send();
    }
}
