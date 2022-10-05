<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_billings.php";
include_once "include/_services.php";
start_html("Print Booking") ;
?>
<section onclick=window.print() class="bookings_print_out" id="bookings_print_out">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="mt-2 print_booking">
                                <?php foreach(fetch_this_booking() as $booking): ?>
                                <div class="print_head">
                                        <h1>Golden Decorations Billing</h1>
                                        <div class="print_head_details">
                                                <p>Receipt ID: <span>GD<?= rand(100, 10000) ?></span></p>
                                                <p>Date: <span><?= date('d-m-Y') ?></span></p>
                                        </div>
                                </div>
                                <div class="print_body">
                                        <div class="body">
                                                <p>Client's Name: <span><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></span></p>
                                                <p>Email Address: <span><?= $booking['email_address'] ?></span></p>
                                                <p>Phone Numer: <span><?= $booking['phone_number'] ?></span></p>
                                                <p>Service Requested: <span><?= $booking['service_name'] ?></span></p>
                                                <p>Date of Request: <span><?= $booking['date_of_request'] ?></span></p>
                                        </div>
                                        <div class="body">
                                                <p>Venue: <span><?= $booking['venue_address'] ?></span></p>
                                                <p>Units / Rooms: <span><?= $booking['units_or_rooms'] ?></span></p>
                                                <p>Price: <span><?= $booking['price'] ?></span></p>
                                                <p>Total Cost: <span><?= $booking['price'] * $booking['units_or_rooms'] ?></span></p>
                                                <p class="payment_status <?php if($booking['payment_status'] == 0) echo "not_paid"; elseif($booking['payment_status'] == 1) echo "paid"; ?>">
                                                <?php
                                                        $payment_status = $booking['payment_status'];
                                                        interpret_payment_status($payment_status);
                                                ?>
                                                </p>
                                        </div>
                                </div>
                                <div class="print_footer">
                                        <p>Served by: <span>Golden Decorations Admin.</span></p>
                                        <p class="text-info">Thank you for choosing Golden Decorations.</p>
                                </div>
                                <?php endforeach; ?>
                        </div>
                </div>
        </div>
</section>
<?php end_html() ?>