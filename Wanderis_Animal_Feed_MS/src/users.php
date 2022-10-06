<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_users.php";
ensure_user_logged_in();
if(isset($_POST['delete_user'])) delete_user();
start_html("Users");
include_once "include/sidenav.php" 
?>
        <main class="Users">
                <div class="container">
                <div class="row justify-content-center">
                        <div class="col-12 mt-3">
                                <?= alert() ?>
                                <div class="card">
                                <div class="card-header">
                                        <div class="row">
                                        <div class="col">
                                                <h6><?= count_all('users') ?> User(s)</h6>
                                        </div>
                                        </div>
                                </div>
                                <div class="card-body">
                                        <table class="table table-bordered table-hover" id="data_table">
                                        <thead>
                                        <tr>
                                                <th>Names</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>User Level</th>
                                                <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach(fetch_all("users") as $user): ?>
                                                <tr>
                                                <td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
                                                <td><?= $user['email_address'] ?></td>
                                                <td><?= $user['phone_number'] ?></td>
                                                <td>
                                                        <?php
                                                         $user_level = $user['user_level'];
                                                         interpret_user_level($user_level);
                                                        ?>
                                                </td>
                                                <td>
                                                        <div class="row">
                                                                <div class="col d-flex justify-content-center">
                                                                        <form action="update_user.php" method="post" class="form-inline">
                                                                        <input type="hidden" name="update_id" value="<?= $user['id']; ?>">
                                                                        <button class="btn btn-sm" type="submit" name="edit_user"><span class="text-success table-icons icon-pencil"></span> Update</button>
                                                                        </form>
                                                                </div>
                                                                |
                                                                <div class="col d-flex justify-content-center">
                                                                        <form action="./users.php" method="post">
                                                                                <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                                                                                <button class="btn" type="submit" name="delete_user" onclick="return confirm_delete()"><span class="text-danger table-icons icon-trash"> Delete</span></button>                                                                                                         
                                                                        </form>                                                                
                                                                </div>
                                                        </div>
                                                </td>
                                                </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        </table>
                                </div>
                                </div>
                        </div>
                </div>
                </div>
        </main>
<script src="../assets/js/confirm_delete.js"></script>
<?php
data_table();
end_html();
?>
