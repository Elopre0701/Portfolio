<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// PHPMailer
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';
require_once 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json'); // Ensure JSON always
$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST requests are allowed.');
    }

    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    if (!$data || !isset($data['name'], $data['email'], $data['message'])) {
        throw new Exception('Invalid or missing input data.');
    }

    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $message = htmlspecialchars($data['message']);

    // Send mail
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'phaeng@gmail.com'; // Replace with your email
    $mail->Password = 'ocbiurwhnanmvejs';       // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('jhonelopre@gmail.com', 'Jhon Elopre');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'Contact Form Message';
    $mail->Body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message";

    $mail->send();

    $response['success'] = true;
    $response['message'] = 'Email sent successfully!';
} catch (Exception $e) {
    $response['message'] = 'Mail error: ' . $e->getMessage();
}

echo json_encode($response);
exit;
