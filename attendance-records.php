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
    <title>Attendance Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mt-5">    
        <div class="d-flex">
            <a href="class.php?id=<?php echo $classId; ?>" class="btn btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z"/></svg></a>
            <span id="classHeader"><?php include 'class-header.php'; ?></span>
        </div>    
        <div class="text-end">
            <!-- <a href="generate_pdf.php?id=<?php echo $classId; ?>" type="button" id="generatePDF" class="btn btn-outline-dark btn-rounded btn-green">Generate Report</a> -->
            <!-- <a href="generate_pdf.php" type="button" class="btn btn-outline-dark btn-rounded btn-green">Generate Report</a> -->
            <a href="#" type="button" id="generatePDF" class="btn btn-outline-dark btn-rounded btn-green">Print Report</a>

        </div>
    </div>
    <hr/>

    <div class="table-responsive text-center tableFixHead" id="makepdf">
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
                echo "<td class=\"fit text-start td-student\">{$student['last_name']}, {$student['first_name']}</td>";

                // Loop through each date
                $presentCount = 0;
                $absentCount = 0;
                $lateCount = 0;
                $excusedCount = 0;

                foreach ($attendanceData as $date => $statuses) {
                    // Flag to check if the student has a status for the current date
                    $hasStatus = false;

                    // Loop through each student for the current date
                    foreach ($statuses as $studentID => $status) {
                        if ($studentID == $student['student_ID']) {
                            $hasStatus = true;
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
                        }
                    }

                    // If the student has no status for the current date, output a blank <td>
                    if (!$hasStatus) {
                        echo "<td></td>";
                    }
                }

                if ($lateCount >= 3) {
                    $NewlateCount = $lateCount % 3;
                    $absentCount += ($lateCount - $NewlateCount) / 3;
                    $lateCount = $NewlateCount;
                }

                echo "<td class=\"border border-end-0 border-top-0 border-bottom-0 border-2 border-secondary\">$presentCount</td>";
                if ($absentCount >= 7) {
                    echo "<td class=\"status-warning\"> $absentCount</td>";
                } else {
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
    <p class="label-text-dark"><b>NOTE: </b>Three instances of being late are considered equivalent to one absence and will be included in the total number of absences if and when they occur.</p>
    <div class="d-flex">
        <p class="label-text-dark attendance-report-legend"><b>P</b> - Present</p>
        <p class="label-text-dark attendance-report-legend"><b>A</b> - Absent</p>
        <p class="label-text-dark attendance-report-legend"><b>L</b> - Late</p>
        <p class="label-text-dark attendance-report-legend"><b>E</b> - Excused</p>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<script>
    let button = document.getElementById("generatePDF");

    button.addEventListener("click", function () {
        let printWindow = window.open("", "_blank");
        printWindow.document.write('<html><head><title>Attendance Report</title>');
        printWindow.document.write('<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">');
        printWindow.document.write('</head><body>');
        printWindow.document.write(document.getElementById("classHeader").innerHTML);
        printWindow.document.write('<h3 class=\"text-center\">Attendance Report</h3>');
        printWindow.document.write(document.getElementById("makepdf").outerHTML);
        printWindow.document.write("<b>NOTE: </b>Three instances of being late are considered equivalent to one absence and will be included in the total number of absences if and when they occur.");
        printWindow.document.write("<br><b>P</b>-Present, <b>A</b>-Absent, <b>L</b>-Late, and <b>E</b>-Excused");
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    });
</script>


</body>
</html>
