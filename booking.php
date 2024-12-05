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

// Fetch doctors data
$sql = "SELECT name FROM doctors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to shared CSS -->
</head>
<body>
    <header>
        <h1>Book Your Appointment</h1>
    </header>
    <nav>
        <a href="mainpage.html">Home</a>
        <a href="services.html">Services</a>
        <a href="booking.php">Booking</a>
        <a href="test.html">Branches</a>
        <a href="contact.html">Contact</a>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Fill in the Details Below</h2>
            <form id="appointmentForm" action="submit_appointment.php" method="POST">
                <div class="form-group">
                    <label for="date">Select Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Select Time:</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="doctor">Choose a Doctor:</label>
                    <select id="doctor" name="doctor" required>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No doctors available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <button type="submit">Submit Appointment</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2024 Clinic Appointment System. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('appointmentForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Validate form fields
            let date = document.getElementById('date').value;
            let time = document.getElementById('time').value;
            let doctor = document.getElementById('doctor').value;
            let email = document.getElementById('email').value;

            if (!date || !time || !doctor || !email) {
                alert('Please fill out all required fields.');
                return;
            }

            // After validation, allow form submission to server-side PHP
            let form = event.target;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Show pop-up message, reset form, and redirect to main page
                    alert('Appointment Booked! Thank you for booking an appointment with us. We will send you a confirmation email shortly.');
                    form.reset();
                    window.location.href = 'mainpage.html'; // Redirect to main page
                }
            };

            let formData = new FormData(form);
            xhr.send(new URLSearchParams(formData).toString());
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
