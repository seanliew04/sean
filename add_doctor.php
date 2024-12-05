<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "clinic_appointments"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Insert doctor data into database
    $sql = "INSERT INTO doctors (name, specialty, email, contact) VALUES ('$name', '$specialty', '$email', '$contact')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New doctor added successfully!'); window.location.href='doctor_list.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.location.href='add_doctor.html';</script>";
    }

    $conn->close();
}
?>
