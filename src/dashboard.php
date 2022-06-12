<?php
include_once "include/_include_authenticated_essentials.php";
start_html("Dashbaord");
include_once "include/sidenav.php" 
?>
<section class="container main_content dashboard">
        <h1>Hi <?= $_SESSION['user_first_name'] ?></h1>
        <div class="statistics">
                <div class="container">
                        <h1>Users</h1>
                        <p>Total Users: <span><?= count_all_rows("users") ?></span></p>
                </div>
                <div class="container">
                        <h1>Orders</h1>
                        <p>Pending orders: <span>20</span></p>
                </div>
        </div>
</section>
<?php end_html() ?>