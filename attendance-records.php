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

// Get the class_ID from the URL
$classId = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch student data from tb_student using a JOIN with tb_enrollment
$studentsQuery = "SELECT s.student_ID, s.ID_number, s.first_name, s.last_name 
                  FROM tb_student s
                  JOIN tb_enrollment e ON s.student_ID = e.student_ID
                  WHERE e.class_ID = $classId AND e.is_deleted = 0";

$studentsResult = $conn->query($studentsQuery);

// Fetch attendance data from tb_attendance
$attendanceQuery = "SELECT student_ID, date, status FROM tb_attendance WHERE class_ID = $classId";
$attendanceResult = $conn->query($attendanceQuery);

// Organize attendance data by date and student_ID
$attendanceData = [];
while ($row = $attendanceResult->fetch_assoc()) {
    $attendanceData[$row['date']][$row['student_ID']] = $row['status'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Code</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .table td.fit{
            white-space: nowrap;
            width: 15%;
        }
        .status-warning{
            background-color: #ffb0b7 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-5">    
        <?php include 'class-header.php'; ?>
    </div>
    <hr/>

    <div class="table-responsive text-center">
        <!-- <table class="table table-sm table-striped"> -->
        <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr class="align-middle">
                <th rowspan="2">ID Number</th>
                <th rowspan="2">Student Name</th>
                <!-- Months -->
                <th colspan="9">November 2023</th>  <!-- colspan is equals to the total count of days in the month -->
                <th colspan="6">December 2023</th>
                <th colspan="4">Total</th>
            </tr>
            <tr>
                <th>1</th>
                <th>6</th>
                <th>8</th>
                <th>13</th>
                <th>15</th>
                <th>20</th>
                <th>22</th>
                <th>27</th>
                <th>29</th>
                <th>4</th>
                <th>6</th>
                <th>11</th>
                <th>13</th>
                <th>18</th>
                <th>20</th>
                <th>P</th>
                <th>A</th>
                <th>L</th>
                <th>E</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($student = $studentsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$student['ID_number']}</td>";
                echo "<td class='fit'>{$student['last_name']}, {$student['first_name']}</td>";

                // Loop through each date
                $presentCount = 0;
                $absentCount = 0;
                $lateCount = 0;
                $excusedCount = 0;

                foreach ($attendanceData as $date => $statuses) {
                    // Loop through each student for the current date
                    foreach ($statuses as $studentID => $status) {
                        if ($studentID == $student['student_ID']) {
                            switch ($status) {
                                case 'present':
                                    $presentCount++;
                                    break;
                                case 'absent':
                                    $absentCount++;
                                    break;
                                case 'late':
                                    $lateCount++;
                                    break;
                                case 'excused':
                                    $excusedCount++;
                                    break;
                            }
                            echo "<td>$status</td>";
                        }
                    }

                }
                echo "<td>$presentCount</td>";
                echo "<td>$absentCount</td>";
                echo "<td>$lateCount</td>";
                echo "<td>$excusedCount</td>";

                echo "</tr>";
            }
            ?>
        </tbody>
        </table>    
    </div>
    <!-- End of table div -->
    
</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
