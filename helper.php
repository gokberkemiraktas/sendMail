<?php
// helper.php

use PHPMailer\PHPMailer\PHPMailer;

class EmailSender
{
    /**
     * @param $to
     * @param $subject
     * @param $message
     * @return bool
     */
    public function sendMail($to, $subject, $message): bool
    {
        try {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->From = "test@test.com";
            $mail->Sender = "test@test.com";
            $mail->FromName = "Web Message";
            $mail->Host = "mail.test.com";
            $mail->SMTPAuth = true;
            $mail->Username = "test@test.com";
            $mail->Password = "*****";
            $mail->SMTPSecure = "";
            $mail->Port = "587";
            $mail->CharSet = "utf-8";
            $mail->WordWrap = 50;
            $mail->IsHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = strip_tags("message");
            $mail->AddAddress($to);

            // Attempt to send the email and return the result
            return $mail->Send();
        } catch (Exception $e) {
            return false;
        }
    }
}


class Logger
{
    private $logFolder;

    public function __construct()
    {
        $this->logFolder = "logs/";
        if (!file_exists($this->logFolder)) {
            mkdir($this->logFolder);
        }
    }

    /**
     * @param string $text
     * @return void
     */
    public function add(string $text)
    {
        $data = date("H:i:s") . "   " . $text . PHP_EOL;
        $logFileName = $this->logFolder . date("Y-m-d") . ".log";

        $file = fopen($logFileName, "a");
        fwrite($file, $data);
        fclose($file);
    }
}

?>
