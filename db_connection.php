<?php
$servername = "localhost";
$username = "root";  // default for XAMPP
$password = "";  // default for XAMPP (empty)
$dbname = "clinic_appointments";  // Ensure this matches your actual database name in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to the database successfully!<br>";

// Test the connection with a simple query
$result = $conn->query("SELECT 1");
if ($result) {
    echo "Test query executed successfully! Database is ready to accept data.<br>";
} else {
    echo "Error executing test query: " . $conn->error . "<br>";
}
?>
