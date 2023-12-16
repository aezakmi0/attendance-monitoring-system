<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_attendance";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the class_ID and student_ID are provided in the URL
if (isset($_GET['id']) && isset($_GET['studentid'])) {
    $classID = $_GET['id'];
    $studentID = $_GET['studentid'];

    // Fetch student details from the database
    $query = "SELECT * FROM tb_student WHERE student_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the student exists
    if ($result->num_rows > 0) {
        $studentData = $result->fetch_assoc();
    } else {
        // Handle the case where the student is not found
        echo "Student not found!";
        exit;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle the case where class_ID or student_ID is not provided
    echo "Class ID or Student ID not provided!";
    exit;
}

// Handle form submission for editing student details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated student details from the form
    $updatedFirstName = $_POST['first_name'];
    $updatedLastName = $_POST['last_name'];

    // Update student details in the database
    $updateQuery = "UPDATE tb_student SET first_name = ?, last_name = ? WHERE student_ID = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param("ssi", $updatedFirstName, $updatedLastName, $studentID);

    if ($updateStmt->execute()) {
        // Redirect only after successful update
        header("Location: enroll-student.php?id=$classID");
        exit;
    } else {
        // Handle the case where the update fails
        echo "Error updating student details: " . $updateStmt->error;
    }

    // Close the prepared statement
    $updateStmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <form class="form-control mt-5 p-5" action="" method="post">
            <h1 class="text-center">Edit Student</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="text" name="student_id" class="form-control" value="<?php echo $studentData['student_ID']; ?>" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $studentData['first_name']; ?>" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $studentData['last_name']; ?>" required>
                </div>
                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">EDIT</p>
                    <button class="btn btn-primary w-100" type="submit" value="Submit">Save Changes</button>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="enroll-student.php?id=<?php echo $classID; ?>" type="button" class="btn btn-outline-secondary m-1">Back</a>
        </div>
    </div>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>