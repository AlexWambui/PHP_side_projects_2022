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

function interpret_approval_status($approval_status){
    if($approval_status == 0){
            echo "Pending";
    }else if ($approval_status == 1){
            echo "Approved";
    }else{
            echo "Rejected";
    }
}

function book_service()
{
    global $db_connection;
    $customer_id = $_SESSION['user_id'];
    $service_id = $_REQUEST['service_id'];
    $date_of_request = $_REQUEST['date_of_request'];
    $venue_address = $_REQUEST['venue_address'];
    $units_or_rooms = $_REQUEST['units_or_rooms'];

    $sql = mysqli_prepare($db_connection, "INSERT INTO bookings (`customer_id`, `service_id`, `date_of_request`, `venue_address`, `units_or_rooms`) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($sql, "iissi", $customer_id, $service_id, $date_of_request, $venue_address, $units_or_rooms);
    mysqli_stmt_execute($sql) or die(mysqli_error($db_connection));
    setcookie('success', 'Booked!', time() + 2);
    header('location: ./bookings.php');
}

function fetch_user_bookings(): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['user_id'];

    $fetched_records = $db_connection->query(
        "SELECT users.id AS user_id, users.*, services.id AS service_id, services.*, bookings.*
        FROM bookings
        LEFT JOIN services
        ON services.id = bookings.service_id
        LEFT JOIN users
        ON users.id = bookings.customer_id 
        WHERE users.id = '$id' ") 
        or die($db_connection
    );
    return $fetched_records;
}

function fetch_all_bookings(): mysqli_result|bool
{
    global $db_connection;

    $fetched_records = $db_connection->query(
        "SELECT users.id AS user_id, users.*, services.id AS service_id, services.*, bookings.*
        FROM bookings
        LEFT JOIN services
        ON services.id = bookings.service_id
        LEFT JOIN users
        ON users.id = bookings.customer_id") 
        or die($db_connection
    );
    return $fetched_records;
}


function count_pending_bookings(): int{
    global $db_connection;

    $fetched_records = $db_connection->query("SELECT * FROM bookings WHERE approval_status = 0 ") or die($db_connection);
    return mysqli_num_rows($fetched_records);
}

function count_approved_bookings(): int{
    global $db_connection;

    $fetched_records = $db_connection->query("SELECT * FROM bookings WHERE approval_status = 1 ") or die($db_connection);
    return mysqli_num_rows($fetched_records);
}

function count_cancelled_bookings(): int{
    global $db_connection;

    $fetched_records = $db_connection->query("SELECT * FROM bookings WHERE approval_status = 2 ") or die($db_connection);
    return mysqli_num_rows($fetched_records);
}

function count_user_bookings(): int{
    return mysqli_num_rows(fetch_user_bookings());
}