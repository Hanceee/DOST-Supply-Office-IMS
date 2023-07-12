<?php
// Include the database configuration file
require_once '../db/config.php';

// Start the session
session_start();

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the user data from the database
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Set the user session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        // Redirect to the dashboard page or display a success message
        // Replace "dashboard.html" with the actual dashboard page URL
        header("Location: \DOST-Supply-Office-IMS\dashboard.html");
        exit();
    } else {
        // Display an error message
        echo 'Invalid username or password';
    }
}
?>
