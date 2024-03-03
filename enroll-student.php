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
<?php
// Check if the form was submitted successfully
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your existing code to add the student goes here

    // Show the success toast
    echo "<script>
            $(document).ready(function(){
                $('#successToast').toast('show');
            });
        </script>";
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
        <div class="d-flex mt-5">
            <a href="class.php?id=<?php echo $classID; ?>" class="btn btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z"/></svg></a>
            <span id="classHeader"><?php include 'class-header.php'; ?></span>  
        </div> 
        <hr>
        <form class="form-control p-5 bg-light" action="add-student.php?id=<?php echo $classID; ?>" method="post">   
            <h1 class="text-center">Add Student</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="number" name="ID_number" class="form-control input-border" placeholder="Enter ID" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" name="last_name" class="form-control input-border" placeholder="Enter Last Name" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" name="first_name" class="form-control input-border" placeholder="Enter First Name" required>
                </div>
                
                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">ADD</p>
                    <button class="btn input-border create-class-button w-100" id="addStudentBtn" type="submit" value="Submit">Add</button>
                </div>
            </div>
        </form>
       
        
        <div class="form-control p-5 bg-light mt-3">
            <!-- Enrolled Students -->           
            <h1 class="text-center mb-4">Enrolled Students</h1>
            <!-- Search student -->
            <div class="mb-3 mx-auto" style="max-width: 600px !important;">
                <div class="input-group">
                    <input type="text" class="form-control input-border" oninput="searchStudent(this.value)" placeholder="Enter student's name">
                    <span class="input-group-text input-border" style="border-left: none !important; background-color: #227710;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
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
                            <a type='button' class='btn btn-sm btn-outline-dark  btn-rounded' href='edit-student.php?id=$classID&studentid={$row['student_ID']}'>Edit</a>
                            <a type='button' class='btn btn-sm btn-danger  btn-rounded' href='delete_student.php?id=$classID&studentid={$row['student_ID']}' onclick=\"return confirm('Are you sure you want to remove {$lastName}, {$firstName} on class {$row['class_code']}?')\">Remove</a>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastContainer = document.getElementById('toastContainer');
            const addStudentBtn = document.getElementById('addStudentBtn');

            addStudentBtn.addEventListener('click', function () {
                showToast('Student successfully added!');
            });

            function showToast(message) {
                const newToast = document.createElement('div');
                newToast.className = 'toast d-flex';
                newToast.setAttribute('role', 'alert');
                newToast.setAttribute('aria-live', 'assertive');
                newToast.setAttribute('aria-atomic', 'true');

                newToast.innerHTML = `
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                `;

                const toastBootstrap = new bootstrap.Toast(newToast);
                toastContainer.appendChild(newToast);

                // Show the new toast
                toastBootstrap.show();
            }

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
        });
    </script>


</body>
</html>