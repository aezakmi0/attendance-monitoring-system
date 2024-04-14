<?php

// Define a function to update user information in the database
function update_user_info($pdo, $first_name, $last_name, $email, $user_id) {
    // Prepare SQL statement
    $stmt = $pdo->prepare("UPDATE tb_user SET first_name = ?, last_name = ?, email = ? WHERE user_ID = ?");
    
    // Bind parameters
    $stmt->bindParam(1, $first_name);
    $stmt->bindParam(2, $last_name);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $user_id);

    // Execute the statement
    $stmt->execute();
}
function update_user_password($pdo, $email, $new_password) {
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement
    $stmt = $pdo->prepare("UPDATE tb_user SET password = ? WHERE email = ?");
    
    // Bind parameters
    $stmt->bindParam(1, $hashed_password);
    $stmt->bindParam(2, $email);

    // Execute the statement
    $stmt->execute();
}


// Define a function to check if the provided password is correct
function is_password_correct($password, $hashed_password) {
    // Verify if the provided password matches the hashed password
    return password_verify($password, $hashed_password);
}

function is_new_password_correct($newPassword, $confirmPassword) {
    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        return false;
    }else{
        return true;
    }
}

function is_new_password_empty($newPassword, $confirmPassword){
    if (empty($newPassword) && empty($confirmPassword)) {
        return true;
    }else{
        return false;
    }
}