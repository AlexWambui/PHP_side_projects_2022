<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_users.php";
start_html("Users");
include_once "include/sidenav.php" 
?>
<section class="container main_content users">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col-10 mt-3">
                                <?= alert() ?>
                                <div class="card">
                                <div class="card-header">
                                        <div class="row">
                                        <div class="col">
                                                <h6><?= count_all_rows("users") ?> User(s)</h6>
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
                                                                <form action="./users.php" method="post" class="form-inline">
                                                                <input type="hidden" name="delete_user_id" id="delete_user_id" value="<?= $users['id'] ?>">
                                                                <button type="submit" name="delete_user" class="btn btn-sm"><span class="text-danger table_icons icon-trash"></span> Delete</button>
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
</section>
<?php
data_table();
end_html();
?>
