<?php
require_once 'includes/check_session.inc.php';
require_once 'includes/dbh.inc.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $classId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Perform the deletion
    try {
        // Use PDO for the update
        $sql = "UPDATE tb_class SET is_deleted = 1 WHERE class_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$classId]);

        // Redirect to a confirmation page or back to the class list
        header("Location: index.php");
        $_SESSION['success_message'] = 'Class deleted!';
        exit();
    } catch (Exception $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect to an error page or back to the class list
    header("Location: index.php");
    exit();
}
