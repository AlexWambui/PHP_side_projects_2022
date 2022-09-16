<?php
include_once "include/_include_essentials.php";
if(isset($_POST['submit_btn'])) login();
start_html("Login") 
?>
<section class="img_linear_gradient_bg vw-100 vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 mt-5">
                <div class="container text-center home_page_link">
                        <h4><a href="../index.php" class="text-light"><?= $app_name ?></a></h4>
                </div>
                <div class="account_form text-light">
                    <div class="account_form_header">
                        <h4>Login</h4>
                    </div>
                    <?= alert() ?>
                    <form action="./_login.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="email_address">Email Address</label>
                            <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block" name="submit_btn">Login</button>
                            <p class="text-center mt-2">Don't have an Account? <a href="_signup.php" class="text-light">Signup</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php end_html() ?>