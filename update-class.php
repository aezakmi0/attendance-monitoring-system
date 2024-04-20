<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $classId = $_POST['class_id'];
    $classCode = $_POST['class_code'];
    $className = $_POST['class_name'];
    $room = $_POST['room'];
    $timeStart = convert12to24($_POST['time_start']);
    $timeEnd = convert12to24($_POST['time_end']);
    $selectedDays = isset($_POST["day"]) && is_array($_POST["day"]) ? implode("", $_POST["day"]) : '';

    // SQL query to update class information
    $sql = "UPDATE tb_class 
            SET class_code = :class_code, 
                class_name = :class_name, 
                room = :room,   
                time_start = :time_start, 
                time_end = :time_end, 
                day = :selected_days 
            WHERE class_ID = :class_id";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':class_code', $classCode);
    $stmt->bindParam(':class_name', $className);
    $stmt->bindParam(':room', $room);
    $stmt->bindParam(':time_start', $timeStart);
    $stmt->bindParam(':time_end', $timeEnd);
    $stmt->bindParam(':selected_days', $selectedDays);
    $stmt->bindParam(':class_id', $classId);

    // Execute the update
    $stmt->execute();

    // Set success message
    $_SESSION['success_message'] = 'Class information updated successfully!';
} else {
    // Set error message if form is not submitted
    $_SESSION['error_message'] = 'Unable to update class information. Please try again later or contact support for assistance.';
}

// Redirect back to the class page
header("Location: class.php?id=$classId");
exit();

// Function to convert 12-hour time to 24-hour format
function convert12to24($time12) {
    return date("H:i", strtotime($time12));
}
