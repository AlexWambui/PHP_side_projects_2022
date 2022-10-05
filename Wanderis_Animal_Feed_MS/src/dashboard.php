<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
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
                        <p>Total: 54</p>
                    </div>
                    <span class="icon icon-users"></span>
                </div>
                <div class="statistic">
                    <div class="details">
                        <h1>Products</h1>
                        <p>Total: 54</p>
                        <p>Pending: 5</p>
                        <p>Approved: 6</p>
                    </div>
                    <span class="icon icon-shopping-cart"></span>
                </div>
                <div class="statistic">
                    <div class="details">
                        <h1>Billings</h1>
                        <p>Total: 54</p>
                        <p>Paid: 5</p>
                        <p>Pending: 5</p>
                    </div>
                    <span class="icon icon-money"></span>
                </div>
            </div>
        </div>
</main>
<?php end_html(); ?>