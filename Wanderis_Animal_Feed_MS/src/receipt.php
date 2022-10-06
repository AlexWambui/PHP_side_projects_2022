<?php
include_once "include/_html_templates.php";
include_once "include/_authenticate.php";
include_once "include/functions.php";
include_once "_sales.php";
ensure_user_logged_in();
start_html("Print Receipt") ;
?>
<section onclick=window.print() class="Print_receipt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-2 receipt">
                <?php foreach(fetch_sale() as $sale): ?>
                    <div class="print_head">
                        <h1 class="text-info">Wanderis Animal Feed MS</h1>
                        <div class="print_head_details">
                            <p>Receipt ID: <span>WAF<?= rand(100, 10000) ?></span></p>
                            <p>Date: <span><?= date('d-m-Y') ?></span></p>
                        </div>
                    </div>
                    <div class="print_body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Amount in Kgs.</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $sale['product_name'] ?></td>
                                    <td><?= $sale['amount_in_kgs'] ?></td>
                                    <td><?= $sale['price'] ?></td>
                                    <td><?= $sale['price'] * $sale['amount_in_kgs'] ?></td>                                    
                                </tr>
                                <tr>
                                    <td colspan=3 class="text-center total">Total</td>
                                    <td class="total"><?= $sale['price'] * $sale['amount_in_kgs'] ?></td>
                                </tr>
                            </tbody>
                        </table>                            
                    </div>
                    <div class="print_footer">
                        <p>Served by: <span><?= $_SESSION['user_first_name'] ?></span></p>
                        <p class="text-info">Thank you for choosing Wanderi's Animal Feed.</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php end_html() ?>