<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_services.php";
if(isset($_POST['book_service'])) book_service();
start_html("Book Service");
include_once "include/sidenav.php";
?>
<section class="container main_content book_service">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col-8 mt-4">
                                <div class="card">
                                        <h5 class="card-header text-center">Book Service</h5>
                                        <div class="card-body">
                                                <?php foreach(fetch_this_service() as $service): ?>
                                                <div class="booking_specifics">
                                                        <p>You have selected: <br/><span><?= $service['service_name'] ?></span> which entails: <span><?= $service['description'] ?></span> and you'll be charged: <span><?= $service['price'] ?></span></p>
                                                        <p>Fill in the details below to finish booking this service.</p>
                                                        <hr/>
                                                </div>
                                                <form action="./book_service.php" method="post">
                                                        <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                                                        <div class="row">
                                                                <div class="col">
                                                                        <div class="form-group">
                                                                                <label for="date_of_request">Date of Request</label>
                                                                                <input type="date" name="date_of_request" id="date_of_request" min="<?= date('Y-m-d') ?>" placeholder="Date of Request" class="form-control" required>
                                                                        </div>
                                                                </div>
                                                                <div class="col">
                                                                        <div class="form-group">
                                                                                <label for="venue_address">Venue Address</label>
                                                                                <input type="text" name="venue_address" id="venue_address" placeholder="Venue address (eg) Ruii, Kiambu" class="form-control" required>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="units_or_rooms">Units / Rooms</label>
                                                                <input type="number" name="units_or_rooms" id="units_or_rooms" placeholder="Units or Rooms" class="form-control">
                                                        </div>
                                                        <div class="form-group text-center w-50 m-auto">
                                                                <button class="btn btn-success btn-block action_button" name="book_service">Book</button>
                                                        </div>
                                                </form>
                                                <?php endforeach; ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</section>
<?php
end_html();
?>
