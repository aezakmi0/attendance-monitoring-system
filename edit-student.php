<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Check if the class_ID and student_ID are provided in the URL
if (isset($_GET['id']) && isset($_GET['studentid'])) {
    $classID = $_GET['id'];
    $studentID = $_GET['studentid'];

    // Fetch student details from the database
    $query = "SELECT * FROM tb_student WHERE student_ID = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$studentID]);
    $studentData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the student exists
    if (!$studentData) {
        // Handle the case where the student is not found
        echo "Student not found!";
        exit;
    }
} else {
    // Handle the case where class_ID or student_ID is not provided
    echo "Class ID or Student ID not provided!";
    exit;
}

// Handle form submission for editing student details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated student details from the form
    $updatedIDNumber = $_POST['id_number'];
    $updatedFirstName = $_POST['first_name'];
    $updatedLastName = $_POST['last_name'];

    // Update student details in the database
    $updateQuery = "UPDATE tb_student SET ID_number = ?, first_name = ?, last_name = ? WHERE student_ID = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$updatedIDNumber, $updatedFirstName, $updatedLastName, $studentID]);

    if ($updateStmt) {
        // Redirect only after successful update
        $_SESSION['success_message'] = 'Student information updated successfully!';
        header("Location: enroll-student.php?id=$classID");
        exit;
    } else {
        // Handle the case where the update fails
        echo "Error updating student details: " . $updateStmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <form class="form-control bg-light mt-5 p-5" action="" method="post">
            <h1 class="text-center">Edit Student</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="text" name="id_number" class="form-control input-border" value="<?php echo $studentData['ID_number']; ?>" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" name="last_name" class="form-control input-border" value="<?php echo $studentData['last_name']; ?>" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" name="first_name" class="form-control input-border" value="<?php echo $studentData['first_name']; ?>" required>
                </div>
                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">EDIT</p>
                    <button class="btn input-border create-class-button w-100" type="submit" value="Submit">Save Changes</button>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="enroll-student.php?id=<?php echo $classID; ?>" type="button" class="btn btn-sm btn-outline-dark btn-black m-1">Back</a>
        </div>
    </div>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>