// save_layout.php
<?php
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['layout'])) {
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

    // Update the database with the new seat arrangement
    $layout = json_decode($data['layout']);
    foreach ($layout as $index => $seatplanID) {
        $query = "UPDATE tb_seatplan SET seat_number = $index + 1 WHERE seatplan_ID = $seatplanID";
        mysqli_query($conn, $query);
    }

    // Close the database connection
    mysqli_close($conn);

    // Send a response
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Invalid data']);
}
?>
