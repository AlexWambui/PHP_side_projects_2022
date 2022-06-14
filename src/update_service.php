<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_services.php";
if(isset($_POST['submit_btn'])) update_service();
start_html("New Service") ;
include_once "include/sidenav.php";
?>
<section class="main_content">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col-8 mt-5">
                                <div class="card">
                                        <h5 class="card-header text-center">Update Service</h5>
                                        <div class="card-body">
                                                <?= alert() ?>
                                                <?php foreach(fetch_this_service() as $service): ?>
                                                <form action="./update_service.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                                <input type="hidden" name="update_service_id" value="<?= $service['id'] ?>">
                                                        <div class="form-group">
                                                                <label for="service_name">Service Name</label>
                                                                <input type="text" name="service_name" id="service_name" placeholder="Service Name" class="form-control" value="<?= $service['service_name'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <input type="text" name="description" id="description" placeholder="Description" class="form-control" value="<?= $service['description'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="price">Price</label>
                                                                <input type="number" name="price" id="price" placeholder="Price" class="form-control" value="<?= $service['price'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                                <button class="btn btn-success btn-block" name="submit_btn">Save</button>
                                                        </div>
                                                </form>
                                                <?php endforeach; ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</section>
<?php end_html() ?>