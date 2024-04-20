<?php

require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php'; // Include the PDO connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ID = $_SESSION['user_id'];
    $id_number = $_POST["ID_number"];
    $first_name = ucwords(strtolower($_POST['first_name'])); // Capitalize first letter of each word
    $last_name = ucwords(strtolower($_POST['last_name'])); // Capitalize first letter of each word

    // Prepare the SQL statement
    $sql_student = "INSERT INTO tb_student (user_ID, ID_number, first_name, last_name) VALUES (?, ?, ?, ?)";
    $stmt_student = $pdo->prepare($sql_student);

    try {
        // Bind parameters and execute the statement
        $stmt_student->execute([$user_ID, $id_number, $first_name, $last_name]);

        $studentID = $pdo->lastInsertId();

        list($seatNumber, $classID) = assignNextAvailableSeat($pdo, $studentID);

        // Prepare the enrollment SQL statement
        $sql_enrollment = "INSERT INTO tb_enrollment (user_ID, student_ID, class_ID) VALUES (?, ?, ?)";
        $stmt_enrollment = $pdo->prepare($sql_enrollment);

        // Bind parameters and execute the statement
        $stmt_enrollment->execute([$user_ID, $studentID, $classID]);

        $_SESSION['success_message'] = 'Student successfully added!'; //Form submission successful
    } catch (PDOException $e) {
        echo "Failed to add student. Please try again.";
    }
}

header("Location: enroll-student.php?id=$classID");
exit;

function assignNextAvailableSeat($pdo, $studentID) {
    $user_ID = $_SESSION['user_id'];
    $classID = $_GET['id'];

    // Find the maximum seat number for the class
    $sql_max_seat = "SELECT MAX(seat_number) AS max_seat FROM tb_seatplan WHERE class_ID = ?";
    $stmt_max_seat = $pdo->prepare($sql_max_seat);
    $stmt_max_seat->execute([$classID]);
    $maxSeat = $stmt_max_seat->fetchColumn();

    // If there are no assigned seats, start from seat 1
    if ($maxSeat === null) {
        $nextSeatNumber = 1;
    } else {
        // Find the next available seat
        $sql_next_seat = "SELECT seat_number FROM tb_seatplan WHERE class_ID = ? ORDER BY seat_number ASC";
        $stmt_next_seat = $pdo->prepare($sql_next_seat);
        $stmt_next_seat->execute([$classID]);
        $assignedSeats = $stmt_next_seat->fetchAll(PDO::FETCH_COLUMN);

        // Find the first available seat
        $nextSeatNumber = 1;
        while (in_array($nextSeatNumber, $assignedSeats)) {
            $nextSeatNumber++;
        }

        // If all seats are assigned, increment the maximum seat number
        if ($nextSeatNumber > $maxSeat) {
            $nextSeatNumber = $maxSeat + 1;
        }
    }

    // Insert the student into the next available seat
    $sql_seatplan = "INSERT INTO tb_seatplan (user_ID, student_ID, seat_number, class_ID) VALUES (?, ?, ?, ?)";
    $stmt_seatplan = $pdo->prepare($sql_seatplan);
    $stmt_seatplan->execute([$user_ID, $studentID, $nextSeatNumber, $classID]);

    return [$nextSeatNumber, $classID];
}