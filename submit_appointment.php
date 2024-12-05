<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer library files
require 'C:/xampp/htdocs/clinic_appointments/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/clinic_appointments/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/clinic_appointments/PHPMailer/src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $doctor = $_POST['doctor'];
    $email = $_POST['email'];

    if (!empty($date) && !empty($time) && !empty($doctor) && !empty($email)) {
        $stmt = $conn->prepare("INSERT INTO appointments (email, doctor, date, time) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die('MySQL prepare error: ' . $conn->error);
        }

        $stmt->bind_param("ssss", $email, $doctor, $date, $time);

        if ($stmt->execute()) {
            echo "<div style='color: green;'>Your appointment has been booked successfully!</div>";

            // Send email notification to clinic admin
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0; // Enable verbose debug output (set to 2 for detailed output)
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'supertayergt15@gmail.com'; // SMTP username
                $mail->Password = 'wems revn hyda xozz'; // Use the generated App Password here
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to

                //Recipients
                $mail->setFrom('no-reply@clinic.com', 'Clinic');
                $mail->addAddress('supertayergt15@gmail.com', 'Clinic Admin'); // Add a recipient

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'New Appointment Booking';
                $mail->Body    = "New appointment booked with the following details:<br>
                                 Email: $email<br>
                                 Doctor: $doctor<br>
                                 Date: $date<br>
                                 Time: $time";

                $mail->send();
                echo "<div style='color: green;'>Booking details email has been sent to the clinic admin.</div>";
            } catch (Exception $e) {
                echo "<div style='color: red;'>Failed to send notification email. Mailer Error: {$mail->ErrorInfo}</div>";
            }
        } else {
            echo "<div style='color: red;'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div style='color: red;'>Some fields are missing or incorrect.</div>";
    }
}

$conn->close();
?>
