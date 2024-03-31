<?php
require_once 'includes/check_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
</head>

<body>
    <div class="container mb-3 page-title">
        <form action="update-account.php" method="post" class="form-control p-5 bg-light">
            <h1 class="text-center">Account Settings</h1>
            <div class="form-group">
                <label for="first_name" class="label-text mb-1 mt-3">FIRST NAME</label>
                <input type="text" class="form-control input-border" id="first_name" name="first_name"
                    value="<?php echo $_SESSION['user_first_name']; ?>">
            </div>
            <div class="form-group">
                <label for="last_name" class="label-text mb-1 mt-3">LAST NAME</label>
                <input type="text" class="form-control input-border" id="last_name" name="last_name"
                    value="<?php echo $_SESSION['user_last_name']; ?>">
            </div>
            <div class="form-group">
                <label for="email" class="label-text mb-1 mt-3">EMAIL</label>
                <input type="text" class="form-control input-border" id="email" name="email"
                    value="<?php echo $_SESSION['user_email']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="current_password" class="label-text mb-1 mt-3">CURRENT PASSWORD</label>
                <input type="password" class="form-control input-border" id="current_password" name="current_password">
            </div>
            <div class="form-group">
                <label for="new_password" class="label-text mb-1 mt-3">NEW PASSWORD</label>
                <input type="password" class="form-control input-border" id="new_password" name="new_password">
            </div>
            <div class="d-flex justify-content-center mt-5"></div>
            <button type="submit" class="btn input-border create-class-button">Save Changes</button>
        </form>
    </div>

    <!-- TOAST CONTAINER -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer">
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php
            // Check if a success message is set
            if (isset($_SESSION['success_message'])) {
                // Display the toast message
                echo 'showToast("' . $_SESSION['success_message'] . '");';

                // Clear the session variable to avoid displaying the message again on subsequent visits
                unset($_SESSION['success_message']);
            }
            ?>
        });
    </script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>