<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_products.php";
ensure_user_logged_in();
if(isset($_POST['add_product'])) add_product();
if(isset($_POST['delete'])) delete_product();
start_html("Products"); 
include_once "include/sidenav.php";
?>
<main class="Products">
    <div class="container">
    <?php if($_SESSION['user_level'] != 1): ?>
        <div class="nav">
            <div class="product_button text-right">
                <div class="modal fade text-dark" id="modalAddProduct" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Add a Product / Feed</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <form action="./products.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                    <div class="form-group">
                                        <label for="category">Feed Category</label>
                                        <select name="category" id="category" class="selectpicker form-control"
                                                data-live-search="true" required>
                                            <option data-tokens="none_selected">Select Category</option>
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
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_image">Product Image</label>
                                        <input type="file" accept="image/*" class="form-control-file border"
                                            name="product_image" required>
                                    </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" name="add_product" id="add_product" class="btn btn-success btn-rounded btn-block">
                                    Save
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>                    
                </div>                         
                <div class="nav_links"> 
                    <p><?= count_all('products') ?> Product(s)</p>    
                    <a href="" class="btn btn-success btn-rounded" data-toggle="modal"
                    data-target="#modalAddProduct"><span class="icon icon-add"></span> New Product</a>               
                </div>                
            </div>
        </div>
        <?php endif; ?>
        <div class="products_list <?php if($_SESSION['user_level'] != 1) echo 'marginated' ?>">            
            <?php 
                alert();
                product_card('Chicken Feed', 1);
                product_card('Cattle Feed', 2);
                product_card('Dog Feed', 3);
                product_card('Cat Feed', 4);
            ?>
        </div>
    </div>
</main>
<script src="../assets/js/confirm_delete.js"></script>
<?php end_html(); ?>