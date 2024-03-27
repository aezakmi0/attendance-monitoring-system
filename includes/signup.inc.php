<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try{
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($first_name, $last_name, $email, $password)){
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid email used!";
        }        
        if (is_email_registered($pdo, $email)){
            $errors["email_used"] = "Email already registered!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../welcome.php");
            die();
        }

        create_user($pdo, $first_name, $last_name, $email, $password);
        
        header("Location: ../welcome.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}else {
    header("Location: ../welcome.php");
    die();
}