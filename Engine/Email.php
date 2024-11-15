<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{

    private PHPMailer $email;

    public function __construct()
    {
        $this->email = new PHPMailer(true);
    }

    /**
     * Initialise the mailer
     *
     * @return PHPMailer
     * @throws Exception
     */
    private function initMailer(): PHPMailer
    {
        $mail = $this->email;

        if (IS_SMTP) {
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
        }

        $mail->isHTML(true);

        $mail->setFrom(SMTP_USERNAME, APP_NAME);
        $mail->addReplyTo(SMTP_USERNAME, APP_NAME);

        return $mail;
    }


    /**
     * Sends password reset email
     *
     * @param string $email
     * @param string $key
     * @return bool
     * @throws Exception
     */
    public function sendResetPassword(string $email, string $key)
    {
        $mail = $this->initMailer();
        $mail->addAddress($email);

        $link = "https://www.ebasura.online/reset-password.php?key=" . $key;

        //Content
        $mail->Subject = APP_NAME . " - Password Reset";
        $mail->Body = "<p>It looks like you forgot your password on " . APP_NAME . "</p><p>Please reset your password by clicking on the link below:</p><a href='" . $link . "'>Reset Password</a> <br/><br/><p>If you can't click on that link, just copy and paste following url: </p><p>" . $link . "</p>Thanks, <br/>" . APP_NAME;

        try {
           if($mail->send()){
            return true;
           } else {
            return false;
           }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
