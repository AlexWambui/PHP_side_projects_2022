<aside class="sidenav">
    <div class="app_name">
        <h1><?= $app_name ?></h1>
    </div>
    <ul>
        <li><a href="dashboard.php"><span class="icon-home"></span> Dashboard</a></li>
        <?php if ($_SESSION['user_level'] != 1): ?>
            <li><a href="users.php"><span class="icon-users"></span> Users</a></li>
        <?php endif; ?>
        <li><a href="products.php"><span class="icon-shopping-cart"></span> Products</a></li>
        <?php if ($_SESSION['user_level'] != 1): ?>
            <li><a href="sales.php"><span class="icon-money"></span> Sales</a></li>
            <li><a href="reports.php"><span class="icon-file"></span> Reports</a></li>
        <?php endif; ?>
    </ul>
    <div class="account_details">
        <ul>
            <li><?= $_SESSION['user_first_name'] ?></li>
            <li>
                <form action="include/functions.php" method="post">
                    <button type="submit" class="logout_btn" name="logout_btn"><span class="icon-power-off"></span> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</aside>