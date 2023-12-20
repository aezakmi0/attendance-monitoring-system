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
    <div class="container">
        <!-- <div class="text-center pt-4"> -->
            <!-- <h1 class="class-code-lg">CS-ITE 313</h1>
            <p class="class-name">Web Systems and Technology | 3:00PM-5:00PM TF</p> -->
            <!-- </div> -->
            <!-- <hr class="hr" /> -->
        <div class="d-flex justify-content-between align-items-center mt-4">    
            <?php include 'class-header.php'; ?>
            <div class="text-end">
                <a href="edit-seatplan.php?id=<?php echo $classId; ?>" type="button" class="btn  btn-outline-dark btn-rounded">Edit Seatplan</a>
                <a href="enroll-student.php?id=<?php echo $classId; ?>" type="button" class="btn  btn-outline-dark btn-rounded">Enroll Student</a>
                <a href="edit-class.php?id=<?php echo $classId; ?>" type="button" class="btn  btn-outline-dark btn-rounded">Edit Class</a>
                <a href="#" type="button" class="btn  btn-outline-dark btn-rounded">Generate Report</a>
                <a href="delete_class.php?id=<?php echo $classId; ?>" type="button" class="btn  btn-danger btn-rounded" onclick="return confirm('Are you sure you want to delete this class?')">Delete Class</a>
            </div>
        </div>
    </div>

    
    <!-- seatplan layout -->
    <div class="container">
        <hr class="hr" />
        <div class="d-flex justify-content-between align-items-center mb-2">
            <p class="label-text-2">Click a seat to change the student's attendance status.</p>
            <div class="legend-container d-flex align-items-center">
                <div class="legend-color"></div>
                <p class="label-text-2">PRESENT</p>
                <div class="legend-color-2"></div>
                <p class="label-text-2">ABSENT</p>
                <div class="legend-color-3"></div>
                <p class="label-text-2">LATE</p>
                <div class="legend-color-4"></div>
                <p class="label-text-2">EXCUSED</p>
            </div>
            <!-- <button type="submit" class="btn btn-outline-primary btn-rounded" id="saveAttendanceBtn">Save Attendance</button> -->
        </div>
        <hr class="hr" />
        <div class="seatplan-main-container">
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
</div>
    <!-- <div class="d-flex justify-content-center mt-4">
        <a type="button" class="btn btn-primary m-1 mb-2" href="#">Save Attendance</a>
    </div> -->

    <script>
        const seatplanSeats = document.querySelectorAll('.seatplan-seat');
        const assignModal = document.getElementById('assignModal');
        const studentList = document.getElementById('studentList');

        document.addEventListener('DOMContentLoaded', function () {
            // Define an array of colors to loop through
            const colors = ['#66dc5b', '#ffb0b7', '#fffa75', '#ADD2DB'];
            const status = ['present', 'absent', 'late', 'excused'];

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
                            const seat = document.querySelector(`.seatplan-seat-content[data-seat="${seatNumber}"]`);

                            if (seat) {
                                // Update the seat information
                                seat.querySelector('.seatplan-lastname').textContent = seatInfo.lastName;
                                // seat.querySelector('.seatplan-firstname').textContent = seatInfo.firstName;

                                // Make the seat clickable
                                seat.parentElement.classList.add('clickable');
                                
                                // Set the student_ID as a data attribute
                                seat.parentElement.setAttribute('data-student-id', seatInfo.studentID);

                                fetch(`get_attendance_status.php?classId=<?php echo $classId; ?>&studentId=${seatInfo.studentID}`)
                                    .then(response => response.json())
                                    .then(attendanceStatus => {
                                        // Update the seat with attendance status
                                        seat.querySelector('.seatplan-firstname').textContent = `${seatInfo.firstName} - ${attendanceStatus.status}`;
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
                // Get the current color from the array
                const currentColor = colors[colorIndex];
                const currentStatus = status[statusIndex];

                // Log the current color to the console
                console.log(`Seat color changed to: ${currentColor} ${currentStatus}`);

                // Toggle the color by adding a class to the clicked seat
                this.style.backgroundColor = currentColor;

                // Increment the color index or reset to 0 if at the end of the array
                colorIndex = (colorIndex + 1) % colors.length;
                statusIndex = (statusIndex + 1) % status.length;

                // Get the student ID from the seat assignment
                // const studentId = this.getAttribute('data-student-id');
                console.log('Student ID:', studentId);
                console.log('Class ID:', <?php echo $classId; ?>);

                // Send an AJAX request to update the attendance record
                $.ajax({
                    type: 'POST',
                    url: 'save_attendance.php',
                    data: {
                        classId: <?php echo $classId; ?>,
                        studentId: studentId,
                        date: (new Date()).toISOString().split('T')[0], // Get current date in 'YYYY-MM-DD' format
                        status: currentStatus
                    },
                    success: function (response) {
                        console.log('Attendance record updated successfully:', response);
                    },
                    error: function (error) {
                        console.error('Error updating attendance record:', error);
                    }
                });
            }
        });
        </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
