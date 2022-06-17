<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_services.php";
if(isset($_POST['add_service'])) add_service();
if(isset($_POST['delete_service'])) delete_service();
start_html("Services");
include_once "include/sidenav.php" 
?>
<section class="container main_content services">
        <div class="container navbar">
                <div class="navbar_links">
                        <?php if($_SESSION['user_level'] != 1): ?>
                <p><?= count_all_rows("services") ?> Service(s)</p>
                <?php else: ?>
                        <p>Book a service</p>
                        <?php endif;?>
                <div class="form_container">
                <div class="modal fade text-dark" id="modalAddService" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">New Service</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                        <form action="./services.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" name="service_name" id="service_name" placeholder="Service Name" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" id="description" placeholder="Description" class="form-control" required>
                                </div>
                                <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" placeholder="Price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                        <label for="service_image">Service Image</label>
                                        <input type="file" accept="image/*" class="form-control-file border" name="service_image" id="service_image" required>
                                </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-success btn-block" name="add_service">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php if($_SESSION['user_level'] != 1): ?>
            <a href="" class="btn btn-success btn-rounded" data-toggle="modal"
               data-target="#modalAddService"><span class="icon-plus"></span> New</a>
               <?php endif; ?>
                </div>
                </div>
        </div>
        <div class="container cards">
        <?php foreach (fetch_all("services") as $service): ?>
                <div class="card">
                        <div class="service_image">
                                <img src="<?= $service['service_image'] ?>" alt="image">
                        </div>
                        <div class="service_body">
                                <p class="name"><?= $service['service_name'] ?></p>
                                <p class="description"><?= $service['description'] ?></p>
                                <p class="price">Price: <?= $service['price'] ?> /=</p>
                        </div>
                        <div class="service_footer">
                                <?php if($_SESSION['user_level'] != 3): ?>
                                        <form action="book_service.php" method="post">
                                                <input type="hidden" name="update_id" id="service_id" value="<?= $service['id'] ?>">
                                                <button class="action_button">Book</button>
                                        </form>
                                <?php endif; ?>
                                <form action="update_service.php" method="post">
                                        <input type="hidden" name="update_id" value="<?= $service['id'] ?>">
                                        <button class="btn" type="submit" name="update"><span class="text-success table-icons icon-pencil"></span></button>                                                                                                         
                                </form>
                                <form action="./services.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?= $service['id'] ?>">
                                        <button class="btn" type="submit" name="delete_service"><span class="text-danger table-icons icon-trash"></span></button>                                                                                                         
                                </form>
                        </div>
                </div>
                <?php endforeach; ?>       
        </div>
</section>
<?php
data_table();
end_html();
?>
