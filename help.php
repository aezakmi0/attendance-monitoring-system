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
        a {
            color: black !important;
        }
        
        .help-title{
            font-weight: 700 !important;
            margin: 30px 0 !important;
        }

        .roman-num {
            margin-top: 15px;
            list-style-type: upper-roman;
        }

        .step-list {
            list-style-type: none;
            counter-reset: step-counter;
        }

        .step-list>li::before {
            content: "Step " counter(step-counter) ": ";
            counter-increment: step-counter;
            font-weight: bold;
        }

        .step-list-2 {
            list-style-type: lower-alpha;
        }

        .remove-style {
            list-style: none;
        }

        .guide-img {
            display: block;
            margin: 20px 0;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            max-width: 650px;
            /* border: 1px #ddd solid; */
            /* box-shadow: 0 3px 19px 3px #ddd;
            border-radius: 6px; */
        }

        .guide-img-sm {
            display: block;
            margin: 20px 0;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            max-width: 300px;
            /* border: 1px #ddd solid; */
            /* box-shadow: 0 3px 19px 3px #ddd;
            border-radius: 6px; */
        }

        .help-tip {
            background-color: #f4f4f4;
            /* box-shadow: 0 3px 19px 3px #ddd; */
            border: 1px #227710 solid;
            padding: 20px 40px;
            /* max-width: 520px; */
            border-radius: 7px;
            /* font-size: 13px; */
            color: #227710;
            text-align: center;
        }

        .help-warning {
            background-color: #DC3545;
            border: 2px white solid;
            padding: 20px 40px;
            max-width: 520px;
            border-radius: 7px;
            color: white;
            text-align: center;
        }

        .responsive-span {
            /* d-flex justify-content-center align-items-center  */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 991px) {
            .responsive-span {
                display: grid;
            }
        }

        .main-container {

            overflow-y;
            auto;
        }

        .guide-container {
            display: flex;
        }

        .guide-nav {
            /* background-color: violet; */
            height: 520px;
            min-width: 380px;
            max-width: 450px;
            padding: 40px;
            padding-top: 15px;
            margin-right: 50px;
            position: sticky;
            top: 80px;
        }

        .guide-contents {
            /* background-color: red; */
            padding: 20px;
        }

        .list-group-item{
            /* background-color: floralwhite !important;  */
            font-size: 15px !important;
        }
        .list-group-item.active {
            border: 1px solid #227710 !important;
            background-color: #227710 !important; /* Change background color */
            color: #fff !important; /* Change text color */
        }
    </style>
</head>

