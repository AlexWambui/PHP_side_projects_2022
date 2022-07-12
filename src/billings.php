<?php
include_once "include/_include_authenticated_essentials.php";
include_once "include/_billings.php";
include_once "include/_services.php";
if(isset($_POST['billing_paid'])) billing_paid();
if(isset($_POST['billing_pending'])) billing_pending();
start_html("Billings");
include_once "include/sidenav.php"
?>
<section class="container main_content billings">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col mt-3">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <?php if ($_SESSION['user_level'] == 1): ?>
                                <div class="col">
                                    <h6>Billings(s)</h6>
                                </div>
                                <div class="col text-right">
                                    <h6>Amount: <?= calculate_total(fetch_user_billings()) ?></h6>
                                </div>
                            <?php endif; ?>
                            <?php if ($_SESSION['user_level'] != 1): ?>
                                <div class="col">
                                    <h6><?= mysqli_num_rows(fetch_approved_bookings()) ?> Billings(s)</h6>
                                </div>
                                <div class="col text-right">
                                    <h6>Amount: <?= calculate_total(fetch_billings()) ?></h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <?php if ($_SESSION['user_level'] == 1): ?>
                                    <th>Service</th>
                                    <th>Date Requested</th>
                                    <th>Units / Rooms</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                <?php endif; ?>

                                <?php if ($_SESSION['user_level'] != 1): ?>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Address</th>
                                    <th>Units</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if ($_SESSION['user_level'] == 1){
                            foreach (fetch_user_billings() as $booking){
                            ?>
                            <tr>
                                <td><?= $booking['service_name'] ?></td>
                                <td class="<?php if ($booking['date_of_request'] < date('Y-m-d')) echo "text-danger" ?>"><?= $booking['date_of_request'] ?><?php if ($booking['date_of_request'] < date('Y-m-d')) echo "(passed)"; elseif ($booking['date_of_request'] == date('Y-m-d')) echo "(Today)" ?></td>
                                <td><?= $booking['units_or_rooms'] ?></td>
                                <td><?= $booking['price'] ?></td>
                                <td><?= $booking['price'] * $booking['units_or_rooms'] ?></td>
                                <td class="<?php if($booking['payment_status'] == 0) echo "text-danger"; else echo "text-success" ?>">
                                    <?php 
                                    $payment_status = $booking['payment_status'];
                                    interpret_payment_status($payment_status); 
                                    ?>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col d-flex justify-content-center">
                                            <form action="print_billing.php" method="post" class="form-inline">
                                                <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                <button class="btn btn-sm" type="submit" name="print_billing"
                                                        title="Print this Billing"><span
                                                            class="text-info table-icons icon-print"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <?php
                                }
                                }
                                if ($_SESSION['user_level'] != 1){
                                foreach (fetch_approved_bookings() as $booking){
                                ?>
                            <tr>
                                <td><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></td>
                                <td class="<?php if ($booking['date_of_request'] < date('Y-m-d')) echo "text-danger" ?>"><?= $booking['date_of_request'] ?><?php if ($booking['date_of_request'] < date('Y-m-d')) echo "(passed)"; elseif ($booking['date_of_request'] == date('Y-m-d')) echo "(Today)" ?></td>
                                <td><?= $booking['service_name'] ?></td>
                                <td><?= $booking['venue_address'] ?></td>
                                <td><?= $booking['units_or_rooms'] ?></td>
                                <td><?= $booking['price'] ?></td>
                                <td><?= $booking['price'] * $booking['units_or_rooms'] ?></td>
                                <td class="<?php if($booking['payment_status'] == 0) echo "text-danger"; else echo "text-success" ?>">
                                    <?php
                                    $payment_status = $booking['payment_status'];
                                    interpret_payment_status($payment_status);
                                    ?>
                                </td>
                                <td>
                                    <div class="table_actions">
                                        <div class="action">
                                            <form action="billings.php" method="post" class="form-inline">
                                                <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                <button class="btn btn-sm btn-warning" type="submit"
                                                        name="billing_pending"><span
                                                            class="text-dark table-icons">Pending</span></button>
                                            </form>
                                        </div>
                                        <div class="action">
                                            <form action="billings.php" method="post" class="form-inline">
                                                <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                <button class="btn btn-sm btn-success" type="submit"
                                                        name="billing_paid"><span
                                                            class="text-light table-icons">Paid</span></button>
                                            </form>
                                        </div>
                                        <div class="action">
                                            <form action="print_billing.php" method="post" class="form-inline">
                                                <input type="hidden" name="update_id" value="<?= $booking['id']; ?>">
                                                <button class="btn btn-sm" type="submit" name="print_billing"
                                                        title="Print this Billing"><span
                                                            class="text-info table-icons icon-print"></span>
                                                </button>
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
                            $(document).ready(function () {
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
