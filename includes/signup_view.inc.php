<?php

declare(strict_types=1);

function signup_inputs() {
    // Check if $_SESSION["signup_data"] is set before accessing its keys
    $first_name = isset($_SESSION["signup_data"]["first_name"]) ? $_SESSION["signup_data"]["first_name"] : '';
    $last_name = isset($_SESSION["signup_data"]["last_name"]) ? $_SESSION["signup_data"]["last_name"] : '';
    $email = isset($_SESSION["signup_data"]["email"]) ? $_SESSION["signup_data"]["email"] : '';

    // Output input fields with values
    echo '<input type="text" name="first_name" placeholder="First Name" class="mt-4 form-control login-box mb-1" value="'. $first_name .'">';
    echo '<input type="text" name="last_name" placeholder="Last Name" class="form-control login-box mb-1" value="'. $last_name .'">';

    // Output email input field conditionally based on whether it exists in $_SESSION["signup_data"]
    if (!empty($email)) {
        echo '<input type="text" name="email" placeholder="Email" class="form-control login-box mb-1" value="'. $email .'">';
    } else {
        echo '<input type="text" name="email" placeholder="Email" class="form-control login-box mb-1">';
    }

    // Output password input field
    echo '<input type="password" name="password" id="password" placeholder="Password" class="form-control login-box mb-1">';
    echo '<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control login-box mb-1">';
}


function check_signup_errors(){
    if (isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];
        foreach($errors as $error){
            echo '<p class="form-error">' . $error . '</p>';
            // CHANGE THIS TO TOAST????
        }

        unset($_SESSION['errors_signup']);
    }else if (isset($_GET["signup"]) && $_GET["signup"] === "success"){
        echo '<p class="form-success">Signup success!</p>';
    }
}