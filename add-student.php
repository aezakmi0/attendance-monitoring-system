<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_number = $_POST["ID_number"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    $sql_student = "INSERT INTO tb_student (ID_number, first_name, last_name) VALUES ('$id_number', '$first_name', '$last_name')";
    $result_student = $conn->query($sql_student);

    if ($result_student) {
        $studentID = $conn->insert_id;

        list($seatNumber, $classID) = assignInitialSeatNumber($conn, $studentID);

        $sql_enrollment = "INSERT INTO tb_enrollment (student_ID, class_ID) VALUES ('$studentID', '$classID')";
        $result_enrollment = $conn->query($sql_enrollment);

        if ($result_enrollment) {
            // echo "success"; 
            $_SESSION['success_message'] = 'Student successfully added!';
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

function assignInitialSeatNumber($conn, $studentID) {
    $classID = $_GET['id'];

    $sql_max_seat = "SELECT MAX(seat_number) AS max_seat FROM tb_seatplan WHERE class_ID = '$classID'";
    $result_max_seat = $conn->query($sql_max_seat);
    $maxSeat = $result_max_seat->fetch_assoc()['max_seat'];

    $nextSeatNumber = $maxSeat + 1;

    $sql_seatplan = "INSERT INTO tb_seatplan (student_ID, seat_number, class_ID) VALUES ('$studentID', '$nextSeatNumber', '$classID')";
    $conn->query($sql_seatplan);

    return [$nextSeatNumber, $classID];
}
?>
