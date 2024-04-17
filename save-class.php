<?php

require_once 'includes/check_session.inc.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_ID = $_SESSION['user_id'];
    $class_code = $_POST["class_code"];
    $class_name = $_POST["class_name"];
    $room = $_POST["room"];
    $time_start = $_POST["time_start"];
    $time_end = $_POST["time_end"];


    // Convert time_start to 24-hour format
    $time_start_24h = date("H:i:s", strtotime($time_start));

    // Convert time_end to 24-hour format
    $time_end_24h = date("H:i:s", strtotime($time_end));

    // Check if "day" key exists and is an array
    $selected_days = isset($_POST["day"]) && is_array($_POST["day"]) ? implode("", $_POST["day"]) : '';

    // SQL query to insert data into the database
    $sql = "INSERT INTO tb_class (user_ID, class_code, class_name, room, time_start, time_end, day)
            VALUES ('$user_ID', '$class_code', '$class_name', '$room', '$time_start_24h', '$time_end_24h', '$selected_days')";

    // Create connection (replace these values with your actual database credentials)
    $servername = "server1319";
    $username = "u341493210_aezakmi0";
    $password = '$variable1="Hi";';
    $dbname = "u341493210_db_attendance";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // class.php?id=${class_ID}

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Retrieve the last inserted ID
        $last_insert_id = $conn->insert_id;

        // Redirect to another page using the class_ID
        header("Location: enroll-student.php?id=" . $last_insert_id);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>