<?php
function interpret_user_level($user_level){
        if($user_level == 1){
                echo "User";
        }else if ($user_level == 2){
                echo "Admin";
        }else{
                echo "DB Admin";
        }
}

function fetch_this_user(): mysqli_result|bool
{
    global $db_connection;
    $id = $_REQUEST['update_id'];

    $fetched_records = $db_connection->query("SELECT * FROM users WHERE id = '$id' ") or die($db_connection);
    return $fetched_records;
}

function update_user()
{
    global $db_connection;

    $id = $_REQUEST['update_user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone_number'];
    $password = $_POST['password'];
    $user_level = $_POST['user_level'];

    $sql_update_user = $db_connection->query("UPDATE users SET `first_name` = '$first_name', `last_name` = '$last_name', `email_address` = '$email', `phone_number` = '$phone', `user_level` = '$user_level' WHERE id = '$id' ");
    setcookie('success', 'Updated Successfully!', time() + 2);
    header('location: users.php');
}

function delete_user() {
        delete('users');
        setcookie("success", "User has been deleted 😮.", time() + 2);
        header('location: ./users.php');
}