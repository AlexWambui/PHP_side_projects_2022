<?php
function fetch_this_service(): mysqli_result|bool
{
    global $db_connection;
    $id = $_REQUEST['update_id'];

    $fetched_records = $db_connection->query("SELECT * FROM services WHERE id = '$id' ") or die($db_connection);
    return $fetched_records;
}

function add_service()
{
    global $db_connection;

    $service_name = $_REQUEST['service_name'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];
    $service_image = upload_image("service_image");

    $sql = mysqli_prepare($db_connection, "INSERT INTO services (`service_name`, `description`, `price`, `service_image`) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($sql, "ssis", $service_name, $description, $price, $service_image);
    mysqli_stmt_execute($sql) or die(mysqli_error($db_connection));
    setcookie('success', 'Service has been added!', time() + 2);
    header('location: ./services.php');
}

function update_service()
{
    global $db_connection;
    $id = $_REQUEST['update_service_id'];
    $service_name = $_REQUEST['service_name'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];

    $sql = $db_connection->query("UPDATE services SET `service_name` = '$service_name', `description` = '$description', `price` = '$price' WHERE services.id = '$id' ") or die($db_connection);
    setcookie('success', 'Service has been updated!', time() + 2);
    header('location: ./services.php');
}

function delete_service()
{
    delete('services');
    setcookie("success", "Service has been deleted 😮.", time() + 2);
    header('location: ./services.php');
}