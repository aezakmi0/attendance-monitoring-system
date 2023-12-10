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
            <a href="edit-seatplan.html" type="button" class="btn m-1 btn-secondary">Edit Seatplan</a>
            <a href="enroll-student.html" type="button" class="btn m-1 btn-secondary">Enroll Student</a>
            <a href="edit-class.html" type="button" class="btn m-1 btn-secondary">Edit Class</a>
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
    <div class="container">
        <div class="row">
            <!-- left 25 -->
            <div class="col" style="margin-right: 5%;">
                <!-- 1st row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Agreda,</p>
                        <p class="seatplan-firstname">Dale Anthony</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Estores,</p>
                        <p class="seatplan-firstname">Ivan James</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Garingo,</p>
                        <p class="seatplan-firstname">Joshua Razzi</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Piramo,</p>
                        <p class="seatplan-firstname">Carl Gabriel</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Lozada,</p>
                        <p class="seatplan-firstname">Jesse John</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Hayag,</p>
                        <p class="seatplan-firstname">Alexiss</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Geraldez,</p>
                        <p class="seatplan-firstname">Jan Anthony</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                </div>
                <!-- 3rd row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname invisible">a</p>
                        <p class="seatplan-firstname invisible">a</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                </div>
                <!-- 4th row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname invisible">a</p>
                        <p class="seatplan-firstname invisible">a</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                </div>
                <!-- 5th row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname invisible">a</p>
                        <p class="seatplan-firstname invisible">a</p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                        <span class="seatplan-status-btn-container d-flex">
                            <a href="#" class="seatplan-status-btn">P</a>
                            <a href="#" class="seatplan-status-btn">A</a>
                            <a href="#" class="seatplan-status-btn">L</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- RIGHT -->
            <div class="col">
                <!-- 1st row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Wata,</p>
                        <p class="seatplan-firstname">Dustin</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Taboada,</p>
                        <p class="seatplan-firstname">Vene Lucille</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Taladtad,</p>
                        <p class="seatplan-firstname">Jelan Roy</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname">Provido,</p>
                        <p class="seatplan-firstname">Olsen John</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div><div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <!-- 3rd row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname invisible">a</p>
                        <p class="seatplan-firstname invisible">a</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <!-- 4th row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname invisible">a</p>
                        <p class="seatplan-firstname invisible">a</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
                <!-- 5th row -->
                <div class="row">
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname invisible">a</p>
                        <p class="seatplan-firstname invisible">a</p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                    <div class="col rounded seatplan-seat">
                        <p class="seatplan-lastname"></p>
                        <p class="seatplan-firstname"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        function redirectToClassPage(class_ID) {
            window.location.href = `class.php?id=${classID}`;
        }
    </script> -->
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>