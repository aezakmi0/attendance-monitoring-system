<?php

declare(strict_types=1);

function output_username(){
    if (isset($_SESSION["user_id"])){
        echo $_SESSION["user_last_name"] .", " . $_SESSION["user_first_name"];
    } else {
        echo "You're not logged in";
    }
}

function check_login_errors(){
    if (isset($_SESSION['errors_login'])){
        $errors = $_SESSION['errors_login'];

        echo "<br>";

        foreach($errors as $error){
            echo '<p class="form-error">' . $error . '</p>';
            // CHANGE THIS TO TOAST????
        }

        unset($_SESSION['errors_signup']);
    }else if (isset($_GET["login"]) && $_GET["login"] === "success"){
        echo '<br>';
        echo '<p class="form-sucess">Log in success!</p>';
    }
}