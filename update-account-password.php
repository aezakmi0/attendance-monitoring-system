<?php
require_once 'includes/check_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Retrieve password information from the form
    $email = $_SESSION['user_email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['new_password_confirm'];

    try {
        require_once 'includes/dbh.inc.php';
        require_once 'includes/login_model.inc.php';
        require_once 'includes/update_account_model.inc.php'; // Include your update model script here

        // Check if the current password matches the password in the database
        $result = get_user($pdo, $email); // You need to implement this function in your login_model.inc.php file
        if (!is_password_correct($current_password, $result['password'])) {
            // Current password is incorrect
            header("Location: change-password.php");
            $_SESSION['success_message'] = 'Current password is incorrect!';
            exit();
        }
        
        if (is_new_password_empty($new_password, $confirm_new_password)){
            header("Location: change-password.php");
            $_SESSION['success_message'] = 'Passwords cannot be empty.';
            exit();
        }
        
        if (!is_new_password_correct($new_password, $confirm_new_password)) {
            // Passwords do not match, display error message
            header("Location: change-password.php");
            $_SESSION['success_message'] = 'Passwords do not match.';
            exit();
        } else {
            // Passwords match, proceed with further actions
            // For example, update password in the database
            update_user_password($pdo, $email, $new_password);
        }

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
