<?php
// Assuming you have a database connection established
$servername = "localhost";
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Attempt to establish a connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}

// Get the class_ID from the URL
$classId = isset($_GET['id']) ? $_GET['id'] : null;


// Fetch seat assignments for the current class with student names
$sql = "SELECT sp.seat_number, s1.first_name as first_name1, s1.last_name as last_name1
        FROM tb_seatplan sp
        INNER JOIN tb_student s1 ON sp.student_ID = s1.student_ID
        INNER JOIN tb_student s2 ON sp.student_ID <> s2.student_ID AND sp.seat_number = (SELECT seat_number FROM tb_seatplan WHERE student_ID = s2.student_ID AND class_ID = :classId)
        WHERE sp.class_ID = :classId";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
$stmt->execute();

// Fetch the result
$duplicateSeats = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seatplan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Add this CSS to style the modal */
        #assignModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto; /* Add this line to make the modal scrollable */
            max-height: 80vh; /* Set a max height for the modal */
        }

        #modalContent {
            margin-bottom: 20px; /* Add margin to separate the list from the button */
        }

        #assignButton {
            float: right;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->

    <div class="container" style="background-color: rgb(255, 255, 255);">
        <h1 class="text-center mt-5">Edit Seatplan</h1>
        <h1 class="label-text text-center">Click seat to assign to student</h1>
        <hr class="hr invisible"/>
    </div>
    
    <!-- seatplan layout -->
    <div class="container">
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
        <h1 id="duplicateSeatWarning" class="label-text-red mt-1"></h1>
        <?php
           // Check if there are duplicate seat assignments
            if (!empty($duplicateSeats)) {
                echo '<div id="duplicateSeatWarning" class="label-text-red mt-1"><b>DUPLICATE SEAT ASSIGNMENT:</b> Two or more students are currently assigned to the same seat. Please review and resolve this assignment conflict.';
                foreach ($duplicateSeats as $seat) {
                    echo "<br>\n". '<b>' . $seat['first_name1'] . ' ' . $seat['last_name1'] . '</b>';
                }
                echo '</div>';
            }
        ?>
    </div>
    
    <!-- Modal -->
    <div id="assignModal" class="rounded">
        <h4>Assign Seat To:</h4>
        <hr class="hr">
        <ul id="studentList" class="list-unstyled"></ul>
        <hr class="hr">
        <button id="cancelButton" class="btn btn-dark btn-rounded" onclick="closeModal()">Cancel</button>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a href="class.php?id=<?php echo $classId; ?>" type="button" class="btn btn-outline-dark btn-black btn-sm m-1" value="Cancel">Back</a>
        <!-- <a type="button" class="btn btn-primary m-1" href="#">Save</a> -->
    </div>
        
    <script>
        // Update the script to handle modal interactions and AJAX request
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
                
                console.log('seatNumber:', seatNumber);
                console.log('seatInfo:', seatInfo);
                console.log('seatAssignments:', seatAssignments);
                
                if (seatInfo) {
                    // Update the seat information
                    seat.querySelector('.seatplan-lastname').textContent = seatInfo.lastName;
                    seat.querySelector('.seatplan-firstname').textContent = seatInfo.firstName;
                    
                }
            });
                })
                .catch(error => console.error('Error fetching seat assignments:', error));
        });

        // Variable to store the selected seat number
        let selectedSeatNumber = null;
        let selectedStudentID = null;

        // Loop through each seat and add a click event listener
        seatplanSeats.forEach(seat => {
            seat.addEventListener('click', function () {
                // Get the seat number from the data attribute
                selectedSeatNumber = seat.querySelector('.seatplan-seat-content').getAttribute('data-seat');
                console.log("Seat Number: ", selectedSeatNumber);

                // Fetch student data for the selected class and display in the modal
                fetch(`get_students.php?classId=<?php echo $classId; ?>`)
                    .then(response => response.json())
                    .then(data => {
                        
                        // Sort the data by last name
                        data.sort((a, b) => a.last_name.localeCompare(b.last_name));

                        // Populate the modal with student information
                        studentList.innerHTML = '';
                        data.forEach(student => {
                            const listItem = document.createElement('li');

                            // Create a div to hold student information and the "Assign" button
                            const studentDiv = document.createElement('div');
                            studentDiv.style = "padding: 3px 0;"
                            studentDiv.classList = "modal-body d-flex justify-content-between";
                            
                            // Display student information
                            const studentName = document.createElement('span');
                            studentName.classList = "align-middle";
                            studentName.style = "margin-right: 50px";
                            studentName.innerHTML = `${student.last_name},  ${student.first_name}`;

                            // Create the "Assign" button
                            const assignButton = document.createElement('button');
                            assignButton.classList = "btn btn-sm btn-outline-primary btn-green float-right";
                            assignButton.textContent = "Assign";
                            assignButton.addEventListener('click', function () {
                                // Set the selected student ID
                                selectedStudentID = student.student_ID;

                                // Check if a seat and student are selected
                                if (selectedSeatNumber !== null && selectedStudentID !== null) {
                                    // Send an AJAX request to the PHP script to update the database
                                    fetch(`assign_seat.php?classId=<?php echo $classId; ?>&seatNumber=${selectedSeatNumber}&studentID=${selectedStudentID}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Handle the response if needed
                                            console.log('Assignment successful:', data);
                                            location.reload();
                                            // After assigning, close the modal
                                            closeModal();
                                        })
                                        .catch(error => console.error('Error assigning seat:', error));
                                } else {
                                    console.error('Seat and student must be selected.');
                                }
                            });

                            // Append the button to the studentDiv
                            studentDiv.appendChild(studentName);
                            studentDiv.appendChild(assignButton);

                            // Append the student div to the list item
                            listItem.appendChild(studentDiv);

                            // Append the list item to the student list
                            studentList.appendChild(listItem);
                        });
                        // Show the modal
                        assignModal.style.display = 'block';
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });

        // Function to close the modal
        function closeModal() {
            assignModal.style.display = 'none';
            selectedSeatNumber = null; // Reset the selected seat number
            selectedStudentID = null; // Reset the selected student ID
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
