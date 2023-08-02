<?php

date_default_timezone_set('Europe/Istanbul');
require_once 'helper.php';

try {
    // Get POST data
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create the EmailSender object
    $emailSender = new EmailSender();

    // Send email and get the result
    $isSend = $emailSender->sendMail($to, $subject, $message);

    // Create the Logger object
    $logger = new Logger();

    // Log the result of the email sending
    if ($isSend) {
        $response = [
            'status' => true,
            'message' => 'Mail başarıyla gönderildi'
        ];
        $logger->add("Mail sent successfully to: $to");
    } else {
        $response = [
            'status' => false,
            'message' => 'Mail gönderilirken bir hata oluştu'
        ];
        $logger->add("Failed to send mail to: $to");
    }

    // Return the response as JSON
    echo json_encode($response);
} catch (Exception $e) {
    if (isset($logger)) {
        $logger->add($e->getMessage());
    } else {
        echo $e->getMessage();
    }
}
?>

```