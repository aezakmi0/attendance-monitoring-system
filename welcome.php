<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h1>Log In</h1>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="email" placeholder="Email" class="form-control input-border">
            <input type="password" name="password" placeholder="Password" class="form-control input-border">
            <button class="btn input-border create-class-button w-100">Log In</button>
        </form>
        <h1>Sign Up</h1>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="first_name" placeholder="First Name" class="form-control input-border">
            <input type="text" name="last_name" placeholder="Last Name" class="form-control input-border">
            <input type="text" name="email" placeholder="Email" class="form-control input-border">
            <input type="password" name="password" placeholder="Password" class="form-control input-border">
            <button class="btn input-border create-class-button w-100">Sign Up</button>
        </form>
        <?php
        check_signup_errors();
        ?>
    </div>

    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>

</html>