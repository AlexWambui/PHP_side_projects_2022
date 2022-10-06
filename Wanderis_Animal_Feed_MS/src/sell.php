<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_products.php";
include_once "_sales.php";
ensure_user_logged_in();
if(isset($_POST['submit_btn'])) sell_product();
start_html("Sell Product");
include_once "include/sidenav.php";
?>
    <main class="Sell_product">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-6 mt-3">
                    <div class="card">
                <h5 class="card-header text-center">Sell Product</h5>
                <div class="card-body">
                    <?php foreach(fetch_product() as $product): ?>
                    <form action="./sell.php" method="post" autocomplete="off">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="form-group">
                            <label for="category">Feed Category</label>
                            <input type="text" 
                            name="category" 
                            id="category"
                            class="form-control" 
                            value="<?php $category = $product['category']; interpret_category($category) ?>"
                            readonly>                            
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" 
                            name="product_name" 
                            id="product_name"
                            class="form-control" 
                            value="<?= $product['product_name'] ?>"
                            readonly>
                        </div>
                        <div class="form-group">
                            <label for="price">Price per Kg.</label>
                            <input type="number" 
                                name="price" 
                                id="price"
                                class="form-control" 
                                step="any"
                                min="0"
                                value="<?= $product['price'] ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount_in_kgs">Amount in Kgs.</label>
                            <input type="number" 
                                name="amount_in_kgs" 
                                id="amount_in_kgs"
                                class="form-control" 
                                step="any"
                                min="0"
                                placeholder="Amount in Kgs. (eg) 5"
                                autofocus
                                required>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="cash" name="payment_method" value="1">
                                <label class="custom-control-label" for="cash">Cash</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="mpesa" name="payment_method" value="2">
                                <label class="custom-control-label" for="mpesa">Mpesa</label>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block" name="submit_btn">Sell</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <a href="products.php" class="btn btn-danger btn-block">Cancel</a>
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