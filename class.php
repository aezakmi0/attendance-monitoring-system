<?php
session_start();
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);


// Get the class_ID from the URL
$classId = isset($_GET['id']) ? $_GET['id'] : null;
$sql = "SELECT class_code FROM tb_class WHERE class_ID = $classId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Assuming class_code is a unique identifier; you may need to adjust accordingly
    $row = $result->fetch_assoc();
    $classCode = $row['class_code'];
} else {
    $classCode = "Unknown"; // Set a default value if class_code is not found
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($classCode); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .margin-right{
            margin-right: 20px;
        }
        
        ol>.breadcrumb{
            margin-bottom: 0px !important;
        }
    </style>
</head>
<body>
 
    <div class="container">
        <!-- <div class="text-center pt-4"> -->
            <!-- <h1 class="class-code-lg">CS-ITE 313</h1>
            <p class="class-name">Web Systems and Technology | 3:00PM-5:00PM TF</p> -->
            <!-- </div> -->
            <!-- <hr class="hr" /> -->

            <!-- Breadcrumbs -->
            <!-- <p class="label-text-2 mt-3 mb-3 breadcrumbs">Home \ Class \ <span style="color: #227710; font-weight: 600;">Edit Seatplan</span></p> -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $classCode; ?></li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center">  
            <div class="d-flex">
                <a href="index.php" class="btn btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z"/></svg></a>
                <?php include 'class-header.php'; ?>
            </div>  
            <div class="text-end">
                <a href="edit-seatplan.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded btn-black">Edit Seatplan</a>
                <a href="enroll-student.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded btn-black">Students</a>
                <a href="edit-class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded btn-black">Edit Class</a>
                <a href="attendance-records.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded btn-black">View Attendance Records</a>
                <a href="delete_class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-danger btn-rounded btn-red" onclick="return confirm('Are you sure you want to delete this class?')">Delete Class</a>
            </div>
        </div>
    </div>

    
    <!-- aseatplan layout -->
    <div class="container">
        <hr/>
        <div class="d-flex justify-content-between align-items-center">
            <div class="legend-container d-flex align-items-center">
                <!-- <div class="legend-color"></div>
                <p class="label-text-2">PRESENT</p>
                <div class="legend-color-2"></div>
                <p class="label-text-2">ABSENT</p>
                <div class="legend-color-3"></div>
                <p class="label-text-2">LATE</p>
                <div class="legend-color-4"></div>
                <p class="label-text-2">EXCUSED</p> -->

                <label class="margin-right"><input type="radio" name="status" value="present" checked> Present</label>
                <label class="margin-right"><input type="radio" name="status" value="absent"> Absent</label>
                <label class="margin-right"><input type="radio" name="status" value="late"> Late</label>
                <label><input type="radio" name="status" value="excused"> Excused</label>

            </div>
            <p class="label-text-2">Select an attendance status and click a seat to change the student's attendance status.</p>
            <span class="text-end">
                <a href="#" id="markAllPresentBtn" class="btn btn-sm btn-rounded btn-green">Mark all as present</a>
                <a href="#" id="resetStatusBtn" class="btn btn-sm btn-rounded btn-green"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4z"/></svg></a>    
            </span>
        </div>
        <hr/>
        <div class="seatplan-main-container" style="user-select: none">
            <div class="my-grid">
            <?php for($x = 1; $x <= 25; $x++){
                    echo '<div class="seatplan-seat" data-seat="' . $x .'">
                            <div class="seatplan-seat-content">
                                <span>
                                    <p class="seatplan-lastname"></p>
                                    <p class="seatplan-firstname"></p>
                                </span>
                                <p class="seatplan-attendance-status"></p>
                            </div>
                        </div>';  
                }?>
            </div>
            <div class="my-grid">
            <?php for($x = 26; $x <= 50; $x++){
                    echo '<div class="seatplan-seat" data-seat="' . $x .'">
                            <div class="seatplan-seat-content">
                                <span>
                                    <p class="seatplan-lastname"></p>
                                    <p class="seatplan-firstname"></p>
                                </span>
                                <p class="seatplan-attendance-status"></p>
                            </div>
                        </div>';  
                }?>
            </div>
        </div>

        <!-- 
        <div class="seatplan-seat" data-seat="1'">
            <div class="seatplan-seat-content">
                <span>
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </span>
                <p class="seatplan-attendance-status">PRESENT</p>
            </div>
        </div> 
        -->

    </div>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="teacher-table mt-4 seatplan-lastname">TEACHER'S TABLE</div>
    </div>
    <!-- <div class="d-flex justify-content-center mt-4">
        <a type="button" class="btn btn-primary m-1 mb-2" href="#">Save Attendance</a>
    </div> -->

    <!-- TOAST CONTAINER -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer">
    </div>
    
    <script>
        const seatplanSeats = document.querySelectorAll('.seatplan-seat');
        const assignModal = document.getElementById('assignModal');
        const studentList = document.getElementById('studentList');

        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var formattedDate = year + '-' + month + '-' + day;

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

            // Define an array of colors to loop through
            const colors = ['#4ab33d', '#ff4747', '#ff9640', '#6090eb'];
            const status = ['present', 'absent', 'late', 'excused'];
            
            const colorStatus = {
                'present': '#4ab33d',
                'absent': '#ff4747',
                'late': '#ff9640',
                'excused': '#6090eb'
            };

            // Initialize a counter to keep track of the current color
            let colorIndex = 0;
            let statusIndex = 0;
            // Fetch seat assignments for the class
            fetch(`get_seat_assignments.php?classId=<?php echo $classId; ?>`)
                .then(response => response.json())
                .then(seatAssignments => {
                // Check if seatAssignments is an object with seat numbers
                if (seatAssignments && typeof seatAssignments === 'object') {
                    // Loop through each seat and update the seat information
                    Object.keys(seatAssignments).forEach(seatNumber => {
                        const seatInfo = seatAssignments[seatNumber];
                        const seat = document.querySelector(`.seatplan-seat[data-seat="${seatNumber}"]`);

                        if (seat) {
                            // Update the seat information
                            seat.querySelector('.seatplan-lastname').textContent = seatInfo.lastName;
                            seat.querySelector('.seatplan-firstname').textContent = seatInfo.firstName;
                            // Make the seat clickable
                            seat.classList.add('clickable');
                            
                            // Set the student_ID as a data attribute
                            seat.setAttribute('data-student-id', seatInfo.studentID);

                            fetch(`get_attendance_status.php?classId=<?php echo $classId; ?>&studentId=${seatInfo.studentID}`)
                            .then(response => response.json())
                            .then(attendanceStatus => {
                                const status = attendanceStatus.status;
                                const seatplanAttendanceStatus = seat.querySelector('.seatplan-attendance-status');
                                seat.querySelector('.seatplan-attendance-status').textContent = status;
                                
                                if (seat.querySelector('.seatplan-attendance-status').textContent != "No attendance"){
                                    seatplanAttendanceStatus.classList.add("white-text");
                                }

                                seat.style.backgroundColor = colorStatus[status];
                            })
                            .catch(error => console.error('Error fetching attendance status:', error));
                        }
                    });
                } else {
                    console.error('Invalid seat assignments format:', seatAssignments);
                }

                // Add click event listener to each seat with the 'clickable' class
                const clickableSeats = document.querySelectorAll('.seatplan-seat.clickable');
                clickableSeats.forEach(seat => {
                    // Get the student ID from the seat element
                    const studentId = seat.getAttribute('data-student-id');

                    seat.addEventListener('click', function () {
                        toggleColor.call(this, studentId);
                        const seatplanAttendanceStatus = seat.querySelector('.seatplan-attendance-status');
                        seatplanAttendanceStatus.classList.add("white-text");
                    });
                });
            })
            .catch(error => console.error('Error fetching seat assignments:', error));

            // Function to toggle through colors
            function toggleColor(studentId) {
                const statusRadios = document.querySelectorAll('input[name="status"]');
                let currentStatus;

                // Loop through the radio buttons to find the selected one
                statusRadios.forEach(radio => {
                    if (radio.checked) {
                        currentStatus = radio.value;
                    }
                });

                // Get the current color from the array
                const currentColor = colorStatus[currentStatus];

                // Log the current color to the console
                console.log(`Seat color changed to: ${currentColor} ${currentStatus}`);

                // Toggle the color by adding a class to the clicked seat
                this.style.backgroundColor = currentColor;

                // Get the student ID from the seat assignment
                console.log('Student ID:', studentId);
                console.log('Class ID:', <?php echo $classId; ?>);

                // Send an AJAX request to update the attendance record
                $.ajax({
                    type: 'POST',
                    url: 'save_attendance.php',
                    data: {
                        classId: <?php echo $classId; ?>,
                        studentId: studentId,
                        date: formattedDate,
                        status: currentStatus
                    },
                    success: function (response) {
                        console.log('Updated:', response);

                        // Fetch and update the attendance status after saving
                        fetch(`get_attendance_status.php?classId=<?php echo $classId; ?>&studentId=${studentId}`)
                            .then(response => response.json())
                            .then(attendanceStatus => {
                                const status = attendanceStatus.status;

                                // Update the seat's attendance status text
                                document.querySelector(`.seatplan-seat[data-student-id="${studentId}"] .seatplan-attendance-status`).textContent = status;
                            })
                            .catch(error => console.error('Error fetching attendance status:', error));
                    },
                    error: function (error) {
                        console.error('Error updating attendance record:', error);
                    }
                });
            }
        });
        // Add click event listener to the "Mark all as present" button
        const markAllPresentBtn = document.getElementById('markAllPresentBtn');
        markAllPresentBtn.addEventListener('click', function () {
            // Iterate through all seatplan seats and mark them as present
            const allSeats = document.querySelectorAll('.seatplan-seat.clickable');

            allSeats.forEach(seat => {
                const studentId = seat.getAttribute('data-student-id');

                // Assuming 'present' is the status code for present
                seat.style.backgroundColor = '#4ab33d';

                // Send an AJAX request to update the attendance record
                $.ajax({
                    type: 'POST',
                    url: 'save_attendance.php',
                    data: {
                        classId: <?php echo $classId; ?>,
                        studentId: studentId,
                        date: formattedDate,
                        status: 'present'
                    },
                    success: function (response) {
                        console.log('Updated:', response);

                        // Fetch and update the attendance status after saving
                        fetch(`get_attendance_status.php?classId=<?php echo $classId; ?>&studentId=${studentId}`)
                            .then(response => response.json())
                            .then(attendanceStatus => {
                                const status = attendanceStatus.status;
                                // Update the seat's attendance status text
                                seat.querySelector('.seatplan-attendance-status').textContent = status;
                                seat.querySelector('.seatplan-attendance-status').classList.add('white-text');
                            })
                            .catch(error => console.error('Error fetching attendance status:', error));
                    },
                    error: function (error) {
                        console.error('Error updating attendance record:', error);
                    }
                });
            });
        });

        // Add click event listener to the "Reset" button
        const resetStatusBtn = document.getElementById('resetStatusBtn');
        resetStatusBtn.addEventListener('click', function () {
            // Send an AJAX request to delete all status records for the class on the current date
            $.ajax({
                type: 'POST',
                url: 'reset_attendance.php', // Adjust URL as per your backend setup
                data: {
                    classId: <?php echo $classId; ?>,
                    date: formattedDate // Assuming formattedDate is defined elsewhere
                },
                success: function (response) {
                    console.log('Reset status:', response);
                    location.reload();
                    // Assuming you want to reset the UI after resetting status
                    // You may add additional logic here if needed
                },
                error: function (error) {
                    console.error('Error resetting status:', error);
                }
            });
        });


        function reloadPage() {
            location.reload();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
