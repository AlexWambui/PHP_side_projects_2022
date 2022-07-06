<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_services.php";
if(isset($_POST['update_booking'])) update_booking();
start_html("Update Booking") ;
include_once "include/sidenav.php";
?>
<section class="main_content">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col-8 mt-5">
                                <div class="card">
                                        <h5 class="card-header text-center">Booking Details</h5>
                                        <div class="card-body">
                                                <?= alert() ?>
                                                <?php foreach(fetch_this_booking() as $booking): ?>
                                                <form action="./update_booking.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                                <input type="hidden" name="update_booking_id" value="<?= $booking['booking_id'] ?>">
                                                <?php if($_SESSION['user_level'] != 1 ): ?>
                                                <p>Client's Name: <span><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></span></p>
                                                <p>Email Address: <span><?= $booking['email_address'] ?></span></p>
                                                <p>Phone Numer: <span><?= $booking['phone_number'] ?></span></p>
                                                <hr/>
                                                <?php endif; ?>
                                                <div class="row">
                                                                <div class="col">
                                                                        <div class="form-group">
                                                                                <label for="date_of_request">Date of Request</label>
                                                                                <input type="date" name="date_of_request" id="date_of_request" min="<?= date('Y-m-d') ?>" placeholder="Date of Request" class="form-control" value="<?= $booking['date_of_request'] ?>" readonly>
                                                                        </div>
                                                                </div>
                                                                <div class="col">
                                                                        <div class="form-group">
                                                                                <label for="venue_address">Venue Address</label>
                                                                                <input type="text" name="venue_address" id="venue_address" placeholder="Venue address (eg) Ruii, Kiambu" class="form-control" value="<?= $booking['venue_address'] ?>" readonly>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="units_or_rooms">Units / Rooms</label>
                                                                <input type="number" name="units_or_rooms" id="units_or_rooms" placeholder="Units or Rooms" class="form-control" value="<?= $booking['units_or_rooms'] ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="comment">Comment</label>
                                                                <input type="text" name="comment" id="comment" placeholder="Comments appear here" class="form-control" value="<?= $booking['comment'] ?>" readonly>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col">
                                                                        <div class="form-group text-center">
                                                                                <a href="./bookings.php"><button type="button" class="btn btn-success btn-block">Back</button></a>
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
</section>
<?php end_html() ?>