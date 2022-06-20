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
                                <?php if(isset($_SESSION['user_level']) == 1): ?>
                                <div class="card">
                                        <div class="card-header">
                                                <div class="row">
                                                <div class="col">
                                                        <h6>Booking(s)</h6>
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
                                                        <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach(fetch_user_bookings() as $booking): ?>
                                                        <tr>
                                                        <td><?= $booking['service_name'] ?></td>
                                                        <td><?= $booking['date_of_request'] ?></td>
                                                        <td><?= $booking['venue_address'] ?></td>
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

                                <?php if(isset($_SESSION['user_level']) != 1): ?>
                                        <div class="card">
                                        <div class="card-header">
                                                <div class="row">
                                                <div class="col">
                                                        <h6><?= count_all_rows("bookings") ?>Booking(s)</h6>
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
                                                        <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach(fetch_all("bookings") as $booking): ?>
                                                        <tr>
                                                        <td><?= $booking['service_name'] ?></td>
                                                        <td><?= $booking['date_of_request'] ?></td>
                                                        <td><?= $booking['venue_address'] ?></td>
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
                        </div>
                </div>
    </div>
</section>
<?php
data_table();
end_html();
?>
