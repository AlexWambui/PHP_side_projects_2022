<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_services.php";
if(isset($_POST['delete_booking'])) delete_booking();
start_html("Bookings");
include_once "include/sidenav.php" 
?>
<section class="container main_content bookings">
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col mt-3">
                                <?= alert() ?>
                                <div class="card">
                                        <div class="card-header">
                                                <div class="row">
                                                        <?php if($_SESSION['user_level'] == 1): ?>
                                                        <div class="col">
                                                                <h6><?= count_user_bookings() ?> Booking(s)</h6>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if($_SESSION['user_level'] != 1): ?>
                                                        <div class="col">
                                                                <h6><?= count_all_rows("bookings") ?> Booking(s)</h6>
                                                        </div>
                                                        <div class="col">
                                                                <h6 class="text-warning"><?= count_pending_bookings() ?> Pending</h6>
                                                        </div>
                                                        <div class="col">
                                                                <h6 class="text-success"><?= count_approved_bookings() ?> Approved</h6>
                                                        </div>
                                                        <div class="col">
                                                                <h6 class="text-danger"><?= count_cancelled_bookings() ?> Rejected</h6>
                                                        </div>
                                                        <?php endif; ?>
                                                </div>
                                        </div>
                                        <div class="card-body">
                                                <table class="table table-bordered" id="data_table">
                                                        <thead>
                                                                <tr>     
                                                                        <?php if($_SESSION['user_level'] == 1): ?>
                                                                        <th>Service</th>                                                           
                                                                        <th>Date Requested</th>
                                                                        <th>Address</th>
                                                                        <th>Units / Rooms</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                        <?php endif;?>

                                                                        <?php if($_SESSION['user_level'] != 1): ?>
                                                                        <th>Client</th>
                                                                        <th>Date Requested</th>
                                                                        <th>Service</th>                                                           
                                                                        <th>Address</th>
                                                                        <th>Units / Rooms</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                        <?php endif;?>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                        
                                                                        <?php
                                                        if($_SESSION['user_level'] == 1){
                                                                foreach(fetch_user_bookings() as $booking){
                                                                        ?>
                                                                        <tr>
                                                                        <td><?= $booking['service_name'] ?></td>
                                                                        <td class="<?php if($booking['date_of_request'] < date('Y-m-d')) echo "text-danger" ?>"><?= $booking['date_of_request'] ?> <?php if($booking['date_of_request'] < date('Y-m-d')) echo "(passed)"; elseif($booking['date_of_request'] == date('Y-m-d')) echo "(Today)" ?></td>
                                                                        <td><?= $booking['venue_address'] ?></td>
                                                                        <td><?= $booking['units_or_rooms'] ?></td>
                                                                        <td class="<?php $approval_status = $booking['approval_status']; approval_status_class($approval_status); ?>">
                                                                                <?php
                                                                                        $approval_status = $booking['approval_status'];
                                                                                        interpret_approval_status($approval_status);
                                                                                ?>
                                                                        </td>
                                                                        <td>
                                                                                <div class="row">
                                                                                <div class="col d-flex justify-content-center">
                                                                                        <form action="booking_details.php" method="post" class="form-inline">
                                                                                        <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                                                        <button class="btn btn-sm" type="submit" name="edit_booking" title="Details about this booking"><span class="text-info table-icons icon-info"></span></button>
                                                                                        </form>
                                                                                </div>
                                                                                |
                                                                                <div class="col d-flex justify-content-center">
                                                                                        <form action="update_booking.php" method="post" class="form-inline">
                                                                                        <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                                                        <button class="btn btn-sm" type="submit" name="edit_booking" title="update booking"><span class="text-success table-icons icon-pencil"></span></button>
                                                                                        </form>
                                                                                </div>
                                                                                |
                                                                                <div class="col d-flex justify-content-center">
                                                                                        <form action="./bookings.php" method="post" class="form-inline">
                                                                                        <input type="hidden" name="delete_id" id="delete_id" value="<?= $booking['id'] ?>">
                                                                                        <button type="submit" name="delete_booking" class="btn btn-sm" title="delete booking"><span class="text-danger table_icons icon-trash"></span></button>
                                                                                        </form>
                                                                                </div>
                                                                                </div>
                                                                        </td>
                                                                        <?php
                                                                        
                                                                }
                                                        }
                                                        if($_SESSION['user_level'] != 1){
                                                                foreach(fetch_all_bookings() as $booking){
                                                                        ?>
                                                                        <tr>
                                                                        <td><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></td>
                                                                        <td class="<?php if($booking['date_of_request'] < date('Y-m-d')) echo "text-danger" ?>"><?= $booking['date_of_request'] ?> <?php if($booking['date_of_request'] < date('Y-m-d')) echo "(passed)"; elseif($booking['date_of_request'] == date('Y-m-d')) echo "(Today)" ?></td>
                                                                        <td><?= $booking['service_name'] ?></td>
                                                                        <td><?= $booking['venue_address'] ?></td>
                                                                        <td><?= $booking['units_or_rooms'] ?></td>
                                                                        <td class="<?php $approval_status = $booking['approval_status']; approval_status_class($approval_status); ?>">
                                                                                <?php
                                                                                        $approval_status = $booking['approval_status'];
                                                                                        interpret_approval_status($approval_status);
                                                                                ?>
                                                                        </td>
                                                                        <td>
                                                                                <div class="row">
                                                                                <div class="col d-flex justify-content-center">
                                                                                        <form action="booking_details.php" method="post" class="form-inline">
                                                                                        <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                                                        <button class="btn btn-sm" type="submit" name="edit_booking" title="Details about this booking"><span class="text-info table-icons icon-info"></span></button>
                                                                                        </form>
                                                                                </div>
                                                                                |
                                                                                <div class="col d-flex justify-content-center">
                                                                                        <form action="update_booking.php" method="post" class="form-inline">
                                                                                        <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                                                        <button class="btn btn-sm" type="submit" name="edit_booking" title="update booking"><span class="text-success table-icons icon-pencil"></span></button>
                                                                                        </form>
                                                                                </div>
                                                                                |
                                                                                <div class="col d-flex justify-content-center">
                                                                                        <form action="./bookings.php" method="post" class="form-inline">
                                                                                        <input type="hidden" name="delete_id" id="delete_id" value="<?= $booking['id'] ?>">
                                                                                        <button type="submit" name="delete_booking" class="btn btn-sm" title="delete booking"><span class="text-danger table_icons icon-trash"></span></button>
                                                                                        </form>
                                                                                </div>
                                                                                </div>
                                                                        </td>
                                                                        <?php
                                                                }
                                                        }
                                                        ?>
                                                                        
                                                                </tr>                                                                
                                                        </tbody>
                                                </table>
                                                <script>
                                                        $(document).ready(function (){
                                                                $('#data_table').DataTable({
                                                                        order: [[1, 'desc']],
                                                                });
                                                        });
                                                </script>
                                        </div>
                                </div>
                        </div>
                </div>
    </div>
</section>
<?php
data_table();
end_html();
?>
