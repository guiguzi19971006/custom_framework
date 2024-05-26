<?php

namespace App\Mailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Exception;

class Mail
{
    /**
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    private $mailer;

    /**
     * 建構式
     * 
     * @param \PHPMailer\PHPMailer\PHPMailer $mailer
     * 
     * @return void
     */
    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * 發送電子郵件
     * 
     * @param string $subject
     * @param string $body
     * @param array $emails
     * 
     * @return bool
     * 
     * @throws \Exception
     */
    public function send(string $subject, string $body, array $emails)
    {
        if (empty($emails)) {
            throw new Exception('At least provide an email address');
        }

        $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->isSMTP();
        $this->mailer->Host = env('SMTP_HOST');
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = env('SMTP_USER');
        $this->mailer->Password = env('SMTP_PASSWORD');
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Port = env('SMTP_PORT');

        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new Exception('Email address format is incorrect');
            }

            $this->mailer->addAddress($email);
        }

        $this->mailer->setFrom(env('SMTP_FROM_NAME'));
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;
        return $this->mailer->send() !== false;
    }
}
