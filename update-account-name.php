<?php
require_once 'includes/check_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Retrieve user information from the form
    // $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Retrieve password information from the form
    // $current_password = $_POST['current_password'];
    // $new_password = $_POST['new_password'];

    try {
        require_once 'includes/dbh.inc.php';
        require_once 'includes/login_model.inc.php';
        require_once 'includes/update_account_model.inc.php'; // Include your update model script here

        // // Check if the current password matches the password in the database
        // $result = get_user($pdo, $email); // You need to implement this function in your login_model.inc.php file
        // if (!is_password_correct($current_password, $result['password'])) {
        //     // Current password is incorrect
        //     header("Location: account-settings.php");
        //     $_SESSION['success_message'] = 'Current password is incorrect!';
        //     exit();
        // }

        // Update user information (first name and last name)
        update_user_info($pdo, $first_name, $last_name, $email, $user_ID);

        // Update password if new password is provided
        // if (!empty($new_password)) {
        //     update_user_password($pdo, $email, $new_password);
        // }

        // Update session variables if necessary
        $_SESSION['user_first_name'] = $first_name;
        $_SESSION['user_last_name'] = $last_name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = $user_ID;
        
        // Redirect back to the account settings page with a success message
        header("Location: index.php");
        $_SESSION['success_message'] = 'Changes saved!';
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        die("Query failed: " . $e->getMessage());
    }
} else {
    // If the request method is not POST, redirect back to the account settings page
    header("Location: account-settings.php");
    exit();
}

