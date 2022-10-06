<?php
include_once "include/functions.php";

function sell_product()
{
    global $db_connection;

    $product_id = $_REQUEST['product_id'];
    $amount_in_kgs = $_REQUEST['amount_in_kgs'];
    $payment_method = $_REQUEST['payment_method'];

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO sales (`product_id`, `amount_in_kgs`, `payment_method`) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($sql_add, "idi", $product_id, $amount_in_kgs, $payment_method);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie("success", 'Sale was recorded successfully', time() + 2);
    header('location: ./sales.php');
}

function update_sale()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $amount_in_kgs = $_REQUEST['amount_in_kgs'];
    $payment_method = $_REQUEST['payment_method'];

    $sql_update = mysqli_prepare($db_connection, "UPDATE sales SET `amount_in_kgs` = '$amount_in_kgs', `payment_method` = '$payment_method' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update) or die(mysqli_stmt_error($sql_update));
    setcookie('success', 'Sale was updated successfully 😉.', time() + 2);
    header('location: ./sales.php');
}

function delete_sale()
{
    delete('sales');
    setcookie("success", "Sale has been deleted 😮.", time() + 2);
    header('location: ./sales.php');
}

function fetch_sales(){
    global $db_connection;

    $fetched_records = $db_connection->query("
        SELECT products.id AS product_id, products.*, sales.id AS sale_id, sales.* 
        FROM sales
        LEFT JOIN products ON products.id = sales.product_id 
    ") or die($db_connection);
    return $fetched_records;
}

function fetch_sale(): array
{
    global $db_connection;
    $id = $_REQUEST['update_id'];

    $fetched_record = $db_connection->query("
        SELECT products.id AS product_id, products.*, sales.id AS sale_id, sales.* 
        FROM sales
        LEFT JOIN products ON products.id = sales.product_id
        WHERE sales.id = '$id' 
    ") or die($db_connection);
    return mysqli_fetch_all($fetched_record, 1);
}

function fetch_sales_today()
{
    global $db_connection;

    $today = date("Y-m-d");
    $fetched_records = $db_connection->query("
        SELECT products.id AS product_id, products.*, sales.id AS sale_id, sales.* 
        FROM sales
        LEFT JOIN products ON products.id = sales.product_id
        WHERE sales.date = '$today'
    ") or die($db_connection);
    return $fetched_records;
}

function sales_today()
{
    $sales = 0;
    foreach(fetch_sales_today() as $sale)
        $sales += $sale['price'] * $sale['amount_in_kgs'];
    return $sales;
}

function total_sales()
{
    $sales = 0;
    foreach(fetch_sales() as $sale)
        $sales += $sale['price'] * $sale['amount_in_kgs'];
    return $sales;
}

function count_sales_today(){
    return mysqli_num_rows(fetch_sales_today());
}

function interpret_payment_method($method)
{
    if($method == 1) echo 'Cash';
    else if($method == 2) echo 'Mpesa';
}