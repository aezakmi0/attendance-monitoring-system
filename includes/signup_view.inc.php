<?php

declare(strict_types=1);

function signup_inputs() {
    echo '<input type="text" name="first_name" placeholder="First Name" class="form-control input-border" value="'. $_SESSION["signup_data"]["first_name"] .'">';
    echo '<input type="text" name="last_name" placeholder="Last Name" class="form-control input-border" value="'. $_SESSION["signup_data"]["last_name"] .'">';

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="Email" class="form-control input-border" value="'. $_SESSION["signup_data"]["email"] .'">';
    } else {
        echo '<input type="text" name="email" placeholder="Email" class="form-control input-border">';
    }

    echo '<input type="password" name="password" placeholder="Password" class="form-control input-border">';
}


function check_signup_errors(){
    if (isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach($errors as $error){
            echo '<p class="form-error">' . $error . '</p>';
            // CHANGE THIS TO TOAST????
        }

        unset($_SESSION['errors_signup']);
    }else if (isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo '<br>';
        echo '<p class="form-sucess">Signup success!</p>';
    }
}