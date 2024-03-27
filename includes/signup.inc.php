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
        if (is_input_empty($first_name, $last_name, $email, $password)){

        }
        if (is_email_invalid($email)){
            
        }        

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}else {
    header("Location: ../welcome.php");
    die();
}