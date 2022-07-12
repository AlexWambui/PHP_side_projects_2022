<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_billings.php";
include_once "include/_services.php";
start_html("Dashbaord");
include_once "include/sidenav.php" 
?>
<section class="container main_content dashboard">
        <h1>Hi <?= $_SESSION['user_first_name'] ?></h1>
        <div class="statistics">
                <?php if($_SESSION['user_level'] == 3): ?>
                <div class="container">
                        <h1>Users</h1>
                        <p>Total Users: <span><?= count_all_rows("users") ?></span></p>
                </div>
                <?php endif; ?>
                <div class="container">
                        <h1>Services</h1>
                        <p>Total Services: <span><?= count_all_rows("services") ?></span></p>
                </div>
                <div class="container">
                        <h1>Bookings</h1>
                        <?php if($_SESSION['user_level'] == 1): ?>
                        <p>Total Bookings: <span><?= count_user_bookings() ?></span></p>
                        <p>Pending: <span><?= count_user_pending_bookings() ?></span></p>
                        <?php endif; ?>
                        <?php if($_SESSION['user_level'] != 1): ?>
                                <p>Total Bookings: <span><?= count_all_rows("bookings") ?></span></p>
                                <p>Pending: <span><?= count_pending_bookings() ?></span></p>
                        <?php endif; ?>
                </div>
                <?php if($_SESSION['user_level'] == 1): ?>
        <div class="container">
                <h1>Billings</h1>
                <p>Total Billings: <span><?= mysqli_num_rows(fetch_user_billings()) ?></span></p>
                <p>Amount: <span><?= calculate_total(fetch_user_billings()) ?></span></p>
        </div>
        <?php endif; ?>
        </div>
        <hr />
        <?php if($_SESSION['user_level'] != 1): ?>
        <div class="stats">
                <h1>Billings</h1>
                <p>Total Billings: <span><?= calculate_total(fetch_billings()) ?></span></p>
                <p>Paid Billings: <span class="text-success"><?= calculate_total(fetch_billing_paid()) ?></span></p>
                <p>Pending Billings: <span class="text-danger"><?= calculate_total(fetch_billing_not_paid()) ?></span></p>
        </div>
        <?php endif; ?>
</section>
<?php end_html() ?>