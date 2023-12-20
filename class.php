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
        <div class="d-flex justify-content-between align-items-center mt-5">    
            <?php include 'class-header.php'; ?>
            <div class="text-end">
                <a href="edit-seatplan.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded">Edit Seatplan</a>
                <a href="enroll-student.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded">Enroll Student</a>
                <a href="edit-class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded">Edit Class</a>
                <a href="attendance-records.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-outline-dark btn-rounded">View Attendance Records</a>
                <a href="delete_class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-sm btn-danger btn-rounded" onclick="return confirm('Are you sure you want to delete this class?')">Delete Class</a>
            </div>
        </div>
    </div>

    
    <!-- aseatplan layout -->
    <div class="container">
        <hr/>
        <div class="d-flex justify-content-between align-items-center">
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
            <p class="label-text-2">Click a seat to change the student's attendance status.</p>
            <a href="#" type="button" class="btn btn-sm btn-outline-primary btn-rounded" onclick="reloadPage()">Save Attendance</a>    
        </div>
        <hr/>
        <div class="seatplan-main-container" style="user-select: none">
            <div class="my-grid">
                <div class="seatplan-seat" data-seat="1">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="2">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="3">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="4">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="5">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="6">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="7">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="8">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="9">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="10">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="11">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="12">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="13">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="14">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="15">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="16">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="17">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="18">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="19">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="20">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="21">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="22">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="23">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="24">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <div class="seatplan-seat" data-seat="25">
                    <div class="seatplan-seat-content">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
            </div>
            <div class="my-grid">
            <div class="seatplan-seat" data-seat="26">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="27">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="28">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="29">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="30">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="31">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="32">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="33">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="34">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="35">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="36">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="37">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="38">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="39">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="40">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="41">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="42">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="43">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="44">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="45">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="46">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="47">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="48">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="49">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname"></p>
                    <p class="seatplan-firstname"></p>
                </div>
            </div>

            <div class="seatplan-seat" data-seat="50">
                <div class="seatplan-seat-content">
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
            
            const colorStatus = {
                'present': '#66dc5b',
                'absent': '#ffb0b7',
                'late': '#fffa75',
                'excused': '#ADD2DB'
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
                                seat.style.backgroundColor = colorStatus[status];
                                seat.querySelector('.seatplan-firstname').textContent = `${seatInfo.firstName} - ${status}`;
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
                        console.log('Updated:', response);
                    },
                    error: function (error) {
                        console.error('Error updating attendance record:', error);
                    }
                });
            }
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
