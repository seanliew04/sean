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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete doctor from database
    $sql = "DELETE FROM doctors WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Doctor deleted successfully!'); window.location.href='doctor_list.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "'); window.location.href='doctor_list.php';</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('No doctor ID provided'); window.location.href='doctor_list.php';</script>";
}
?>
