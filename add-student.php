<?php

require_once 'includes/check_session.inc.php';

$servername = "server1319";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$dbname = "u341493210_db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ID = $_SESSION['user_id'];
    $id_number = $_POST["ID_number"];
    $first_name = ucwords(strtolower($_POST['first_name'])); // Capitalize first letter of each word
    $last_name = ucwords(strtolower($_POST['last_name'])); // Capitalize first letter of each word

    $sql_student = "INSERT INTO tb_student (user_ID, ID_number, first_name, last_name) VALUES ('$user_ID', '$id_number', '$first_name', '$last_name')";
    $result_student = $conn->query($sql_student);

    if ($result_student) {
        $studentID = $conn->insert_id;

        list($seatNumber, $classID) = assignNextAvailableSeat($conn, $studentID);

        $sql_enrollment = "INSERT INTO tb_enrollment (user_ID, student_ID, class_ID) VALUES ('$user_ID', '$studentID', '$classID')";
        $result_enrollment = $conn->query($sql_enrollment);

        if ($result_enrollment) {
            // echo "success"; 
            $_SESSION['success_message'] = 'Student successfully added!'; //Form submission successful
        } else {
            echo "Failed to enroll student. Please try again.";
        }
    } else {
        echo "Failed to add student. Please try again.";
    }
}

$conn->close();
header("Location: enroll-student.php?id=$classID");
exit;

function assignNextAvailableSeat($conn, $studentID) {
    $user_ID = $_SESSION['user_id'];
    $classID = $_GET['id'];

    // Find the maximum seat number for the class
    $sql_max_seat = "SELECT MAX(seat_number) AS max_seat FROM tb_seatplan WHERE class_ID = '$classID'";
    $result_max_seat = $conn->query($sql_max_seat);
    $maxSeat = $result_max_seat->fetch_assoc()['max_seat'];

    // If there are no assigned seats, start from seat 1
    if ($maxSeat === null) {
        $nextSeatNumber = 1;
    } else {
        // Find the next available seat
        $sql_next_seat = "SELECT seat_number FROM tb_seatplan WHERE class_ID = '$classID' ORDER BY seat_number ASC";
        $result_next_seat = $conn->query($sql_next_seat);

        $assignedSeats = [];
        while ($row = $result_next_seat->fetch_assoc()) {
            $assignedSeats[] = $row['seat_number'];
        }

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
    $sql_seatplan = "INSERT INTO tb_seatplan (user_ID, student_ID, seat_number, class_ID) VALUES ('$user_ID', '$studentID', '$nextSeatNumber', '$classID')";
    $conn->query($sql_seatplan);

    return [$nextSeatNumber, $classID];
}

