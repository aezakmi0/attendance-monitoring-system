<?php 
error_log('PDF generation started');
ob_end_clean();
require('fpdf/fpdf.php');

header('Content-Type: application/pdf');

// Instantiate and use the FPDF class
$pdf = new FPDF();
$pdf->AddPage();

// Set the font for the text
$pdf->SetFont('Arial', '', 11);

// Include the function to generate the table
include 'attendance-records.php';

// Fetch the class ID from the URL
$classId = isset($_GET['id']) ? $_GET['id'] : null;

ob_end_clean(); 
require('fpdf/fpdf.php'); 
  
// Instantiate and use the FPDF class  
$pdf = new FPDF(); 

//Add a new page 
$pdf->AddPage(); 
  
// Set the font for the text 
$pdf->SetFont('Arial', '', 11); 
  
function generateTable($studentsResult, $months, $attendanceData) {
    $html = '<table class="table table-sm table-hover table-striped table-bordered">
        <thead class="table-light">
            <tr class="align-middle">
                <th rowspan="2">ID Number</th>
                <th rowspan="2">Student Name</th>';
    
    // Generate header for each month
    foreach ($months as $month => $days) {
        $html .= "<th colspan='" . count($days) . "'>$month</th>";
    }
    
    $html .= '<th colspan="4">Total</th>
            </tr>
            <tr>';
    
    // Generate header for each day
    foreach ($months as $days) {
        foreach ($days as $day) {
            $html .= "<th class=\"th-width\">$day</th>";
        }
    }
    
    $html .= '<th class="th-width">P</th>
                <th class="th-width">A</th>
                <th class="th-width">L</th>
                <th class="th-width">E</th>
            </tr>
        </thead>
        <tbody>';

    while ($student = $studentsResult->fetch_assoc()) {
        $html .= "<tr>";
        $html .= "<td class=\"fit\">{$student['ID_number']}</td>";
        $html .= "<td class=\"fit text-start\"><b>{$student['last_name']}, {$student['first_name']}</b></td>";

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
                            $html .= "<td>P</td>";
                            break;
                        case 'absent':
                            $absentCount++;
                            $html .= "<td>A</td>";
                            break;
                        case 'late':
                            $lateCount++;
                            $html .= "<td>L</td>";
                            break;
                        case 'excused':
                            $excusedCount++;
                            $html .= "<td>E</td>";
                            break;
                    }
                }
            }

            // If the student has no status for the current date, output a blank <td>
            if (!$hasStatus) {
                $html .= "<td></td>";
            }
        }

        if ($lateCount >= 3) {
            $NewlateCount = $lateCount % 3;
            $absentCount += ($lateCount - $NewlateCount) / 3;
            $lateCount = $NewlateCount;
        }

        $html .= "<td class=\"border border-end-0 border-top-0 border-bottom-0 border-2 border-secondary\">$presentCount</td>";
        if ($absentCount >= 7) {
            $html .= "<td class=\"status-warning\"> $absentCount</td>";
        } else {
            $html .= "<td>$absentCount</td>";
        }

        $html .= "<td>$lateCount</td>";
        $html .= "<td>$excusedCount</td>";
        $html .= "</tr>";
    }

    $html .= '</tbody></table>';
    
    return $html;
}


// Output the table to the PDF
$pdf->WriteHTML(generateTable($studentsResult, $months, $attendanceData));

// Output PDF
$pdf->Output();
?>