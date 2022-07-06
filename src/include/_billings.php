<?php
function fetch_this_billing(): mysqli_result|bool
{
    global $db_connection;
    $id = $_REQUEST['update_id'];

    $fetched_records = $db_connection->query(
        "SELECT * FROM bookings WHERE bookings.id = '$id' 
    ") or die($db_connection);
    return $fetched_records;
}

function fetch_user_billings(): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['user_id'];

    $fetched_records = $db_connection->query(
        "SELECT users.id AS user_id, users.*, services.id AS service_id, services.*, bookings.id AS booking_id, bookings.*
        FROM bookings
        LEFT JOIN services
        ON services.id = bookings.service_id
        LEFT JOIN users
        ON users.id = bookings.customer_id 
        WHERE users.id = '$id' 
    ") 
        or die($db_connection
    );
    return $fetched_records;
}

function fetch_billings(): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['user_id'];

    $fetched_records = $db_connection->query(
        "SELECT users.id AS user_id, users.*, services.id AS service_id, services.*, bookings.id AS booking_id, bookings.*
        FROM bookings
        LEFT JOIN services
        ON services.id = bookings.service_id
        LEFT JOIN users
        ON users.id = bookings.customer_id 
    ") 
        or die($db_connection
    );
    return $fetched_records;
}

function billing_paid() {
    global $db_connection;
    $id = $_REQUEST['update_id'];
    $payment_status = 1;

    $sql = $db_connection->query("UPDATE bookings SET `payment_status` = '$payment_status' WHERE bookings.id = '$id' ") or die($db_connection);
    setcookie('success', 'Billing has been updated!', time() + 2);
    header('location: ./billings.php');
}

function interpret_payment_status($payment_status){
    if($payment_status == 0){
            echo "Not paid";
    }else if ($payment_status == 1){
            echo "Paid";
    }
}

function calculate_user_billing(){
    global $db_connection;

    $total = 0;
    foreach (fetch_user_billings() as $billing){
        $price = $billing['price'];
        $units = $billing['units_or_rooms'];

        $total += $price * $units;
    }
    return $total;
}

function calculate_total_billing(){
    global $db_connection;

    $total = 0;
    foreach (fetch_billings() as $billing){
        $price = $billing['price'];
        $units = $billing['units_or_rooms'];

        $total += $price * $units;
    }
    return $total;
}
