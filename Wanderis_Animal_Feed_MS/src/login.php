<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
if(isset($_POST['submit_btn'])) login();
start_html("Login"); 
?>
<section class="Login authentication_form">
        <div class="container">
                <div class="header">
                        <h1>Login</h1>
                </div>
                <div class="body">
                        <?= alert() ?>
                        <form action="./login.php" method="post" autocomplete="off">
                                <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" autofocus required>
                                </div>
                                <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control password_field" required>
                                        <span id="eye" class="icon icon-eye" onclick="toggle_password()"></span>
                                </div>
                                        <div class="form-group">
                                        <button class="btn btn-success btn-block" name="submit_btn">Login</button>
                                        <p class="text-center mt-2">Don't have an account? <a href="signup.php">Signup</a></p>
                                </div>
                    </form>
                </div>
        </div>
</section>
<script src="../assets/js/toggle_password.js"></script>
<?php end_html(); ?>