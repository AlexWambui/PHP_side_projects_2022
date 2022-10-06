<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_sales.php";
ensure_user_logged_in();
if(isset($_POST['submit_btn'])) update_sale();
start_html("Update Sale");
include_once "include/sidenav.php";
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 mt-3">
                <div class="card">
                    <h6 class="card-header text-center">Update Sale</h6>
                    <div class="card-body">
                        <?php foreach(fetch_sale() as $sale): ?>
                            <form action="./update_sale.php" method="post" autocomplete="off">
                                <input type="hidden" name="update_id" value="<?= $sale['id'] ?>">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" 
                                    name="product_name" 
                                    id="product_name"
                                    class="form-control" 
                                    value="<?= $sale['product_name'] ?>"
                                    readonly>                            
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" 
                                    name="price" 
                                    id="price"
                                    class="form-control" 
                                    value="<?= $sale['price'] ?>"
                                    readonly>                            
                                </div>
                                <div class="form-group">
                                    <label for="amount_in_kgs">Amount in Kgs</label>
                                    <input type="text" 
                                    name="amount_in_kgs" 
                                    id="amount_in_kgs"
                                    class="form-control" 
                                    value="<?= $sale['amount_in_kgs'] ?>" autofocus>                            
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="cash" name="payment_method" value="1" <?php if($sale['payment_method'] == 1) echo 'checked' ?>>
                                        <label class="custom-control-label" for="cash">Cash</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="mpesa" name="payment_method" value="2" <?php if($sale['payment_method'] == 2) echo 'checked' ?>>
                                        <label class="custom-control-label" for="mpesa">Mpesa</label>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <button class="btn btn-success btn-block" name="submit_btn">Update</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <a href="sales.php" class="btn btn-danger btn-block">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php end_html() ?>