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

// Check if the class_ID is provided in the URL
if (isset($_GET['id'])) {
    $classID = $_GET['id'];

    // Fetch class details from the database
    $query = "SELECT * FROM tb_class WHERE class_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $classID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the class exists
    if ($result->num_rows > 0) {
        $classData = $result->fetch_assoc();
    } else {
        // Handle the case where the class is not found
        echo "Class not found!";
        exit;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle the case where class_ID is not provided
    echo "Class ID not provided!";
    exit;
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
    
    <div class="container">
        <form class="form-control mt-5 p-5" action="add-student.php?id=<?php echo $classID; ?>" method="post">
            <h1 class="text-center">Add Students</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="text" name="student_id" class="form-control" placeholder="Enter ID" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter Class Code" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                </div>
                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">ADD</p>
                    <button class="btn btn-primary w-100" type="submit" value="Submit">Add</button>
                </div>
            </div>

            <!-- Enrolled Students -->
            <div class="mt-5">
                <h1 class="text-center mb-2">Enrolled Students</h1>
                <table class="table table-hover">
                    <tr>
                    <th>STUDENT ID</th>
                    <th colspan="2">NAME</th>
                    </tr>
                    <?php
                        // Fetch enrolled students for the given classID
                        $enrolledQuery = "SELECT s.student_ID, s.first_name, s.last_name FROM tb_student s
                                        INNER JOIN tb_enrollment e ON s.student_ID = e.student_ID
                                        WHERE e.class_ID = ?";
                        $enrolledStmt = $db->prepare($enrolledQuery);
                        $enrolledStmt->bind_param("i", $classID);
                        $enrolledStmt->execute();
                        $enrolledResult = $enrolledStmt->get_result();

                        // Display enrolled students
                        while ($row = $enrolledResult->fetch_assoc()) {
                            echo "<tr class='align-middle'>";
                            echo "<td>{$row['student_ID']}</td>";
                            echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                            echo "<td class='text-end'>
                                    <a type='button' class='btn btn-sm btn-outline-secondary' href='edit-student.php?id=$classID&studentid={$row['student_ID']}'>Edit</a>
                                    <a type='button' class='btn btn-sm btn-danger' href='delete-student.php?id=$classID'>Remove</a>
                                </td>";
                            echo "</tr>";
                        }

                        // Close the prepared statement
                        $enrolledStmt->close();
                    ?>
                </table>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <!-- <a href="#" type="button" class="btn btn-outline-secondary m-1" onclick="history.back();">Back</a> -->
            <a href="class.php?id=<?php echo $classID; ?>" type="button" class="btn btn-outline-secondary m-1">Back</a>
            <!-- <a type="button" class="btn btn-primary m-1" href="class.php">Save</a> -->
        </div>
    </div>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>