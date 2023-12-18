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
            <a href="edit-seatplan.php?id=<?php echo $classId; ?>" type="button" class="btn m-1 btn-secondary">Edit Seatplan</a>
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
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="1">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="2">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="3">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="4">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="5">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="6">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="7">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="8">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="9">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="10">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="11">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="12">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="13">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="14">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="15">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="16">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="17">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="18">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="19">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="20">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="21">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="22">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="23">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="24">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="25">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
        </div>
        <div class="my-grid">
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="26">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="27">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="28">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="29">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="30">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="31">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="32">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="33">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="34">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="35">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="36">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="37">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="38">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="39">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="40">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="41">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="42">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="43">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="44">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="45">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="46">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="47">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="48">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="49">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content" data-seat="50">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a type="button" class="btn btn-primary m-1 mb-2" href="#">Save Attendance</a>
    </div>

    <script>
        const seatplanSeats = document.querySelectorAll('.seatplan-seat');
        const assignModal = document.getElementById('assignModal');
        const studentList = document.getElementById('studentList');

        document.addEventListener('DOMContentLoaded', function () {
            // Fetch seat assignments for the class
            fetch(`get_seat_assignments.php?classId=<?php echo $classId; ?>`)
                .then(response => response.json())
                .then(seatAssignments => {
                    // Loop through each seat and update the seat information
                    seatplanSeats.forEach(seat => {
                        const seatNumber = seat.querySelector('.seatplan-seat-content').getAttribute('data-seat');
                        const seatInfo = seatAssignments[seatNumber];

                        if (seatInfo) {
                            // Update the seat information
                            seat.querySelector('.seatplan-lastname').textContent = seatInfo.lastName;
                            seat.querySelector('.seatplan-firstname').textContent = seatInfo.firstName;
                        }
                    });
                })
                .catch(error => console.error('Error fetching seat assignments:', error));
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
