<?php
// get_seat_assignments.php
require_once 'includes/dbh.inc.php';

// Get the class_ID from the URL
$classId = isset($_GET['classId']) ? $_GET['classId'] : null;

if ($classId !== null) {
    try {
        $sql = "SELECT tb_seatplan.seat_number, tb_student.student_ID, tb_student.first_name, tb_student.last_name
                FROM tb_seatplan
                INNER JOIN tb_student ON tb_seatplan.student_ID = tb_student.student_ID
                WHERE tb_seatplan.class_ID = ? AND tb_seatplan.is_deleted = 0";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$classId]);

        $seatAssignments = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $seatAssignments[$row['seat_number']] = array(
                'studentID' => $row['student_ID'],
                'firstName' => $row['first_name'],
                'lastName' => $row['last_name'],
            );
        }

        echo json_encode($seatAssignments);
    } catch (PDOException $e) {
        // Handle database error
        echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
    }
} else {
    echo json_encode(array());
}

// Close the database connection (not necessary for PDO)
// $pdo = null;
?>
