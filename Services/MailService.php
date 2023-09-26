<?php

namespace Services;

use Exception;
use Models\MailData;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailService
{
    public static function sendMail(MailData $mailData): bool
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = '';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Recipients
            $mail->setFrom('', '');
            $mail->addAddress("", "");
            $mail->isHTML(true);
            $mail->Subject = "Apply Form";
            $mail->Body = $mailData->getHtml();
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $isSend = $mail->send();
            if ($isSend)
                LogService::add("Mail sent successfully" . $mailData);
            else
                LogService::add("Mail could not be sent" . $mail->ErrorInfo);
            return $isSend;
        } catch (Exception $e) {
            LogService::add("Failed to send mail" . $mailData);
            return false;
        }
    }
}
