<?php
// Assuming you have a database connection established

// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "u341493210_aezakmi0";
$password = '$variable1="Hi";';
$dbname = "u341493210_db_attendance";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function formatTime($time)
{
    return date("h:iA", strtotime($time));
}

// Check if class_id is provided in the GET request
if (isset($_GET['id'])) {
    $classId = $_GET['id'];
        
    // Assuming you have a table named 'tb_class' with columns 'class_id', 'class_code', and 'class_name'
    $sql = "SELECT * FROM tb_class WHERE class_ID = $classId AND is_deleted = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the first row (assuming class_id is unique)
        $row = $result->fetch_assoc();  

        // Display values in the HTML tags
        echo "<div>
                <h1 class=\"class-code-2\">" . $row["class_code"] . "</h1>
                <p class=\"class-name-2\">" . $row["class_name"] . " | " . $row["room"] . " " . formatTime($row["time_start"]) . "-" . formatTime($row["time_end"]) . " " . $row["day"] . "</p>
            </div>";
    } else {
        echo "No results for the specified class_id";
    }
} else {
    echo "Class_id not provided in the request";
}

// Close the database connection
$conn->close();
?>

