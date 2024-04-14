<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    try{
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($first_name, $last_name, $email, $password, $confirm_password)){
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid email used!";
        }        
        if (is_email_registered($pdo, $email)){
            $errors["email_used"] = "Email already registered!";
        }
        
        if (!is_password_confirmed($password, $confirm_password)) {
            $errors["email_used"] = "Passwords do not match.";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../sign-up.php");
            die();
        }

        create_user($pdo, $first_name, $last_name, $email, $password);
        
        // After creating the user successfully, retrieve the user ID
        $user_id = get_user_id($pdo, $email); // Assuming you have a function to retrieve the user ID

        // Set the user ID in the session
        $_SESSION['user_id'] = $user_id;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_first_name"] = htmlspecialchars($first_name);
        $_SESSION["user_last_name"] = htmlspecialchars($last_name);

        header("Location: ../index.php");

        $pdo = null;
        $stmt = null;

        die();

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}else {
    header("Location: ../sign-up.php");
    die();
}