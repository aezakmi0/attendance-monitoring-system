<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($email, $password)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $email);

        if (is_email_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        if (!is_email_wrong($result) && is_password_wrong($password, $result["password"])){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../welcome.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["user_ID"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["user_ID"];
        $_SESSION["user_email"] = $result["email"];
        $_SESSION["user_first_name"] = htmlspecialchars($result["first_name"]);
        $_SESSION["user_last_name"] = htmlspecialchars($result["last_name"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../index.php");
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