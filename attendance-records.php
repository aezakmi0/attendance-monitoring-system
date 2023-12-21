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
                  WHERE e.class_ID = $classId AND e.is_deleted = 0 ORDER BY s.last_name ASC";

$studentsResult = $conn->query($studentsQuery);

// Fetch attendance data from tb_attendance
$attendanceQuery = "SELECT student_ID, date, status FROM tb_attendance WHERE class_ID = $classId ORDER BY date ASC";
$attendanceResult = $conn->query($attendanceQuery);

// Organize attendance data by date and student_ID
$attendanceData = [];
while ($row = $attendanceResult->fetch_assoc()) {
    $attendanceData[$row['date']][$row['student_ID']] = $row['status'];
}

$datesQuery = "SELECT DISTINCT date FROM tb_attendance WHERE class_ID = $classId ORDER BY date ASC";
$datesResult = $conn->query($datesQuery);

// Organize dates by month
$months = [];
while ($row = $datesResult->fetch_assoc()) {
    $date = strtotime($row['date']);
    $month = date('F Y', $date);
    $day = date('j', $date);

    if (!isset($months[$month])) {
        $months[$month] = [];
    }

    $months[$month][] = $day;
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
        .status-warning{
            background-color: #ffb0b7 !important;
        }
        table{
            white-space: nowrap;
            width: 15%;
        }

        .label-text-dark{
            font-size: 13px;
            margin: 0;
            /* text-transform: uppercase; */
        }
        @media (max-width: 767px) {
            .table td.fit{
                white-space: nowrap;
                width: 15%;
                background-color: violet;
            }
        }
        .attendance-report-legend{
            /* width: 100px; */
            margin-right: 15px;
            /* border: 1px solid; */
        }
        .th-width{
            min-width: 40px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mt-5">    
        <?php include 'class-header.php'; ?>
    </div>
    <hr/>

    <div class="table-responsive text-center tableFixHead">
        <!-- <table class="table table-sm table-striped"> -->
        <table class="table table-sm table-hover table-striped table-bordered">
        <thead class="table-light">
            <tr class="align-middle">
                <th rowspan="2">ID Number</th>
                <th rowspan="2">Student Name</th>
                <?php
                // Generate header for each month
                foreach ($months as $month => $days) {
                    echo "<th colspan='" . count($days) . "'>$month</th>";
                }
                ?>
                <th colspan="4">Total</th>
            </tr>
            <tr>
                <?php
                // Generate header for each day
                foreach ($months as $days) {
                    foreach ($days as $day) {
                        echo "<th class=\"th-width\">$day</th>";
                    }
                }
                ?>
                <!-- 
                    class="border border-end-0 border-top-0 border-bottom-0 border-3"
                 -->
                <th class="th-width">P</th>
                <th class="th-width">A</th>
                <th class="th-width">L</th>
                <th class="th-width">E</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($student = $studentsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td class=\"fit\">{$student['ID_number']}</td>";
                echo "<td class=\"fit text-start\">{$student['last_name']}, {$student['first_name']}</td>";

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
                                    echo "<td>P</td>";
                                    break;
                                case 'absent':
                                    $absentCount++;
                                    echo "<td>A</td>";
                                    break;
                                case 'late':
                                    $lateCount++;
                                    echo "<td>L</td>";
                                    break;
                                case 'excused':
                                    $excusedCount++;
                                    echo "<td>E</td>";
                                    break;
                            }
                            // echo "<td>$status</td>";
                        }
                    }
                }
                
                if ($lateCount >= 3) { // 8
                    $NewlateCount = $lateCount % 3; //2
                    $absentCount += ($lateCount - $NewlateCount) / 3; 
                    $lateCount = $NewlateCount; 
                }

                echo "<td class=\"border border-end-0 border-top-0 border-bottom-0 border-2 border-secondary\">$presentCount</td>";
                if ($absentCount >= 7) {
                    echo "<td class=\"status-warning\"> $absentCount</td>";
                }else{
                    echo "<td>$absentCount</td>";
                }

                echo "<td>$lateCount</td>";
                echo "<td>$excusedCount</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        </table>  
        
    </div>
    <!-- End of table div -->

    <!-- <p class="label-text">NOTE:</p> -->
    <!-- <p class="label-text">P = Present, A = Absent, L = Late, E = Excused</p> -->
    <p class="label-text-dark text-italic"><b>NOTE:</b> Three lates are equivalent to one absence and are already included in the total number of absences.</p>
    <div class="d-flex">
        <p class="label-text-dark attendance-report-legend"><b>P</b> - Present</p>
        <p class="label-text-dark attendance-report-legend"><b>A</b> - Absent</p>
        <p class="label-text-dark attendance-report-legend"><b>L</b> - Late</p>
        <p class="label-text-dark attendance-report-legend"><b>E</b> - Excused</p>
    </div>
    <!-- <div class="legend-container d-flex align-items-center mt-2">
        <div class="legend-color"></div>
        <p class="label-text-2">PRESENT</p>
        <div class="legend-color-2"></div>
        <p class="label-text-2">ABSENT</p>
        <div class="legend-color-3"></div>
        <p class="label-text-2">LATE</p>
        <div class="legend-color-4"></div>
        <p class="label-text-2">EXCUSED</p>
    </div> -->

    <!-- Back Button -->
    <div class="d-flex justify-content-center mt-4">
        <a href="class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark m-1" value="Cancel">Back</a>
    </div>

</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
