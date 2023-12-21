<?php
require_once('Tcpdf.php');

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Attendance Report');
$pdf->SetHeaderData('', 0, 'Attendance Report', '');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('times', '', 12);

// HTML content
$html = '
<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mt-5">    
        <?php include \'class-header.php\'; ?>
        <div class="text-end">
            <a href="#" type="button" class="btn btn-outline-dark btn-rounded btn-green">Generate Report</a>
        </div>
    </div>
    <hr/>

    <div class="table-responsive text-center tableFixHead">
        <table class="table table-sm table-hover table-striped table-bordered">
        <thead class="table-light">
            <tr class="align-middle">
                <th rowspan="2">ID Number</th>
                <th rowspan="2">Student Name</th>
                <?php
                foreach ($months as $month => $days) {
                    echo "<th colspan=\'" . count($days) . "\'>$month</th>";
                }
                ?>
                <th colspan="4">Total</th>
            </tr>
            <tr>
                <?php
                foreach ($months as $days) {
                    foreach ($days as $day) {
                        echo "<th class=\"th-width\">$day</th>";
                    }
                }
                ?>
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
                echo "<td class=\"fit\">{$student[\'ID_number\']}</td>";
                echo "<td class=\"fit text-start\"><b>{$student[\'last_name\']}, {$student[\'first_name\']}</b></td>";

                // Loop through each date
                $presentCount = 0;
                $absentCount = 0;
                $lateCount = 0;
                $excusedCount = 0;

                foreach ($attendanceData as $date => $statuses) {
                    foreach ($statuses as $studentID => $status) {
                        if ($studentID == $student[\'student_ID\']) {
                            switch ($status) {
                                case \'present\':
                                    $presentCount++;
                                    echo "<td>P</td>";
                                    break;
                                case \'absent\':
                                    $absentCount++;
                                    echo "<td>A</td>";
                                    break;
                                case \'late\':
                                    $lateCount++;
                                    echo "<td>L</td>";
                                    break;
                                case \'excused\':
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
    <p class="label-text-dark"><b>NOTE: </b>Three instances of being late are considered equivalent to one absence and will be included in the total number of absences if and when they occur.</p>
    <div class="d-flex">
        <p class="label-text-dark attendance-report-legend"><b>P</b> - Present</p>
        <p class="label-text-dark attendance-report-legend"><b>A</b> - Absent</p>
        <p class="label-text-dark attendance-report-legend"><b>L</b> - Late</p>
        <p class="label-text-dark attendance-report-legend"><b>E</b> - Excused</p>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a href="class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-black m-1" value="Cancel">Back</a>
    </div>

</div>';

// Output the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF as a file (you can change the file name and path)
$pdf->Output('attendance_report.pdf', 'D');
?>
