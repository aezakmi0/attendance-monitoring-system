<?php
// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: log-in.php");
    exit();
}

$user_ID = $_SESSION['user_id'];
// You can now use $user_ID to perform actions related to the logged-in user