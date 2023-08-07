<?php


require_once "vendor/autoload.php";
require_once "Services/LogService.php";
require_once "Services/MailService.php";
require_once "Utilities.php";
require_once "Models/MailData.php";
require_once "Models/ApplyType.php";

use Models\MailData;
use Services\LogService;
use Services\MailService;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH, PUT');


try {
    if (empty($_POST)) {
        $_POST = file_get_contents('php://input');
        $_POST = json_decode($_POST, true);
    }
//    Utilities::return($_POST);
    // Get POST data
//    $validationData = [
//        "applyType" => "required",
//        "username" => "required",
//        "certificate" => "required",
//        "phoneNumber" => "required",
//        "drivingLicense" => "required",
//    ];
//    $validate = Utilities::validate($_POST, $validationData);
//    if (!$validate) {
//        $response = [
//            'status' => false,
//            'message' => 'Please fill in the required fields'
//        ];
//        Utilities::return($response);
//    }
    $mailData = new MailData();
    $mailData->setWithArray($_POST);

    // Send email and get the result
    $isSend = MailService::sendMail($mailData);


    // Log the result of the email sending
    if ($isSend) {
        $response = [
            'status' => true,
            'message' => 'Mail successfully sent'
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Mail could not be sent',
        ];
    }
    Utilities::return($response);

} catch (Exception $e) {
    LogService::add($e->getMessage());
    Utilities::return($e->getMessage());
}
?>

```