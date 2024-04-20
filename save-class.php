<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_ID = $_SESSION['user_id'];
    $class_code = $_POST["class_code"];
    $class_name = $_POST["class_name"];
    $room = $_POST["room"];
    $time_start = $_POST["time_start"];
    $time_end = $_POST["time_end"];

    // Convert time_start to 24-hour format
    $time_start_24h = date("H:i:s", strtotime($time_start));

    // Convert time_end to 24-hour format
    $time_end_24h = date("H:i:s", strtotime($time_end));

    // Check if "day" key exists and is an array
    $selected_days = isset($_POST["day"]) && is_array($_POST["day"]) ? implode("", $_POST["day"]) : '';

    // SQL query to insert data into the database
    $sql = "INSERT INTO tb_class (user_ID, class_code, class_name, room, time_start, time_end, day)
            VALUES (:user_ID, :class_code, :class_name, :room, :time_start, :time_end, :selected_days)";

    try {
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':user_ID', $user_ID);
        $stmt->bindParam(':class_code', $class_code);
        $stmt->bindParam(':class_name', $class_name);
        $stmt->bindParam(':room', $room);
        $stmt->bindParam(':time_start', $time_start_24h);
        $stmt->bindParam(':time_end', $time_end_24h);
        $stmt->bindParam(':selected_days', $selected_days);

        // Execute the query
        if ($stmt->execute()) {
            // Retrieve the last inserted ID
            $last_insert_id = $pdo->lastInsertId();

            // Redirect to another page using the class_ID
            header("Location: enroll-student.php?id=" . $last_insert_id);
            exit();
        } else {
            echo "Error: Unable to execute the query.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
