<?php
require_once 'includes/check_session.inc.php';

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
        // Extract class code
        $classCode = $classData['class_code'];
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
    <title>Enroll Student</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->

    <!-- TOASTS -->
    <!-- <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex" id="liveToast">
            <div class="toast-body">Student added successfully!</div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div> -->

    <div class="container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="class.php?id=<?php echo $classID; ?>"><?php echo $classCode; ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
            </ol>
        </nav>
        <div class="d-flex">
            <a href="class.php?id=<?php echo $classID; ?>" class="btn btn-rounded"><svg
                    xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z" />
                </svg></a>
            <span id="classHeader"><?php include 'class-header.php'; ?></span>
        </div>
        <hr>
        <form class="form-control p-5 bg-light" action="add-student.php?id=<?php echo $classID; ?>" method="post">
            <h1 class="text-center">Add Student</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="number" name="ID_number" class="form-control input-border" placeholder="Enter ID"
                        required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" name="last_name" class="form-control input-border" placeholder="Enter Last Name"
                        required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" name="first_name" class="form-control input-border"
                        placeholder="Enter First Name" required>
                </div>

                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">ADD</p>
                    <button class="btn input-border create-class-button w-100" id="addStudentBtn" type="submit"
                        value="Submit">Add</button>
                </div>
            </div>
        </form>


        <div class="form-control p-5 bg-light mt-3">
            <!-- Enrolled Students -->
            <h1 class="text-center mb-4">Enrolled Students</h1>
            <!-- Search student -->
            <div class="mb-3 mx-auto" style="max-width: 600px !important;">
                <div class="input-group">
                    <input type="text" class="form-control input-border" oninput="searchStudent(this.value)"
                        placeholder="Enter student's name">
                    <span class="input-group-text input-border"
                        style="border-left: none !important; background-color: #227710;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" class="bi bi-search"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>
                </div>
            </div>
            <!-- End search student -->
            <table class="table table-sm table-hover table-light">
                <tr>
                    <th>STUDENT ID</th>
                    <th colspan="2">NAME</th>
                </tr>
                <?php
                // Fetch enrolled students for the given classID
                $enrolledQuery = "SELECT s.student_ID, s.ID_number, s.first_name, s.last_name, c.class_code
                                FROM tb_enrollment e
                                INNER JOIN tb_student s ON s.student_ID = e.student_ID
                                INNER JOIN tb_class c ON c.class_ID = e.class_ID
                                WHERE e.class_ID = ? AND e.is_deleted = 0
                                ORDER BY s.last_name ASC";

                $enrolledStmt = $db->prepare($enrolledQuery);
                $enrolledStmt->bind_param("i", $classID);
                $enrolledStmt->execute();
                $enrolledResult = $enrolledStmt->get_result();

                // Display enrolled students
                while ($row = $enrolledResult->fetch_assoc()) {
                    $firstName = ucwords(strtolower($row['first_name'])); // Capitalize first letter of each word
                    $lastName = ucwords(strtolower($row['last_name'])); // Capitalize first letter of each word
                
                    echo "<tr class='align-middle'>";
                    echo "<td>{$row['ID_number']}</td>";
                    echo "<td>{$lastName}, {$firstName}</td>";
                    echo "<td class='text-end'>
                            <a type='button' class='btn btn-sm btn-outline-dark  btn-rounded' href='edit-student.php?id={$classID}&studentid={$row['student_ID']}'>Edit</a>
                            <a type='button' class='btn btn-sm btn-danger btn-rounded' data-bs-toggle='modal' data-bs-target='#deleteModal' data-student-id='{$row['student_ID']}' data-student-name='{$lastName}, {$firstName}'>Remove</a>
                        </td>";
                    echo "</tr>";
                }

                // Close the prepared statement
                $enrolledStmt->close();
                ?>
            </table>
        </div>
    </div>

    <!-- TOAST CONTAINER -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer">
    </div>

    <!-- Delete Class Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="color: #f2163e;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                        aria-label="Warning:">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <h5 class="modal-title" id="deleteModalLabel">Remove Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="font-weight: 700; color: #f2163e;" id="studentNameToDelete"></p>
                    <p style="font-size: 14px; color: #575757;">Once a student is removed from the class, the student's
                        attendance record will also be removed and it cannot be retrieved, so please proceed with
                        caution.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Remove Student</button>
                </div>
            </div>
        </div>
    </div>
    <!-- href='delete_student.php?id=$classID&studentid={$row['student_ID']}' onclick=\"return confirm('Are you sure you want to remove {$lastName}, {$firstName} on class {$row['class_code']}?')\" -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var studentId = button.data('student-id');
            var studentName = button.data('student-name');
            console.log(studentName);
            var modal = $(this);
            modal.find('#studentNameToDelete').text('Are you sure you want to remove ' + studentName + 'on <?php echo $classCode; ?> ?' );
            modal.find('#confirmDeleteBtn').attr('data-student-id', studentId);
        });

        $('#confirmDeleteBtn').on('click', function () {
            var studentId = $(this).data('student-id');
            // window.location.href = "delete_student.php?id=" + studentId;
            window.location.href = "delete_student.php?id=<?php echo $classId . '&studentid='?>" + studentId;
        });

        document.addEventListener('DOMContentLoaded', function () {
            <?php
            // Check if a success message is set
            if (isset($_SESSION['success_message'])) {
                // Display the toast message
                echo 'showToast("' . $_SESSION['success_message'] . '");';

                // Clear the session variable to avoid displaying the message again on subsequent visits
                unset($_SESSION['success_message']);
            }
            ?>
        });
        function searchStudent(keyword) {
            // Get the table rows
            var rows = document.querySelectorAll('.table tr');

            // Iterate through each row
            for (var i = 1; i < rows.length; i++) {
                var studentName = rows[i].querySelector('td:nth-child(2)').textContent.toLowerCase();

                // Check if the student name contains the keyword
                if (studentName.includes(keyword.toLowerCase())) {
                    rows[i].style.display = ''; // Show the row
                } else {
                    rows[i].style.display = 'none'; // Hide the row
                }
            }
        }
    </script>


</body>

</html>