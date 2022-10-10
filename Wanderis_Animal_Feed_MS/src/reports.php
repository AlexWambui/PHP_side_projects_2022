<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_sales.php";
ensure_user_logged_in();
if(isset($_POST['delete'])) delete_sale();
start_html("Reports"); 
include_once "include/sidenav.php";
?>
<main class="Reports Sales">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col mt-3">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col text-center">
                                <h6><?= count_all('sales') ?> Sale(s)</h6>
                            </div>
                            <div class="col text-center text-success">
                                <h6>Total: <?= total_sales() ?> /=</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="data_table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Amount in Kgs</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(fetch_sales() as $sale): ?>                                
                                <tr>
                                    <td><?= $sale['product_name'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                    <td><?= $sale['amount_in_kgs'] ?></td>
                                    <td><?= $sale['price'] * $sale['amount_in_kgs'] ?></td>
                                    <td><?php $method = $sale['payment_method']; interpret_payment_method($method); ?></td>
                                    <td>
                                        <div class="table_action_buttons">
                                            <div class="action_button">
                                                <form action="./update_sale.php" method="post">
                                                    <input type="hidden" name="update_id" value="<?= $sale['id'] ?>">
                                                    <button type="submit" name="update" class="btn btn-sm"><span class="icon icon-pencil text-success"></span></button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="./sales.php" method="post">
                                                    <input type="hidden" name="delete_id" value="<?= $sale['id'] ?>">
                                                    <button type="submit" name="delete" class="btn btn-sm" onclick="return confirm_delete()"><span class="icon-trash text-danger"></span></button>
                                                </form>
                                            </div>
                                            <div class="action_button">
                                                <form action="./receipt.php" method="post">
                                                    <input type="hidden" name="update_id" value="<?= $sale['id'] ?>">
                                                    <button type="submit" name="print" class="btn btn-sm"><span class="icon icon-print text-info"></span></button>
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
            </div>
        </div>
    </div>
</main>
<script src="../assets/js/confirm_delete.js"></script>
<?php
data_table();
end_html();
?>