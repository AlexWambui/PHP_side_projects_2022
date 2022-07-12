<?php
include_once "src/include/functions.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <title><?= $app_full_name ?></title>
</head>
<body>
        <section class="hero_section img_linear_gradient_bg">
                <h1><span class="golden_color">Golden</span> Decorations MS</h1>
                <p class="slogan">Intelligent design for every lifestyle.</p>
                <a href="src/_login.php" class="action_button">Login</a>
                <p>Don't have an account? <a href="src/_signup.php">Signup</a></p>

                <div class="homepage_stats">
                        <div class="container">
                                <p><?= count_all_rows("users") ?></p>
                                <h1>Users</h1>
                        </div>
                        <div class="container">
                                <p><?= count_all_rows("services") ?></p>
                                <h1>Services</h1>
                        </div>
                        <div class="container">
                                <p><?= count_all_rows("bookings") ?></p>
                                <h1>Bookings</h1>
                        </div>
                </div>
        </section>
</body>
</html>
