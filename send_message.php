<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Update the paths to your PHPMailer files
require 'C:/xampp/htdocs/clinic_appointments/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/clinic_appointments/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/clinic_appointments/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        $admin_email = 'supertayergt15@gmail.com'; // Admin email
        $subject = 'New Contact Form Message';
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Use PHPMailer to send email
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output (set to 2 for detailed output)
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'supertayergt15@gmail.com'; // SMTP username
            $mail->Password = 'wems revn hyda xozz'; // SMTP password (use App Password if 2FA is enabled)
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('your-email@gmail.com', 'Clinic Website');
            $mail->addAddress($admin_email); // Add a recipient

            // Content
            $mail->isHTML(false); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            echo "<script>alert('Message sent successfully!'); window.location.href = 'mainpage.html';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'contact.html';</script>";
        }
    } else {
        echo "<script>alert('All fields are required.'); window.location.href = 'contact.html';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'contact.html';</script>";
}
?>
