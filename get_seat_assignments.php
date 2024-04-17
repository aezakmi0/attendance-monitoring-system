<?php
// get_seat_assignments.php

$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$dbname = "u341493210_db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the class_ID from the URL
$classId = isset($_GET['classId']) ? $_GET['classId'] : null;

if ($classId !== null) {
    $sql = "SELECT tb_seatplan.seat_number, tb_student.student_ID, tb_student.first_name, tb_student.last_name
            FROM tb_seatplan
            INNER JOIN tb_student ON tb_seatplan.student_ID = tb_student.student_ID
            WHERE tb_seatplan.class_ID = $classId AND tb_seatplan.is_deleted = 0";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $seatAssignments = array();
        while ($row = $result->fetch_assoc()) {
            $seatAssignments[$row['seat_number']] = array(
                'studentID' => $row['student_ID'],
                'firstName' => $row['first_name'],
                'lastName' => $row['last_name'],
            );
        }

        echo json_encode($seatAssignments);
    } else {
        echo json_encode(array());
    }
} else {
    echo json_encode(array());
}

$conn->close();
?>
