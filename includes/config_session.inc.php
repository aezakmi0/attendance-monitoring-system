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

// Start the session
session_start();

// Initialize last_regeneration if not set
if (!isset($_SESSION["last_regeneration"])) {
    $_SESSION["last_regeneration"] = time();
}

// Regenerate session ID if user is logged in
if (isset($_SESSION["user_id"])) {
    $interval = 60 * 30;
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id_loggedin();
    }
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id_loggedin(){
    session_write_close(); // Close the current session

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);
    session_start(); // Start the new session
    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id(){
    session_write_close(); // Close the current session
    session_start(); // Start a new session
    $_SESSION["last_regeneration"] = time();
}
