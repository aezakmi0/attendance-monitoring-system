<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // $classId = $_POST['class_id'];
    $class_code = $_POST["class_code"];
    $class_name = $_POST["class_name"];
    $room = $_POST["room"];
    $time_start = $_POST["time_start"];
    $time_end = $_POST["time_end"];

    // Check if "day" key exists and is an array
    $selected_days = isset($_POST["day"]) && is_array($_POST["day"]) ? implode("", $_POST["day"]) : '';

    // SQL query to insert data into the database
    $sql = "INSERT INTO tb_class (class_code, class_name, room, time_start, time_end, day)
            VALUES ('$class_code', '$class_name', '$room', '$time_start', '$time_end', '$selected_days')";

    // Create connection (replace these values with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_attendance";

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