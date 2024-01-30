<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_ID = $_POST["student_ID"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    // Insert into tb_student
    $sql_student = "INSERT INTO tb_student (student_ID, first_name, last_name) VALUES ('$student_ID', '$first_name', '$last_name')";
    $conn->query($sql_student);

    // Retrieve the auto-incremented student_ID
    //$studentID = $conn->insert_id;

    // Assign initial seat_number and class_ID
    list($seatNumber, $classID) = assignInitialSeatNumber($conn, $student_ID);

    // Insert into tb_enrollment
    $sql_enrollment = "INSERT INTO tb_enrollment (student_ID, class_ID) VALUES ('$student_ID', '$classID')";

    // <!-- Add duplicate warning -->

    $conn->query($sql_enrollment);

    echo "Student added and enrolled in class!";
}

$conn->close();

header("Location: enroll-student.php?id=$classID");
exit;

function assignInitialSeatNumber($conn, $student_ID) {
    // Assuming $classID is already set or retrieved
    $classID = $_GET['id'];

    // Determine the next available seat_number (adjust as needed)
    $sql_max_seat = "SELECT MAX(seat_number) AS max_seat FROM tb_seatplan WHERE class_ID = '$classID'";
    $result_max_seat = $conn->query($sql_max_seat);
    $maxSeat = $result_max_seat->fetch_assoc()['max_seat'];

    $nextSeatNumber = $maxSeat + 1;

    // Insert into tb_seatplan
    $sql_seatplan = "INSERT INTO tb_seatplan (student_ID, seat_number, class_ID) VALUES ('$student_ID', '$nextSeatNumber', '$classID')";
    $conn->query($sql_seatplan);

    return [$nextSeatNumber, $classID];
}
?>



