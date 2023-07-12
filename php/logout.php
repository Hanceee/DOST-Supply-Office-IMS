<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page
header('location: C:\xampp\htdocs\DOST-Supply-Office-IMS\template\index.html');
exit();
?>
