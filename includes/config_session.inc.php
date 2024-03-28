<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

// Regenerate session ID if user is logged in
if (isset($_SESSION["user_id"])) {
    if (isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin();
    } else {
        $_SESSION["last_regeneration"] = time();
    }
    
    $interval = 60 * 30;
    if (isset($_SESSION["last_regeneration"]) && time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id_loggedin();
    }
} else {
    // Regenerate session ID for non-logged-in users
    if (isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else {
        $_SESSION["last_regeneration"] = time();
    }
    
    $interval = 60 * 30;
    if (isset($_SESSION["last_regeneration"]) && time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id_loggedin(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

// if (isset($_SESSION["last_regeneration"])) {
//     regenerate_session_id();
// }else {
//     $interval = 60 * 30;
//     if (time() - $_SESSION["last_regeneration"] >= $interval){
//         regenerate_session_id();
//     }
// }

// if (isset($_SESSION["user_id"])){
//     if (isset($_SESSION["last_regeneration"])) {
//         regenerate_session_id_loggedin();
//     } else {
//         // If the session key is not set, set it with the current time
//         $_SESSION["last_regeneration"] = time();
//     }
    
//     $interval = 60 * 30;
//     if (isset($_SESSION["last_regeneration"]) && time() - $_SESSION["last_regeneration"] >= $interval) {
//         regenerate_session_id_loggedin();
//     }
// }else {
//     if (isset($_SESSION["last_regeneration"])) {
//         regenerate_session_id();
//     } else {
//         // If the session key is not set, set it with the current time
//         $_SESSION["last_regeneration"] = time();
//     }
    
//     $interval = 60 * 30;
//     if (isset($_SESSION["last_regeneration"]) && time() - $_SESSION["last_regeneration"] >= $interval) {
//         regenerate_session_id();
//     }
// }

// if (isset($_SESSION["last_regeneration"])) {
//     regenerate_session_id();
// } else {
//     // If the session key is not set, set it with the current time
//     $_SESSION["last_regeneration"] = time();
// }

// $interval = 60 * 30;
// if (isset($_SESSION["last_regeneration"]) && time() - $_SESSION["last_regeneration"] >= $interval) {
//     regenerate_session_id();
// }

// function regenerate_session_id(){
//     session_regenerate_id(true);
//     $_SESSION["last_regeneration"] = time();
// }
// function regenerate_session_id_loggedin(){
//     session_regenerate_id(true);

//     $userId = $_SESSION["user_id"];
//     $newSessionId = session_create_id();
//     $sessionId = $newSessionId . "_" . $userId;
//     session_id($sessionId);
    

//     $_SESSION["last_regeneration"] = time();
// }