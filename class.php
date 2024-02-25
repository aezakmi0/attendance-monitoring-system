<?php
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
        nav{
            background-color: #227710;
        }
        .logo{
            width: 45px;
            background-color: white;
            margin-top: 8px;
            border-radius: 50%;
            margin-right: 24px;
        }
        .margin-right{
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-fixed-top navbar-expand-sm">
    <div class="container">
        <button
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        class="navbar-toggler"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle nagivation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li>
                    <a href="index.html"><img src="img/logo.png" class="logo"></img></a>
                </li>
                <!-- Home -->
                <li class="nav-item active-nav">
                    <a href="index.html" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16"><path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/></svg></a>
                </li>
                <!-- Messages -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path d="M17 11h-2V9h2m-4 2h-2V9h2m-4 2H7V9h2m11-7H4a2 2 0 0 0-2 2v18l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Z"/></svg></a>
                </li> -->
                <!-- Time -->
                <li class="nav-item">
                    <a href="clock.html" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16"><g><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/></g></svg></a>
                </li>
                <!-- Calendar -->
                <li class="nav-item">
                    <a href="calendar.html" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16"><g><path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/><path d="M6.5 7a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2a1 1 0 0 0 0 2"/></g></svg></a>
                </li>
            </ul>
            <!-- Bell -->
            <div class="navbar-nav navbar-right invisible">
                <a href="#" class="nav-link invisible"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path d="M21 19v1H3v-1l2-2v-6c0-3.1 2.03-5.83 5-6.71V4a2 2 0 0 1 2-2a2 2 0 0 1 2 2v.29c2.97.88 5 3.61 5 6.71v6l2 2m-7 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2"/></svg></a>
            </div>
            <div class="navbar-nav">
                <div class="nav-item dropdown nav-profile">
                    <a href="#" class="nav-link dropdown-toggle"
                    id="navbarDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    ><img src="img/profile.jpg" alt="profile-picture" class="profile-picture">
                    <span class="align-middle">Prof. Name</span></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </nav>


    <div class="container">
        <!-- <div class="text-center pt-4"> -->
            <!-- <h1 class="class-code-lg">CS-ITE 313</h1>
            <p class="class-name">Web Systems and Technology | 3:00PM-5:00PM TF</p> -->
            <!-- </div> -->
            <!-- <hr class="hr" /> -->
        <div class="d-flex justify-content-between align-items-center mt-5">  
            <div class="d-flex">
                <a href="index.html" class="btn btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z"/></svg></a>
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
                <a href="#" type="button" class="btn btn-sm btn-rounded btn-green" onclick="reloadPage()"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4z"/></svg></a>    
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
