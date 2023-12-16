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
    $id_number = $_POST["ID_number"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    // Insert into tb_student
    $sql_student = "INSERT INTO tb_student (ID_number, first_name, last_name) VALUES ('$id_number', '$first_name', '$last_name')";
    $conn->query($sql_student);

    // Retrieve the auto-incremented student_ID
    $studentID = $conn->insert_id;

    if (isset($_GET['id'])) {
        $classID = $_GET['id'];

        // Insert into tb_enrollment
        $sql_enrollment = "INSERT INTO tb_enrollment (student_ID, class_ID) VALUES ('$studentID', '$classID')";
        $conn->query($sql_enrollment);

        echo "Student added and enrolled in class!";
    } else {
        echo "Class ID not provided!";
    }
}

$conn->close();

header("Location: enroll-student.php?id=$classID");
exit;
?>