<body>
    <div class="container mt-3 main-container">
        <div class="guide-instruction">
            <h1 class="class-code mb-3">Instruction Guide</h1>
            <p>Each section is structured to provide clear instructions along with visual aids such as screenshots to
                facilitate easy understanding. If you encounter any difficulties or have specific questions, refer to
                the
                relevant section for guidance.</p>
        </div>
        <!-- Table of Contents -->
        <div class="guide-container">
            <div class="guide-nav list-group" id="guide-nav">
                <!-- <div class="d-flex justify-content-center align-items-center"> -->
                    <h2 class="">Contents</h2>
                <!-- <div class="content-bg"> -->
                <!-- <ol class="roman-num"> -->
                    <span class="list-group">
                    <a class="list-group-item list-group-item-action" href="#help_createClass">Creating a Class</a>
                    <a class="list-group-item list-group-item-action" href="#help_modifyClass">Modifying a Class</a>
                    <a class="list-group-item list-group-item-action" href="#help_deleteClass">Deleting a Class</a>
                    <a class="list-group-item list-group-item-action" href="#help_enrollStudent">Enrolling a Student to a Class</a>
                    <a class="list-group-item list-group-item-action" href="#help_modifyStudent">Modifying the Student's Information</a>
                    <a class="list-group-item list-group-item-action" href="#help_removeStudent">Removing an Enrolled Student from a Class</a>
                    <a class="list-group-item list-group-item-action" href="#help_editSeatplan">Rearranging the Seat Plan of the Class</a>
                    <a class="list-group-item list-group-item-action" href="#help_checkAttendance">Checking the Attendance of the Students</a>
                    <a class="list-group-item list-group-item-action" href="#help_generateReport">Creating an Attendance Report</a>
                    <a class="list-group-item list-group-item-action" href="#help_filters">Filters</a>
                    <a class="list-group-item list-group-item-action" href="#help_navbar">Navigation Bar</a>
                    </span>
                <!-- </ol> -->
                <!-- </div> -->
                <!-- </div> -->
            </div>
            <div class="guide-contents scrollspy-example" data-spy="scroll" data-target="#guide-nav" data-offset="1000">
                <!-- Create Class` -->
                <!-- <hr> -->
                <span id="help_createClass">
                <h2 class="help-title mt-0">I. Creating a Class</h2>
                <ol class="step-list">
                    <li>You are currently at the homepage of the system, to begin click <b>Create Class.</b></li>
                    <img class="guide-img" src="img/guide/createclass1.png" alt="homepage">
                    <li>Type the class code of your subject under <b>Class Code.</b></li>
                    <li>Type the class name of your subject under <b>Class Name.</b></li>
                    <li>Select the designated room for your class under <b>Room.</b></li>
                    <img src="img/guide/createclass2.png" alt="guide" class="guide-img">
                    <li>Under <b>Start, </b>click the input box to select allocated start
                        for your class.</li>
                    <img src="img/guide/createclass3.png" alt="guide" class="guide-img-sm">
                    <li>For <b>End,</b> the mechanics are the same from the previous step, this time, type or select the
                        schedule time for your class to end.</li>
                    <li>Click the <b>days</b> that are scheduled for your class. Once you click them, the circle for the
                        day
                        should be highlighted. If you make a mistake, click the day once more to remove the highlight.
                    </li>
                    <img src="img/guide/createclass4.png" alt="guide" class="guide-img-sm">
                    <li>Review the items if they are all correct, make changes if necessary then click <b>Save.</b></li>
                </ol>
                <p>After successfully creating a class, you will be redirected to the enroll student page. For more
                    details,
                    see
                    <a href="#help_enrollStudent"><b> Enrolling a Student to a Class.</b></a>
                </p>
                </span>
                <hr>
                <!-- Modify Class -->
                <span id="help_modifyClass">
                <h2  class="help-title">II. Modifying a Class</h2>
                <ol class="step-list">
                    <li>In the homepage, select a class that you want to modify.</li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>Select the <b>Edit Class.</b></li>
                    <img src="img/guide/modifyclass2.png" alt="guide" class="guide-img">
                    <li>Modify the class with the correct information. The mechanics are the same with the previous
                        section,
                        <a href="#help_createClass" class=""><b>Creating a Class.</b></a>
                    </li>
                    <li>After reviewing the information, click the <b>update</b> button to update the class information.
                    </li>
                    <img src="img/guide/modifyclass3.png" alt="guide" class="guide-img">
                </ol>
                </span>
                <hr>

                <!-- Delete Class -->
                <span id="help_deleteClass">
                    <h2  class="help-title">III. Deleting a Class</h2>
                    <ol class="step-list">
                        <li>In the homepage, select the class that you want to delete.</li>
                        <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                        <li>Click the <b>Delete Class</b> button.</li>
                        <img src="img/guide/deleteclass1.png" alt="guide" class="guide-img">
                        <li>A warning will appear to confirm the deletion of the class. Click <b>OK.</b></li>
                    </ol>
                    <span class="responsive-span">
                        <img src="img/guide/deleteclass2.png" alt="guide" class="guide-img">
                        <p class="help-warning"><b>Note: </b>Once a class is deleted, all of its data will also be removed and it cannot be retrieved, so please proceed with caution.</p>
                    </span>
                </span>
                <hr>
                
                <!-- Enroll Student` -->
                <span id="help_enrollStudent">
                <h2  class="help-title">IV. Enrolling a Student to a Class</h2>
                <ol class="step-list">
                    <li>In the homepage, <b>select the class </b>where you wanted to add a student.</li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>Click the <b>Student</b> button.</li>
                    <img src="img/guide/enroll1.png" alt="guide" class="guide-img">
                    <li>Type the student ID of the student under <b>Student ID.</b></li>
                    <li>Type the first name of the student under <b>First Name.</b></li>
                    <li>Type the last name of the student under <b>Last Name.</b></li>
                    <li>After reviewing the student's informatin click <b>add.</b></li>
                    <img src="img/guide/enroll2.png" alt="guide" class="guide-img">
                    <li>Once the student is enrolled, it will be displayed under the <b>Enrolled Students.</b></li>
                </ol>
                </span>
                <hr>

                <!-- Modify Student -->
                <span id="help_modifyStudent">
                <h2  class="help-title">V. Modifying the Student's Information</h2>
                <ol class="step-list">
                    <li>In the homepage, <b>select the class </b>where the student is enrolled.</li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>Click the <b>Student</b> button.</li>
                    <img src="img/guide/modifystudent1.png" alt="guide" class="guide-img">
                    <li>Under the <b>Enrolled Students,</b> click the <b>Edit</b> button in the right side of the
                        student
                        that
                        you want to modify.</li>
                    <!-- INSERT TIP -->
                    <span class="m-3 responsive-span">
                        <img src="img/guide/modifystudent2.png" alt="guide" class="guide-img">
                        <p class="help-tip"><b>Tip: </b>You can use the search bar to search the student's name.</p>
                    </span>
                    <li>Enter the correct student's information.</li>
                    <li>After reviewing the student's information, click <b>Save Changes.</b></li>
                    <img src="img/guide/modifystudent3.png" alt="guide" class="guide-img">
                </ol>
                </span>
                <hr>
                
                <!-- Remove Student -->
                <span id="help_removeStudent">
                <h2  class="help-title">VI. Removing an Enrolled Student from a Class</h2>
                <ol class="step-list">
                    <li>In the homepage, <b>select the class</b> where the student is enrolled.</li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>Click the <b>Student </b>button.</li>
                    <img src="img/guide/modifystudent1.png" alt="guide" class="guide-img">
                    <li>Under the <b>Enrolled Students, </b>click the <b>Remove</b> button in the right side of the
                        student
                        that
                        you want to modify.</li>
                    <img src="img/guide/deletestudent1.png" alt="guide" class="guide-img">
                    <li>A warning will appear to confirm the removal of the student. Click <b>OK.</b></li>
                    <span class="responsive-span">
                        <img src="img/guide/deletestudent2.png" alt="guide" class="guide-img-sm">
                        <p class="help-warning"><b>Note: </b>Once a student is removed from the class, the student's
                            attendance
                            record will also be removed and it cannot be retrieved, so please proceed with caution.</p>
                    </span>
                </ol>
                </span>
                <hr>

                <!-- Edit Seatplan -->
                <span id="help_editSeatplan">
                <h2  class="help-title">VII. Rearranging the Seat Plan of the Class</h2>
                <ol class="step-list">
                    <li>Navigate to the homepage and <b>select the class</b> you want to rearrange the seat plan for.
                    </li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>Click the <b>Edit Seatplan</b> button.</li>
                    <img src="img/guide/editseatplan.png" alt="guide" class="guide-img">
                    <li>Click a <b>seat</b> where you want the student to be assigned.</li>
                    <li>After clicking a seat, a list of students will appear. Click on the <b>assign</b> button on hte
                        right
                        side of the selected student's name that you want the seat to be assigned to.</li>
                    <img src="img/guide/editseatplan1.png" alt="guide" class="guide-img">
                    <li>After assigning a seat to a student, the system will automatically save the updated seat plan.
                    </li>
                </ol>
                <span class="responsive-span">
                    <p class="help-tip"><b>Note: </b>If you attempt to assign multiple students to one seat, the system
                        will
                        display an error
                        message. In such cases, please assign the additional student to an unoccupied seat.</p>
                    <img src="img/guide/editseatplan2.png" alt="guide" class="guide-img">
                </span>
                </span>
                <hr>

                <!-- Check Attendance -->
                <span id="help_checkAttendance">
                <h2  class="help-title">VIII. Checking the Attendance of the Students</h2>
                <ol class="step-list">
                    <li>Navigate to the homepage and <b>choose the specific class</b> for which you wish to check
                        attendance.
                    </li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>To mark the attendance status of the students, you can:
                        <ol class="step-list-2">
                            <li>Click the <b>Mark all as present</b> button to mark all student as present; or</li>
                            <img src="img/guide/checkattendance1.png" alt="guide" class="guide-img">
                            <li>Select a specific <b>attendance status</b> and click the student's seat.</li>
                            <img src="img/guide/checkattendance2.png" alt="guide" class="guide-img">
                        </ol>
                    </li>
                    <li>You can reset the attendance status of the students by clicking the <b>reset</b> button.</li>
                    <img src="img/guide/checkattendance3.png" alt="guide" class="guide-img">
                    <p class="help-tip"><b>Note: </b>After marking the attendance status for each student, the system will <b>automatically save</b> the
                        changes.
                    </p>
                </ol>
                </span>
                <hr>
                
                <!-- Generate Report -->
                <span id="help_generateReport">
                <h2  class="help-title">IX. Creating an Attendance Report</h2>
                <ol class="step-list">
                    <li>Navigate to the homepage and <b>choose the specific class</b> for which you wish to create an
                        attendance report.</li>
                    <img src="img/guide/modifyclass1.png" alt="guide" class="guide-img">
                    <li>Click the <b>View Attendance Records </b>button.</li>
                    <img src="img/guide/generatereport.png" alt="guide" class="guide-img">
                    <li>Click the <b>Print Report </b>button.</li>
                    <img src="img/guide/generatereport1.png" alt="guide" class="guide-img">
                    <li>To generate an attendance report, you can:
                        <ol class="step-list-2">
                            <li><b>Print</b> the report by selecting our printer in the <b>Destination</b> box. You can also reveal more settings by clicking the <b>more settings </b>portion. Then, click the <b>Print</b>
                            button.
                            <img src="img/guide/generatereport2.png" alt="guide" class="guide-img">
                            </li>
                            <p class="help-tip text-center"><b>Note: </b>Ensure your device is connected to a printer before printing the attendance report.</p>
                            <li>Save the report as PDF by selecting the <b>Save as PDF</b> option in the <b>Destination</b> box. You can also reveal more settings by clicking the <b>more settings </b>portion. Then,
                            click the <b>save</b> button.
                            <img src="img/guide/generatereport3.png" alt="guide" class="guide-img">
                            </li>
                        </ol>
                    </li>
                </ol>
                </span>
                <hr>

                <!-- Filters -->
                <span id="help_filters">
                <h2  class="help-title">X. Filters</h2>
                <ol class="step-list">
                    <li>Filtering Classes on the Homepage
                        <ol class="step-list-2">
                            <li>In the <b>search bar,</b> enter either the class name or class code to display only the
                                searched
                                class.</li>
                            <li>Choose the class <b>start time</b> by selecting a specific time in the time input box.
                            </li>
                            <li>Select a room in the <b>Select Room</b> box to display only classes with the same room
                                as
                                the
                                input.</li>
                        </ol>
                        <img src="img/guide/filter1.png" alt="guide" class="guide-img">
                    </li>
                    <li>The system will automatically display the results once you apply your filters.</li>
                    <li>To remove the filters, click the <b>no funnel</b> button.</li>
                    <img src="img/guide/filter2.png" alt="guide" class="guide-img">
                </ol>
                </span>
                <hr>

                <!-- Navbar -->
                <span id="help_navbar">
                <h2  class="help-title">XI. Navigation Bar</h2>
                <ol class="remove-style">
                    <li><b>Homepage:</b> Clicking this icon displays the system's <b>homepage</b>.</li>
                    <img src="img/guide/navbar1.png" alt="guide" class="guide-img-sm">
                    <li><b>Clock:</b> Clicking this icon shows a live <b>time</b> display.</li>
                    <img src="img/guide/navbar2.png" alt="guide" class="guide-img-sm">
                    <li><b>Date:</b> Clicking this icon reveals the current <b>date</b>.</li>
                    <img src="img/guide/navbar3.png" alt="guide" class="guide-img-sm">
                </ol>
                </span>
            </div>
        </div>
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
        $(document).ready(function(){
            $('body').scrollspy({ target: '#guide-nav' });
        });
    </script>
</body>

</html>