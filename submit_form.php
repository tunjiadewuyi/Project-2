<?php
// submit_form.php

// Database connection parameters
$servername = "localhost";
$username = "root";       // Change to your MySQL username
$password = "";           // Change to your MySQL password
$dbname = "signup_db";    // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Password hashing for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert data into the table
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
