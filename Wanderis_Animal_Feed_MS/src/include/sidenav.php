<aside class="sidenav">
    <div class="app_name">
        <h1><?= $app_name ?></h1>
    </div>
    <ul>
        <li><a href="dashboard.php"><span class="icon-home"></span> Dashboard</a></li>
        <?php if ($_SESSION['user_level'] == 3): ?>
            <li><a href="users.php"><span class="icon-users"></span> Users</a></li>
        <?php endif; ?>
        <li><a href="services.php"><span class="icon-shopping-cart"></span> Products</a></li>
        <li><a href="billings.php"><span class="icon-money"></span> Billings</a></li>
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