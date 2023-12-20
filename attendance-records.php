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
    <style>
        .table td.fit, 
        .table th.fit {
            white-space: nowrap;
            width: 5%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-5">    
        <?php include 'class-header.php'; ?>
    </div>
    <hr/>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Student Name</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>10/4/23</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>202112748</td>
                <td class="fit">Garingo, Joshua Razzi</td>
                <td>P</td>
                <td>A</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>E</td>
                <td>E</td>
                <td>P</td>
                <td>L</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td class="fit">P=13 A=1 L=4 E=0</td>
            </tr>
            <tr>
                <td>202143234</td>
                <td class="fit">Taboada, Vene Lucille</td>
                <td>P</td>
                <td>A</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>E</td>
                <td>E</td>
                <td>P</td>
                <td>L</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td class="fit">P=15 A=3 L=4 E=0</td>
            </tr>
            <tr>
                <td class="fit">202143234</td>
                <td class="fit">Taladtad, Jelan Roy</td>
                <td>P</td>
                <td>A</td>
                <td>P</td>
                <td>A</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>P</td>
                <td>E</td>
                <td>P</td>
                <td>A</td>
                <td>P</td>
                <td>L</td>
                <td>P</td>
                <td>L</td>
                <td>P</td>
                <td>P</td>
                <td class="fit">P=12 A=3 L=4 E=2</td>
            </tr>
        </tbody>
        </table>    
    </div>
    <!-- End of table div -->

</div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
