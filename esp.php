<?php
$servername = "localhost"; // Ganti dengan alamat server MySQL
$username = "username"; // Ganti dengan username MySQL
$password = "password"; // Ganti dengan password MySQL
$dbname = "esp32_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from URL parameters
$value = $_GET['value'];

// Insert data into database
$sql = "INSERT INTO sensor_data (value) VALUES ('$value')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
