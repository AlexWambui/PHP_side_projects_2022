<?php
include_once "include/_include_essentials.php";
if(isset($_POST['submit_btn'])) signup();
start_html("Signup") 
?>
<section class="img_linear_gradient_bg vw-100 vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 mt-5">
                <div class="container text-center home_page_link">
                        <h4><a href="../index.php" class="text-light"><?= $app_name ?></a></h4>
                </div>
                <div class="account_form text-light">
                    <div class="account_form_header">
                        <h4>Signup</h4>
                    </div>
                    <?= alert() ?>
                    <form action="./_signup.php" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col">
                            <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" autofocus required>
                        </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required>
                        </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_address">Email Address</label>
                            <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control password" required>
                            <span id="eye" class="icon icon-eye" onclick="toggle_password()"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block" name="submit_btn">Signup</button>
                            <p class="text-center mt-2">Already have an Account? <a href="_login.php" class="text-light">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../assets/js/toggle_password.js"></script>
<?php end_html() ?>