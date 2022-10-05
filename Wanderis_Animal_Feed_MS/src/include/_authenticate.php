<?php
function ensure_user_logged_in()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: ../index.php");
    }
}

function signup()
{
    global $db_connection;

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $user_level = 1;

    $sql = mysqli_prepare($db_connection, "SELECT * FROM users WHERE email_address = ?");
    mysqli_stmt_bind_param($sql, "s", $email);
    mysqli_stmt_execute($sql) or die (mysqli_stmt_error($sql));
    $fetched_user = mysqli_stmt_get_result($sql);

    if (mysqli_num_rows($fetched_user) == 1) {
        setcookie('error', 'That email is taken!!!', time() + 2);
        header('location: ./signup.php');
    } 
    else {
        $sql = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `email_address`, `phone_number`, `password`, `user_level`) VALUES(?,?,?,?,?,?)");
        mysqli_stmt_bind_param($sql, "sssssi", $first_name, $last_name, $email, $phone_number, $password, $user_level);
        mysqli_stmt_execute($sql) or die(mysqli_stmt_error($sql));
        setcookie('success', 'Registered. You can now login!', time() + 2);
        header('location: ./login.php');
    }
}

function login()
{
    global $db_connection;

    $email = $_REQUEST["email_address"];
    $password = $_REQUEST["password"];

    $sql = mysqli_prepare($db_connection, "SELECT * FROM users WHERE email_address = ?");
    mysqli_stmt_bind_param($sql, "s", $email);
    mysqli_stmt_execute($sql) or die (mysqli_stmt_error($sql));
    $fetched_user = mysqli_stmt_get_result($sql);

    if (mysqli_num_rows($fetched_user) == 1) {
        $user = mysqli_fetch_assoc($fetched_user);
        $db_password = $user['password'];
        if ($db_password == $password) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_first_name"] = $user["first_name"];
            $_SESSION["user_last_name"] = $user["last_name"];
            $_SESSION["user_level"] = $user['user_level'];
            $_SESSION["user_login_status"] = true;
            header('location: dashboard.php');
        } else {
            setcookie('error', "Wrong username or Password", time() + 3);
            header('location: ./login.php');
        }
    } else {
        setcookie('error', "Wrong username or Password", time() + 3);
        header('location: ./login.php');
    }
}
