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
    <style>
        .profile-contents {
            min-width: 300px;
            margin-right: 50px;
        }

        .profile-form {
            width: 100%;
        }

        .list-group-item {
            font-size: 15px !important;
        }

        .list-group-item.active {
            border: 1px solid #227710 !important;
            background-color: #227710 !important;
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="container d-flex mb-3 page-title">
        <div class="profile-contents list-group">
            <a class="list-group-item active">Change Name and Email</a>
            <a class="list-group-item" href="change-password.php">Change Password</a>
        </div>
        <div class="profile-form">
            <form action="update-account-name.php" method="post" class="form-control p-5 bg-light">
                <h1 class="text-center">Change Name and Email</h1>
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
                        value="<?php echo $_SESSION['user_email']; ?>">
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn input-border create-class-button">Save Changes</button>
                </div>
            </form>
        </div>
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