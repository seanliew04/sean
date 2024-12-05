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

// Fetch appointments data
$sql = "SELECT email, doctor, date, time FROM appointments WHERE 1";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to shared CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .logo h1 {
            color: #0056b3;
        }
        .appointments {
            margin: 20px auto;
            max-width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #0056b3;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>View Appointments</h1>
        </div>
        <nav>
            <a href="admin_dashboard.html">Dashboard</a>
            <a href="logout.html">Logout</a>
        </nav>
    </header>

    <main>
        <section class="appointments">
            <h2>All Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["doctor"]. "</td>
                                    <td>" . $row["date"]. "</td>
                                    <td>" . $row["time"]. "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No appointments found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>© 2024 Clinic Name. All rights reserved.</p>
    </footer>
</body>
</html>
