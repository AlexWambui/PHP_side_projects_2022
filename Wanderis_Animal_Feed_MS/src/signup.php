<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
if(isset($_POST['submit_btn'])) signup();
start_html("Signup"); 
?>
<section class="Signup authentication_form">
        <div class="container">
                <div class="header">
                        <h1>Signup</h1>
                </div>
                <div class="body">
                        <?= alert() ?>
                        <form action="./signup.php" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" autofocus required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                            <label for="email_address">Email Address</label>
                                            <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                                
                                <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control password_field" required>
                                        <span id="eye" class="icon icon-eye" onclick="toggle_password()"></span>
                                </div>
                                        <div class="form-group">
                                        <button class="btn btn-success btn-block" name="submit_btn">Signup</button>
                                        <p class="text-center mt-2">Already have an account? <a href="login.php">Login</a></p>
                                </div>
                    </form>
                </div>
        </div>
</section>
<script src="../assets/js/toggle_password.js"></script>
<?php end_html(); ?>