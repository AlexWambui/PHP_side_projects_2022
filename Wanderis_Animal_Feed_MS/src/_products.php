<?php
function add_product()
{
    global $db_connection;

    $category = $_REQUEST['category'];
    $product_name = $_REQUEST['product_name'];
    $price = $_REQUEST['price'];

    $target_dir = "uploads/";
    $target_file = $target_dir.rand(10000, 100000).basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg"];
    $allowed = in_array($imageFileType, $allowed_types);
    if ($allowed and move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)){
        $status = 1;
    }
    else
    {
        $status = 2;
    }

    $sql_add = mysqli_prepare($db_connection, "INSERT INTO products (`category`, `product_name`, `price`, `product_image`) VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_add, "isds", $category, $product_name, $price, $target_file);
    mysqli_stmt_execute($sql_add) or die(mysqli_stmt_error($sql_add));
    setcookie("success", 'Product added successfully', time() + 2);
    header('location: ./products.php');
}

function update_meal()
{
    global $db_connection;

    $id = $_REQUEST['update_id'];
    $category = $_REQUEST['category'];
    $meal_name = $_REQUEST['meal_name'];
    $price = $_REQUEST['price'];

    $sql_update_meal = mysqli_prepare($db_connection, "UPDATE meals SET `meal_name` = '$meal_name', `category` = '$category', `price` = '$price' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_meal) or die(mysqli_stmt_error($sql_update_meal));
    setcookie('success', 'Meal updated successfully 😉.', time() + 2);
    header('location: ./meals.php');
}

function delete_meal()
{
    delete('meals');
    setcookie("success", "Meal has been deleted 😮.", time() + 2);
    header('location: ./meals.php');
}

function fetch_category($category_name): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_category = $db_connection->query("SELECT * FROM products WHERE category = '$category_name' ") or die(mysqli_error($db_connection));
    return $sql_fetch_category;
}

function select_meal_options(): string
{
    $output = '';
    foreach (fetch_all('meals') as $meal) {
        $output .= '<option value="'.$meal["id"].'">'.$meal["meal_name"].' @ '.$meal["price"].'</option>';
    }
    return $output;
}

function product_card($title, $category){
    $title;
    $category;
    ?>
    <div class="categories">
                <h1><?= $title ?></h1>
                <div class="category">               
                    <?php foreach(fetch_category($category) as $product): ?>
                        <div class="product_card">
                            <div class="image">
                                <img src="<?= $product['product_image'] ?>" alt="product">
                            </div>                
                            <div class="card_body">
                                <h1><?= $product['product_name'] ?></h1>
                                <p>Price (per kg): <?= $product['price'] ?> /=</p>
                            </div>
                            <div class="footer">
                                <div class="action_button">
                                    <form action="./update_product.php" method="post">
                                        <input type="hidden" name="update_id" value="<?= $product['id'] ?>">
                                        <button type="submit" name="update" class="btn btn-success btn-sm"><span class="icon icon-pencil"></span></button>
                                    </form>
                                </div>
                                <div class="action_button">
                                    <form action="./products.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm"><span class="icon-trash"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
}