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
$sql = "SELECT id, name, specialty, email, contact FROM doctors";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor List</title>
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
        .doctor-list {
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
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons a {
            padding: 8px 12px;
            background-color: #0056b3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .action-buttons a:hover {
            background-color: #004080;
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
            <h1>Doctor List</h1>
        </div>
        <nav>
            <a href="admin_dashboard.html">Dashboard</a>
            <a href="logout.html">Logout</a>
        </nav>
    </header>

    <main>
        <section class="doctor-list">
            <h2>All Doctors</h2>
            <div class="action-buttons">
                <a href="add_doctor.html">Add Doctor</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["name"]. "</td>
                                    <td>" . $row["specialty"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["contact"]. "</td>
                                    <td><a href='delete_doctor.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this doctor?\")'>Delete</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No doctors found</td></tr>";
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
