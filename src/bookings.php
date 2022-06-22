<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_services.php";
start_html("Bookings");
include_once "include/sidenav.php" 
?>
<section class="container main_content bookings">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col mt-3">
                                <?= alert() ?>
                                <?php if($_SESSION['user_level'] == 1): ?>
                                <div class="card">
                                        <div class="card-header">
                                                <div class="row">
                                                <div class="col">
                                                        <h6><?= count_user_bookings() ?> Booking(s)</h6>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="card-body">
                                                
                                                        <table class="table table-bordered table-hover" id="data_table">
                                                <thead>
                                                <tr>
                                                        <th>Service</th>
                                                        <th>Date of Request</th>
                                                        <th>Venue Address</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach(fetch_user_bookings() as $booking): ?>
                                                        <tr>
                                                        <td><?= $booking['service_name'] ?></td>
                                                        <td><?= $booking['date_of_request'] ?></td>
                                                        <td><?= $booking['venue_address'] ?></td>
                                                        <td class="<?php if($approval_status == 0) echo "text-warning"; else if($approval_status == 1) echo "text-success"; else echo "text-danger";?>">
                                                                <?php
                                                                        $approval_status = $booking['approval_status'];
                                                                        interpret_approval_status($approval_status);
                                                                ?>
                                                        </td>
                                                        <td>
                                                                <div class="row">
                                                                <div class="col d-flex justify-content-center">
                                                                        <form action="update_booking.php" method="post" class="form-inline">
                                                                        <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                                        <button class="btn btn-sm" type="submit" name="edit_booking"><span class="text-success table-icons icon-pencil"></span> Update</button>
                                                                        </form>
                                                                </div>
                                                                |
                                                                <div class="col d-flex justify-content-center">
                                                                        <form action="./bookings.php" method="post" class="form-inline">
                                                                        <input type="hidden" name="delete_booking_id" id="delete_booking_id" value="<?= $booking['id'] ?>">
                                                                        <button type="submit" name="delete_user" class="btn btn-sm"><span class="text-danger table_icons icon-trash"></span> Delete</button>
                                                                        </form>
                                                                </div>
                                                                </div>
                                                        </td>
                                                        </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                </table>
                                        </div>
                                </div>
                                <?php endif; ?>

                                <?php if($_SESSION['user_level'] != 1): ?>
                                        <div class="card">
                                        <div class="card-header">
                                                <div class="row">
                                                <div class="col">
                                                        <h5><?= count_all_rows("bookings") ?> Booking(s)</h5>
                                                </div>
                                                <div class="col">
                                                        <h6 class="text-warning"><?= count_pending_bookings() ?> Pending</h6>
                                                </div>
                                                <div class="col">
                                                        <h6 class="text-success"><?= count_approved_bookings() ?> Approved</h6>
                                                </div>
                                                <div class="col">
                                                        <h6 class="text-danger"><?= count_cancelled_bookings() ?> Cancelled</h6>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="card-body">
                                                
                                                        <table class="table table-bordered table-hover" id="data_table">
                                                <thead>
                                                <tr>
                                                        <th>Client's Name</th>
                                                        <th>Tel.</th>
                                                        <th>Service</th>
                                                        <th>Units / Rooms</th>
                                                        <th>Date Requested</th>
                                                        <th>Address</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach(fetch_all_bookings() as $booking): ?>
                                                        <tr>
                                                        <td><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></td>
                                                        <td><?= $booking['phone_number'] ?></td>
                                                        <td><?= $booking['service_name'] ?></td>
                                                        <td><?= $booking['units_or_rooms'] ?></td>
                                                        <td><?= $booking['date_of_request'] ?></td>
                                                        <td><?= $booking['venue_address'] ?></td>
                                                        <td class="<?php if($approval_status == 0) echo "text-warning"; else if($approval_status == 1) echo "text-success"; else echo "text-danger";?>">
                                                                <?php
                                                                 $approval_status = $booking['approval_status'];
                                                                 interpret_approval_status($approval_status);
                                                                ?>
                                                        </td>
                                                        <td>
                                                                <div class="action_buttons">
                                                                <div class="">
                                                                        <form action="update_booking.php" method="post" class="form-inline">
                                                                        <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                                        <button class="btn btn-sm" type="submit" name="edit_booking"><span class="text-success table-icons icon-pencil"></span></button>
                                                                        </form>
                                                                </div>
                                                                |
                                                                <div class="">
                                                                        <form action="./bookings.php" method="post" class="form-inline">
                                                                        <input type="hidden" name="delete_booking_id" id="delete_booking_id" value="<?= $booking['id'] ?>">
                                                                        <button type="submit" name="delete_user" class="btn btn-sm"><span class="text-danger table_icons icon-trash"></span></button>
                                                                        </form>
                                                                </div>
                                                                </div>
                                                        </td>
                                                        </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                </table>
                                        </div>
                                </div>
                                <?php endif; ?>
                        </div>
                </div>
    </div>
</section>
<?php
data_table();
end_html();
?>
