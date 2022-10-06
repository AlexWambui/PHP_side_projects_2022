<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_products.php";
ensure_user_logged_in();
if(isset($_POST['submit_btn'])) update_product();
start_html("Update Product");
include_once "include/sidenav.php";
?>
    <main class="Update_product">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-9 mt-3">
                    <div class="card">
                <h5 class="card-header text-center">Update Product</h5>
                <div class="card-body">
                    <?php foreach(fetch_product() as $product): ?>
                    <form action="./update_product.php" method="post" autocomplete="off">
                        <input type="hidden" name="update_id" value="<?= $product['id'] ?>">
                        <div class="form-group">
                            <label for="category">Feed Category</label>
                            <select name="category" id="category" class="selectpicker form-control"
                                    data-live-search="true" required>
                                <option value="<?= $product['category'] ?>">
                                    <?php
                                        $category = $product['category'];
                                        interpret_category($category);
                                    ?>
                                </option>
                                <option value="1">Poultry</option>
                                <option value="2">Cattle</option>
                                <option value="3">Dog</option>
                                <option value="4">Cat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" 
                            name="product_name" 
                            id="product_name"
                            class="form-control" 
                            placeholder="(e.g) Leimuller Chicken Layer Feed Pellets"
                            value="<?= $product['product_name'] ?>"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price per Kg.</label>
                            <input type="number" 
                                name="price" 
                                id="price"
                                class="form-control" 
                                placeholder="Price in Kshs (eg) 1000." 
                                step="any"
                                min="0"
                                value="<?= $product['price'] ?>"
                                required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block" name="submit_btn">Update</button>
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