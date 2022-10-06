<?php
include_once "__global_variables.php";

//db_connection
$host = "localhost";
$user = "root";
$password = "";
$database = $db_name;
$db_connection = mysqli_connect($host, $user, $password, $database);

function check_db_connection(){
    global $db_connection;

    if($db_connection){
        header('location: index.php');
    }
    else{
        setup_error();
    }
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

function fetch_all($table_name): mysqli_result|bool {
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

function fetch_individual($table_name, $id): array
{
    global $db_connection;

    $fetched_record = $db_connection->query("SELECT * FROM $table_name WHERE id = '$id' ") or die($db_connection);
    return mysqli_fetch_all($fetched_record, 1);
}

function count_all($table_name): int
{
    $table_name;
    return mysqli_num_rows(fetch_all($table_name));
}

function only_count($table_name, $id): int
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

    $sql_update = $db_connection->query("UPDATE table_name SET `field_name` = '$record' WHERE id = '$id' ");
    setcookie('success', ''.$record.' has been updated!', time() + 2);
    header('location: ./_page.php');
}

function delete($table_name){
    global $db_connection;

    $id = $_REQUEST['delete_id'];
    $sql_delete = $db_connection->query("DELETE FROM $table_name WHERE id = '$id' ") or die($db_connection);
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

