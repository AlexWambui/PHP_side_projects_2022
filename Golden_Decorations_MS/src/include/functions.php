<?php
// error_reporting(0);
//global_variables
$app_name = "GDMS";
$app_full_name = "Golden Decorations MS";

//db_connection
$host = "localhost";
$user = "root";
$password = "";
$database = "db_golden_decorations_MS";
$db_connection = mysqli_connect($host, $user, $password, $database);
if (!$db_connection){
    header('location: src/_setup_error.php');
}

function alert()
{
    if (isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> <?= $_COOKIE['error'] ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_COOKIE['success'])): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?= $_COOKIE['success'] ?>
    </div>
<?php endif;
}

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
    $phone = $_POST['phone_number'];
    $password = $_POST['password'];
    $user_level = 1;

    $sql = mysqli_prepare($db_connection, "SELECT * FROM users WHERE email_address = ?");
    mysqli_stmt_bind_param($sql, "s", $email);
    mysqli_stmt_execute($sql) or die (mysqli_stmt_error($sql));
    $fetched_user = mysqli_stmt_get_result($sql);

    if (mysqli_num_rows($fetched_user) == 1) {
        setcookie('error', 'Sorry! That email is taken!!!', time() + 2);
        header('location: ./_signup.php');
    } else {
        $sql = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `email_address`, `phone_number`, `password`, `user_level`) VALUES(?,?,?,?,?,?)");
        mysqli_stmt_bind_param($sql, "sssssi", $first_name, $last_name, $email, $phone, $password, $user_level);
        mysqli_stmt_execute($sql) or die(mysqli_stmt_error($sql));
        setcookie('success', 'Registered. You can now login!', time() + 2);
        header('location: ./_login.php');
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
            setcookie('error', "Oops! Wrong username or Password", time() + 3);
            header('location: ./_login.php');
        }
    } else {
        setcookie('error', "Oops! Wrong username or Password", time() + 3);
        header('location: ./_login.php');
    }
}

function fetch_all($table_name): mysqli_result|bool
{
    global $db_connection;
    $table_name;

    $fetched_records = $db_connection->query("SELECT * FROM $table_name") or die($db_connection);
    return $fetched_records;
}

function fetch_all_into_array($table_name): array
{
    $table_name;
    return mysqli_fetch_all(fetch_all($table_name), 1);
}

function count_all_rows($table_name): int
{
    $table_name;
    return mysqli_num_rows(fetch_all($table_name));
}

function fetch_individual($table_name, $id): array
{
    global $db_connection;

    $fetched_record = $db_connection->query("SELECT * FROM $table_name WHERE id = '$id' ") or die($db_connection);
    return mysqli_fetch_all($fetched_record, 1);
}

function count_individual_rows($table_name, $id): int
{
    global $db_connection;
    $table_name;
    $id;

    $fetched_records = $db_connection->query("SELECT * FROM $table_name WHERE id = '$id' ") or die($db_connection);
    return mysqli_num_rows($fetched_records);
}

function add_record()
{
    global $db_connection;

    $record = $_REQUEST['field_name'];
    $id = $_SESSION["user_id"];

    $sql_insert = mysqli_prepare($db_connection, "INSERT INTO table_name (`field_name`) VALUES (?)");
    mysqli_stmt_bind_param($sql_insert, "s", $record,);
    mysqli_stmt_execute($sql_insert) or die(mysqli_error($db_connection));
    setcookie('success', ''.$record.' was added!', time() + 2);
    header('location: ./_page.php');
}

function update_record()
{
    global $db_connection;

    $id = $_REQUEST['update_building_id'];
    $record = $_REQUEST['field_name'];

    $sql_update = $db_connection->query("UPDATE table_name SET `field_name` = '$redord' WHERE id = '$id' ");
    setcookie('success', ''.$record.' has been updated!', time() + 2);
    header('location: ./_page.php');
}

function delete($table_name)
{
    global $db_connection;
    $delete_id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM $table_name WHERE id = '$delete_id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
}

function delete_record()
{
    global $db_connection;

    $id = $_REQUEST['field_name'];

    $sql_delete = $db_connection->query("DELETE FROM table_name WHERE id = '$id' ") or die($db_connection);
    setcookie('success', ''.$id.' has been deleted!', time() + 2);
    header('location: ./_page.php');
}

function joint_sql_fetch(): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['user_id'];

    $fetched_records = $db_connection->query("SELECT field.id AS alias, users.id AS user_id, table_name.* FROM table1 LEFT JOIN table2 ON table.fieldname = table.fieldname WHERE table.fieldname = '$id' ") or die($db_connection);
    return $fetched_records;
}

function select_options(): string
{
    global $db_connection;

    $output = '';
    $id = $_SESSION['user_id'];
    $result = $db_connection->query("SELECT field.id AS alias, users.id AS user_id, table_name.* FROM table1 LEFT JOIN table2 ON table.fieldname = table.fieldname WHERE table.fieldname = '$id' ");
    while ($building = mysqli_fetch_array($result)) {
        $output .= '<option value="' . $building["building_id"] . '">' . $building["building_name"] . '</option>';
    }
    return $output;
}

function upload_image($image_name): string
{
    $target_dir = "include/uploads/";
    $target_file = $target_dir . rand(10000, 100000) . basename($_FILES[$image_name]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg"];
    $allowed = in_array($imageFileType, $allowed_types);
    if ($allowed and move_uploaded_file($_FILES[$image_name]["tmp_name"], $target_file)) return $target_file;
    else $status = 2;
}

function logout()
{
    session_start();
    session_destroy();
    header('location: ../../index.php');
}

if (isset($_POST['logout_btn'])) logout();

