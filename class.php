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
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Smith</p>
                    <p class="seatplan-firstname">John</p>
                </div>
                <!-- <span class="seatplan-status-btn-container d-flex">
                    <a href="#" class="seatplan-status-btn">P</a>
                    <a href="#" class="seatplan-status-btn">A</a>
                    <a href="#" class="seatplan-status-btn">L</a>
                </span> -->
                <div class="seatplan-status-btn-container d-flex">
                    <label><input type="radio" name="status" value="present" class="seatplan-status-radio-btn"> P</label>
                    <label><input type="radio" name="status" value="absent" class="seatplan-status-radio-btn"> A</label>
                    <label><input type="radio" name="status" value="late" class="seatplan-status-radio-btn"> L</label>
                    <label><input type="radio" name="status" value="excused" class="seatplan-status-radio-btn"> E</label>
                </div>
            </div>
            <div class="seatplan-seat" onmouseover="showRadioButtons(this)" onmouseout="hideRadioButtons(this)">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Johnson</p>
                    <p class="seatplan-firstname">Emily</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Williams</p>
                    <p class="seatplan-firstname">Michael</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Brown</p>
                    <p class="seatplan-firstname">Olivia</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Jones</p>
                    <p class="seatplan-firstname">Daniel</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Davis</p>
                    <p class="seatplan-firstname">Sophia</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Miller</p>
                    <p class="seatplan-firstname">Ethan</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Wilson</p>
                    <p class="seatplan-firstname">Ava</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname invisible">Lastnm</p>
                    <p class="seatplan-firstname invisible">Firstnm</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Anderson</p>
                    <p class="seatplan-firstname">Isabella</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname invisible">Lastnm</p>
                    <p class="seatplan-firstname invisible">Firstnm</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Jackson</p>
                    <p class="seatplan-firstname">Mia</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">White</p>
                    <p class="seatplan-firstname">Lucas</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Hall</p>
                    <p class="seatplan-firstname">Emma</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Carter</p>
                    <p class="seatplan-firstname">Aiden</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Adams</p>
                    <p class="seatplan-firstname">Grace</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Evans</p>
                    <p class="seatplan-firstname">Logan</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Cooper</p>
                    <p class="seatplan-firstname">Chloe</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Baker</p>
                    <p class="seatplan-firstname">Ella</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Garcia</p>
                    <p class="seatplan-firstname">Mason</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Bennett</p>
                    <p class="seatplan-firstname">Lily</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Ward</p>
                    <p class="seatplan-firstname">Caleb</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname invisible">Lastnm</p>
                    <p class="seatplan-firstname invisible">Firstnm</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Ward</p>
                    <p class="seatplan-firstname">Caleb</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Robinson</p>
                    <p class="seatplan-firstname">Amelia</p>
                </div>
            </div>
        </div>
        <div class="my-grid">
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Taylor</p>
                    <p class="seatplan-firstname">Brandon</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Fisher</p>
                    <p class="seatplan-firstname">Jessica</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Mitchell</p>
                    <p class="seatplan-firstname">Alexis</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname invisible">Lastnm</p>
                    <p class="seatplan-firstname invisible">Firstnm</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Barnes</p>
                    <p class="seatplan-firstname">Taylor</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Henderson</p>
                    <p class="seatplan-firstname">Madison</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Fleming</p>
                    <p class="seatplan-firstname">Aaron</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Mason</p>
                    <p class="seatplan-firstname">Rachel</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Wells</p>
                    <p class="seatplan-firstname">Jordan</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Gordon</p>
                    <p class="seatplan-firstname">Avery</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Harrison</p>
                    <p class="seatplan-firstname">Sydney</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Frazier</p>
                    <p class="seatplan-firstname">Connor</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Manning</p>
                    <p class="seatplan-firstname">Evelyn</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Bryant</p>
                    <p class="seatplan-firstname">Natalie</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Ross</p>
                    <p class="seatplan-firstname">Dylan</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Larson</p>
                    <p class="seatplan-firstname">Haley</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Fletcher</p>
                    <p class="seatplan-firstname">Elijah</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname invisible">Lastnm</p>
                    <p class="seatplan-firstname invisible">Firstnm</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Brewer</p>
                    <p class="seatplan-firstname">Jason</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Keller</p>
                    <p class="seatplan-firstname">Sophie</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Horton</p>
                    <p class="seatplan-firstname">Austin</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname invisible">Lastnm</p>
                    <p class="seatplan-firstname invisible">Firstnm</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Felix</p>
                    <p class="seatplan-firstname">Colton</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Quinn</p>
                    <p class="seatplan-firstname">Makayla</p>
                </div>
            </div>
            <div class="seatplan-seat">
                <div class="seatplan-seat-content">
                    <p class="seatplan-lastname">Blackwell</p>
                    <p class="seatplan-firstname">Colton</p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <a type="button" class="btn btn-primary m-1 mb-2" href="#">Save Attendance</a>
    </div>

    <script>
        sessionStorage.setItem('classId', '<?php echo $classId; ?>');

        function showRadioButtons(element) {
            var radioButtons = element.querySelector('.radio-buttons');
            radioButtons.style.display = 'block';
        }

        function hideRadioButtons(element) {
            var radioButtons = element.querySelector('.radio-buttons');
            radioButtons.style.display = 'none';
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
