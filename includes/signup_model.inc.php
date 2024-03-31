<?php

declare(strict_types=1);

function get_email(object $pdo, string $email){
    $query = "SELECT email FROM tb_user WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}

function set_user(object $pdo, string $first_name, string $last_name, string $email, string $password){
    $query = "INSERT INTO tb_user (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":password", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
 }

 function get_user_id($pdo, $email) {
    $sql = "SELECT user_id FROM tb_user WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['user_id'];
}