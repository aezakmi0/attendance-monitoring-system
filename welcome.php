<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
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
    <style>
        body {
            background-image: url("img/login-bg.png");
            background-repeat: no-repeat;
            background-color: #fff;
            background-position: center;
            background-size: cover;
            height: 100%;
        }

        .seal {
            max-width: 7vw;
            margin-bottom: 15px;
        }
        .class-code{
            line-height: 1;
        }
        .title-container {
            margin-right: 13%;
        }

        .login-container {
            width: 300px;
            padding: 40px 30px;
            border-radius: 10px;
            border: 3px solid #227710;
            box-shadow: 0 30px 40px 0px #cfcfcf;
        }

        .signup-container {
            width: 300px;
            padding: 40px 30px;

            position: absolute;
            top: -9999px;
            left: -9999px;
            visibility: hidden;
            opacity: 0;
        }
        .container{
            margin-top: 20vh !important;
            max-width:900px !important;
        }
        .login-box{
            background-color: #EAEAEA;
            border: 1px solid #cfcfcf;
            transition: background-color .3s;
        }
        .login-box:active {
            background-color: #ddd;
        }
        .form-error{
            background-color: #F8D7DA !important;
            border: 1px solid #F5C6CB !important;
            border-radius: 5px;
            padding: 10px;
            font-size: 13px;
            color: #881C59;
            margin-bottom: 3px !important;
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center">
        <div class="col title-container text-center">
            <img class="seal" src="img/ndduseal.png" alt="NDDU seal">
            <h1 class="class-code">Attendance Monitoring System</h1>
        </div>

        <div class="form-container">
            <!-- LOG IN -->
            <div class="login-container">
                <h1 class="class-code mb-2">Log In</h1>
                <p class="label-text-2 mb-4">Welcome back! Please login to your account.</p>
                <?php check_login_errors(); ?>
                <form action="includes/login.inc.php" method="post" class="mb-2">
                    <input type="text" name="email" placeholder="Email" class="mt-4 form-control login-box mb-1">
                    <input type="password" name="password" placeholder="Password" class="form-control login-box mb-4">
                    <button class="btn create-class-button w-100">Log In</button>
                </form>
                <p class="label-text-2">Don't have an account? <a href="#">Sign up</a></p>
            </div>

            <!-- SIGN UP -->
            <!-- <div class="signup-container">
                    <div class="">
                        <h1>Sign Up</h1>
                        <form action="includes/signup.inc.php" method="post">
                            <?php
                            //signup_inputs();
                            ?>
                            <button class="btn input-border create-class-button w-100">Sign Up</button>
                        </form>
                        <?php //check_signup_errors();  ?>
                    </div>
                </div> -->
        </div>
    </div>
    <!-- 
        <h1>Log Out</h1>
        <form action="includes/logout.inc.php" method="post">
            <button class="btn input-border create-class-button w-100">Log In</button>
        </form> -->


    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="script.js"></script> -->
</body>

</html>