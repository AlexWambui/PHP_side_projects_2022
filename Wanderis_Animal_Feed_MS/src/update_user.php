<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_users.php";
ensure_user_logged_in();
if(isset($_POST['submit_btn'])) update_user();
start_html("Update User");
include_once "include/sidenav.php";
?>
    <main class="Update_user">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-9 mt-3">
                    <div class="card">
                <h5 class="card-header text-center">Update User</h5>
                <div class="card-body">
                    <?php foreach(fetch_this_user() as $user): ?>
                    <form action="./update_user.php" method="post" autocomplete="off">
                        <input type="hidden" name="update_user_id" value="<?= $user['id'] ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" required value="<?= $user['first_name'] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required value="<?= $user["last_name"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required value="<?= $user["email_address"] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" class="form-control" required value="<?= $user["phone_number"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required value="<?= $user["password"] ?>">
                                </div>
                            </div>                            
                        </div>
                                <div class="form-group">
                                    <label for="user_level">User Level</label>
                                    <select name="user_level" id="user_level" class="form-control" required>
                                        <option value="<?= $user['user_level'] ?>">
                                            <?php
                                                $user_level = $user['user_level'];
                                                interpret_user_level($user_level);
                                            ?>
                                        </option>
                                        <option value="1">User</option>
                                        <option value="2">Admin</option>
                                        <option value="3">DB Admin</option>
                                    </select>
                                </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block" name="submit_btn">Update</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <a href="users.php" class="btn btn-danger btn-block">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>
            </div>
                    </div>
                </div>
            </div>
    </main>
<?php end_html() ?>