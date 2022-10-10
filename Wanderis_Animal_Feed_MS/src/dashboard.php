<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_sales.php";
ensure_user_logged_in();
start_html("Dashboard"); 
include_once "include/sidenav.php";
?>
<main class="Dashboard">
        <div class="container">
            <div class="statistics">
                <div class="statistic">
                    <div class="details">
                        <h1>Users</h1>
                        <p>Total: <?= count_all('users') ?></p>
                    </div>
                    <span class="icon icon-users"></span>
                </div>
                <div class="statistic">
                    <div class="details">
                        <h1>Products</h1>
                        <p>Total: <?= count_all('products') ?></p>
                    </div>
                    <span class="icon icon-shopping-cart"></span>
                </div>
                <?php if($_SESSION['user_level'] != 1): ?>
                <div class="statistic">
                    <div class="details">
                        <h1>Sales</h1>
                        <p>Total: <?= count_all('sales') ?></p>
                        <p>Amount: <?= total_sales() ?> /=</p>
                    </div>
                    <span class="icon icon-money"></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
</main>
<?php end_html(); ?>