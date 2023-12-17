<!-- arrange_seats.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrange seats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="grid">
    <?php
        // Include the database connection file
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "db_attendance";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the class_ID from the URL
        $classId = isset($_GET['id']) ? $_GET['id'] : null;

        // Fetch seatplan data for the specific class_ID
        if ($classId) {
            $query = "SELECT seatplan_ID, student_ID, seat_number FROM tb_seatplan WHERE class_ID = $classId ORDER BY seat_number";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="item" data-id="' . $row['seatplan_ID'] . '">';
                    echo '<div class="item-content">' . $row['seat_number'] . '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo "Class ID not provided.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>

    <!-- Include necessary scripts for Muuri and your custom script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="script.js"></script>
</body>
</html>