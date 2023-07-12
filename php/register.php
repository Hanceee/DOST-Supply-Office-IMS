<?php
// Include the database configuration file
require_once '../db/config.php';

// Process the registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $fullName = $_POST['full_name'];

    // Validate the form data
    // Check if the passwords match
    if ($password !== $confirmPassword) {
        die('Error: Passwords do not match');
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database
    $sql = "INSERT INTO user (username, password, full_name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashedPassword, $fullName);
    $stmt->execute();
    $stmt->close();

    // Redirect to the login page or display a success message
    // Replace "login.html" with the actual login page URL
    header("Location: \DOST-Supply-Office-IMS\dashboard.html");
    exit();
}
?>
