<?php
session_start();
$title = "Forget Password - CheapDeals";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$config['email'] = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_user' => 'hoangvhgch220975@fpt.edu.vn', // Set as static sender email
    'smtp_fullname' => 'Vu Hong Hoang',
    'smtp_pass' => 'fybh qbbj prxh wxag',
    'smtp_secure' => 'tls',
    'smtp_timeout' => '7',
    'mailtype' => 'html',
    'charset' => 'UTF-8'
);

function send_mail($sent_to_email, $sent_to_fullname, $subject, $content) {
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $config_email['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config_email['smtp_user'];
        $mail->Password = $config_email['smtp_pass'];
        $mail->SMTPSecure = $config_email['smtp_secure'];
        $mail->Port = $config_email['smtp_port'];
        $mail->CharSet = $config_email['charset'];

        // Recipients
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname);
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

if (isset($_POST['submit'])) {
    // Fixed recipient details
    $sent_to_email = 'hoangvhgch220975@fpt.edu.vn'; // Use static email
    $sent_to_fullname = 'Vu Hong Hoang'; // Use static name

    // Construct the subject and content
    $subject = $_POST['name'] . " Need to support: " . $_POST['title'];
    $content = $_POST['message'];

    // Send the email and handle the response
    $send_result = send_mail($sent_to_email, $sent_to_fullname, $subject, $content);
    if ($send_result === true) {
        echo "<script>alert('Email sent successfully!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Email sent error!');</script>";
        $error = $send_result;  // Capture the error message
    }
}

include '../template/forgetpass.html.php';
?>
