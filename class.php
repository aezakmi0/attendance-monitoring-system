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

if ($classId) {
    // Fetch student data for the specified class_ID
    $query = "SELECT tb_student.first_name, tb_student.last_name
              FROM tb_enrollment
              JOIN tb_student ON tb_enrollment.student_ID = tb_student.student_ID
              WHERE tb_enrollment.class_ID = $classId
              LIMIT 50"; // Limit to 50 students

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are results
    if ($result) {
        // Fetch the data as an associative array
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Close the database connection
        mysqli_close($conn);
    }
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
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
    <div class="container" style="background-color: rgb(255, 255, 255);">
        <div class="text-center pt-4">
            <!-- <h1 class="class-code-lg">CS-ITE 313</h1>
            <p class="class-name">Web Systems and Technology | 3:00PM-5:00PM TF</p> -->
            <?php include 'class-header.php'; ?>
        </div>
        <!-- <hr class="hr" /> -->
        <div class="d-flex justify-content-center">    
            <a href="edit-seatplan.html" type="button" class="btn m-1 btn-secondary">Edit Seatplan</a>
            <a href="enroll-student.php?id=<?php echo $classId; ?>" type="button" class="btn m-1 btn-secondary">Enroll Student</a>
            <a href="edit-class.php?id=<?php echo $classId; ?>" type="button" class="btn m-1 btn-secondary">Edit Class</a>
            <a href="#" type="button" class="btn m-1 btn-secondary">Generate Report</a>
            <a href="#" type="button" class="btn m-1 btn-danger">Delete Class</a>
        </div>
        <hr class="hr" />
        <div class="d-flex justify-content-between">
            <p>December 1, 2023</p>
            <p>5:36 PM</p>
        </div>
    </div>
    
    <!-- seatplan layout -->
    <div class="container seatplan-main-container">
        <div class="my-grid">
            <?php
            // Loop through the first 25 seats and display student names
            for ($i = 0; $i < 25; $i++) {
                echo '<div class="seatplan-seat">';
                echo '<div class="seatplan-seat-content">';
                
                // Check if there is a student for this seat
                if (isset($students[$i])) {
                    echo '<p class="seatplan-lastname">' . $students[$i]['last_name'] . '</p>';
                    echo '<p class="seatplan-firstname">' . $students[$i]['first_name'] . '</p>';
                } else {
                    // Display empty seat
                    echo '<p class="seatplan-lastname"></p>';
                    echo '<p class="seatplan-firstname"></p>';
                }

                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <div class="my-grid">
            <?php
            // Loop through the next 25 seats and display student names
            for ($i = 25; $i < 50; $i++) {
                echo '<div class="seatplan-seat">';
                echo '<div class="seatplan-seat-content">';
                
                // Check if there is a student for this seat
                if (isset($students[$i])) {
                    echo '<p class="seatplan-lastname">' . $students[$i]['last_name'] . '</p>';
                    echo '<p class="seatplan-firstname">' . $students[$i]['first_name'] . '</p>';
                } else {
                    // Display empty seat
                    echo '<p class="seatplan-lastname"></p>';
                    echo '<p class="seatplan-firstname"></p>';
                }

                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a type="button" class="btn btn-primary m-1 mb-2" href="#">Save Attendance</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
