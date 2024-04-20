<?php
require_once 'includes/dbh.inc.php';

function formatTime($time){
    return date("h:iA", strtotime($time));
}

// Check if class_id is provided in the GET request
if (isset($_GET['id'])) {
    $classId = $_GET['id'];
        
    // Assuming you have a table named 'tb_class' with columns 'class_id', 'class_code', and 'class_name'
    $sql = "SELECT * FROM tb_class WHERE class_ID = ? AND is_deleted = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$classId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
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