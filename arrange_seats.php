<!-- arrange_seats.php -->
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
    <!-- Include Muuri styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.css">
</head>
<body>
    <div class="container seatplan-main-container">
    <div class="my-grid">
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
                $query = "SELECT seatplan_ID, seat_number, student_ID FROM tb_seatplan WHERE class_ID = $classId ORDER BY seat_number";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Fetch student data
                        $studentId = $row['student_ID'];
                        $studentQuery = "SELECT first_name, last_name FROM tb_student WHERE student_ID = $studentId";
                        $studentResult = mysqli_query($conn, $studentQuery);
                        $studentData = mysqli_fetch_assoc($studentResult);

                        echo '<div class="seatplan-seat-edit item" data-id="' . $row['seatplan_ID'] . '" data-seat-number="' . $row['seat_number'] . '" data-student-id="' . $studentId . '">';
                        echo '<div class="seatplan-seat-content">';
                        echo '<p class="seatplan-lastname">' . $studentData['last_name'] . '</p>';
                        echo '<p class="seatplan-firstname">' . $studentData['first_name'] . '</p>';
                        echo '</div>';
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
    </div>

    <!-- Save button -->
    <div class="text-center mt-4">
        <button id="saveButton" class="btn btn-primary">Save</button>
    </div>

    <!-- Include necessary scripts for Muuri and your custom script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.2/web-animations.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/haltu/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var grid = new Muuri('.my-grid', {
                dragEnabled: true,
                layoutOnInit: true,
                layout: {
                    rounding: false // Ensure that rounding is disabled
                }
            });

            // Save button click event
            document.getElementById('saveButton').addEventListener('click', function () {
                saveSeatplan(grid);
            });

            function saveSeatplan(grid) {
                // Get the order of items (seatplan IDs) after the rearrangement
                var itemOrder = grid.getItems().map(function (item) {
                    return {
                        seatplanId: item.getElement().getAttribute('data-id'),
                        seatNumber: item.getElement().getAttribute('data-seat-number'),
                        studentId: item.getElement().getAttribute('data-student-id')
                    };
                });

                // Send the order to the server using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'save_seatplan.php',
                    data: {
                        classId: <?php echo $classId; ?>,
                        seatplanOrder: itemOrder
                    },
                    success: function (response) {
                        alert(response);
                    },
                    error: function (error) {
                        console.error('Error saving seatplan:', error);
                    }
                });
            }
        });
    </script>
</body>
</html>
