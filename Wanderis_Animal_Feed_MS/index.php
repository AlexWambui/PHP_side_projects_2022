<?php
include_once "src/include/functions.php"
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta 
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <title><?= $app_full_name ?></title>
</head>
<body>
    <section class="Home">
        <div class="home_navbar">
            <div class="navbar">
                <div class="logo">
                    <p><?= $app_name ?></p>
                </div>
                <div class="nav_links">
                    <ul>
                        <li><a href="src/login.php">Login</a></li>
                        <li><a href="src/signup.php">Signup</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="hero_section">
            <div class="app_details">
                <h1><?= $app_full_name ?></h1>
                <h2><?= $app_slogan ?></h2>
            </div>
            <div class="app_stats">
                <div class="stat">
                    <span class="icon icon-users"></span>
                    <h1><?= count_all('users') ?></h1>
                    <h2>Users</h2>
                </div>
                <div class="stat">
                    <span class="icon icon-shopping-cart"></span>
                    <h1><?= count_all('products') ?></h1>
                    <h2>Products</h2>
                </div>
                <div class="stat">
                    <span class="icon icon-money"></span>
                    <h1><?= count_all('sales') ?></h1>
                    <h2>Sales</h2>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>copyright&copy;2022. All right reserved.</p>
        </div>
    </section>
</body>
</html>
