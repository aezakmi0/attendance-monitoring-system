<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .red-text {
            color: red;
        }

        .content-bg {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
        }

        ol.roman-num{
            list-style-type: upper-roman;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="class-code mb-3">Instruction Guide</h1>
        <p>This instruction guide serves as a comprehensive resource to familiarize users with the functionalities and
            features of our Attendance Monitoring System. The instruction guide is thoughtfully divided into sections,
            each offering detailed instructions and screenshots to navigate the system effortlessly and optimize its
            capabilities.</p>


        <!-- Table of Contents -->
        <div class="content-bg m-5 p-5">
            <h1>Contents</h1>
            <ol class="roman-num">
                <li><a href="#help_createClass">Creating A Class</a></li>
                <li><a href="#help_modifyClass">Modifying A Class</a></li>
                <li><a href="#help_deleteClass">Deleting A Class</a></li>
                <li><a href="#help_enrollStudent">Enrolling a Student to a Class</a></li>
                <li><a href="#help_modifyStudent">Modifying the Student's Information</a></li>
                <li><a href="#help_removeStudent">Removing an Enrolled Student from a Class</a></li>
                <li><a href="#help_editSeatplan">Rearranging the Seat Plan of the Class</a></li>
                <li><a href="#help_checkAttendance">Checking the Attendance of the Students</a></li>
                <li><a href="#help_generateReport">Creating an Attendance Report</a></li>
            </ol>
        </div>

        <h2 id="help_createClass">I. Creating a Class</h2>
        <ol>
            <li>You are currently at the homepage of the system, to begin click <b>Create Class.</b></li>
            <li>Type the class code of your subject under <b>Class Code.</b></li>
            <li>Type the class name of your subject under <b>Class Name.</b></li>
            <li>Select the designated room for your class under <b>Room.</b></li>
            <li>Under <b>Start, </b>type down the time OR click the small clock on the right to select allocated start
                for your class.</li>
            <li>For <b>End,</b> the mechanics are the same from the previous step, this time, type or select the
                schedule time for your class to end.</li>
            <li>Click the <b>days</b> that is schedule for your class, once you click them, the circle for the day
                should be highlighted. If you made a mistake, click the day once more so it will no longer be
                highlighted.</li>
            <li>Review the items if they are all correct, make changes if necessary then click <b>Save.</b></li>
        </ol>

        <h2 id="help_modifyClass">II. Modifying a Class</h2>
        <ol>
            <li>In the homepage, select a class that you want to modify.</li>
            <li>Select the <b>Edit Class.</b></li>
            <li>Modify the class with the correct information. The mechanics are the same with the previous section,
                <b>"Creating a class."</b></li>
            <li>After reviewing the information, click the <b>update</b> button to update the class information.</li>
        </ol>

        <h2 id="help_deleteClass">III. Deleting a Class</h2>
        <ol>
            <li>In the homepage, select the class tht you want to delete.</li>
            <li>Click the <b>Delete Class</b> button.</li>
            <li>A warning will appear to confirm the deletion of the class. Click <b>OK.</b></li>
        </ol>
        <p class="red-text"><b>Note: </b>Once a class is deleted, all of its data will also be removed and it cannot be
            retrieved, so please proceed with caution.</p>

        <h2 id="help_enrollStudent">IV. Enrolling a Student to a Class</h2>
        <ol>
            <li>In the homepage, <b>select the class </b>where you wanted to add a student.</li>
            <li>Click the <b>Enroll Student</b>button.</li>
            <li>Type the student ID of the student under <b>Student ID.</b></li>
            <li>Type the first name of the student under <b>First Name.</b></li>
            <li>Type the last name of the student under <b>Last Name.</b></li>
            <li>After reviewing the student's informatin click <b>add.</b></li>
            <li>Once the student is enrolled, it will be displayed under the <b>Enrolled Students.</b></li>
        </ol>

        <h2 id="help_modifyStudent">V. Modifying the Student's Information</h2>
        <ol>
            <li>In the homepage, <b>select the class </b>where the studnet is enrolled.</li>
            <li>Click the <b>Enroll Student</b> button.</li>
            <li>Under the <b>Enrolled Students,</b> click the <b>Edit</b> button in the right side of the student that
                you want to modify.</li>
            <li>Enter the correct student's information.</li>
            <li>After reviewing the studnet's information, click <b>Save Changes.</b></li>
        </ol>

        <h2 id="help_removeStudent">VI. Removing an Enrolled Student from a Class</h2>
        <ol>
            <li>In the homepage, <b>select the class</b> where the student is enrolled.</li>
            <li>Click the <b>Enroll Student </b>button.</li>
            <li>Under the <b>Enrolled Students, </b>click the <b>Remove</b> button in the right side of the student that
                you want to modify.</li>
            <li>A warning will appear to confirm the removal of the student. Click <b>OK.</b></li>
        </ol>

        <h2 id="help_editSeatplan">VII. Rearranging the Seat Plan of the Class</h2>
        <ol>
            <li>Navigate to the homepage and <b>select the class</b> you want to rearrange the seat plan for.</li>
            <li>Click the <b>Edit Seatplan</b> button.</li>
            <li>Click a <b>seat</b> where you want the student to be assigned.</li>
            <li>After clicking a seat, a list of students will appear. Click on the <b>assign</b> button on hte right
                side of the selected student's name that you want the seat to be assigned to.</li>
            <li>After assigneing a seat to a student, the system will automatically save the updated seat plan.</li>
        </ol>
        <p><b>Note: </b>If you attempt to assign multiple students to one seat, the system will display an error
            message. In such cases, please assign the additional student to an unoccupied seat.</p>

        <h2 id="help_checkAttendance">VIII. Checking the Attendance of the Students</h2>
        <ol>
            <li>Navigate to the homepage and <b>choose the specific class</b> for which you wish to check attendance.
            </li>
            <li>To mark the attendance status of the students, you can:
                <ul>
                    <li>Click the <b>Mark all as present</b> button to mark all student as present; or</li>
                    <li>Click a student's seat <b>repeatedly</b> to assign a specific status.</li>
                </ul>
            </li>
            <li>After marking the attendance status for each student, the sytsem will automatically save the changes.
            </li>
        </ol>
        <h2 id="help_generateReport">IX. Creating an Attendance Report</h2>
        <ol>
            <li>Navigate to the homepage and <b>choose the specific class</b> for which you wish to cdreate an
                attendance report.</li>
            <li>Click the <b>View Attendance Records </b>button.</li>
            <li>Click the <b>Print Report </b>button.</li>
            <li>To generate an attendance report, you can:
                <ul>
                    <li><b>Print</b> the report by selecting our printer in the <b>Destination</b> box. You can also
                        reveal more settings by clickin the <b>more settings </b>portion. Then, click the <b>Print</b>
                        button.</li>
                    <p><b>Note: </b>Ensure your device is connected to a printer before printing the attendance report.
                    </p>
                    <li>Save the report as PDF by selecting the <b>Save as PDF</b></li>
                </ul>
            </li>
        </ol>
    </div>
    <!-- TOAST CONTAINER -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer">
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        // JavaScript for smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const target = document.querySelector(this.getAttribute('href'));
                const navbarHeight = document.getElementById('navbar').offsetHeight; // Get navbar height

                window.scrollTo({
                    top: target.offsetTop - navbarHeight,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>