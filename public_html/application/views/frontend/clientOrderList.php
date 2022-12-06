<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
    <?php foreach ($styleFileLink as $link) { ?>
        <link rel="stylesheet" href="<?= $link ?>?t=<?= time() ?>">
    <?php } ?>
</head>
<body>
<?php $this->load->view('frontend/admin_header_and_footer/header'); ?>
<div class="container mt-5">
    <div class="text-center mb-5">
        <span class="h2">Your Order List</span>
    </div>
    <div class="order-list-table bg-white table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Details</th>
                <th>Order Date</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientOrderList as $clientOrder):?>
            <tr>
                <td>
                    <p class="m-0"><strong>Shipping Info</strong></p>
                    <p class="m-0">Name : <?= $clientOrder->shippingName ?></p>
                    <p class="m-0">Email : <?= $clientOrder->shippingEmail ?></p>
                    <p class="m-0">Phone Number : <?= $clientOrder->shippingPhoneNum ?></p>
                    <p class="m-0"><strong>Billing Info</strong></p>
                    <p class="m-0">Name : <?= $clientOrder->personal_name ?></p>
                    <p class="m-0">Email : <?= $clientOrder->personal_email ?></p>
                    <p class="m-0">Phone Number : <?= $clientOrder->personal_phone ?></p>
                </td>
                <td class="m-auto">
                    <?= $clientOrder->orderDate ?>
                </td>
                <td>
                    <span class="text-capitalize badge bg-secondary">
                        <?= $clientOrder->payment_method ?>
                    </span>
                </td>
                <td>
                    <?php
                        // 0 = cansel, 1 = on hold, 2 = processing, 3 = complete
                        if ((int)$clientOrder->status === 1){
                            echo '<span class="badge bg-warning text-dark text-capitalize">on hold</span>';
                        }elseif ((int)$clientOrder->status === 2){
                            echo '<span class="badge bg-primary text-capitalize">processing</span>';
                        }elseif ((int)$clientOrder->status === 3){
                            echo '<span class="badge bg-success text-capitalize">complete</span>';
                        }else{
                            echo '<span class="badge bg-danger text-capitalize">cancel</span>';
                        }
                    ?>
                </td>
                <td style="width: 100px;">
                    <button class="btn btn-danger cancel-order-btn btn-sm w-100 text-capitalize mb-1" data-id="<?= $clientOrder->id?>" <?= (int)$clientOrder->status === 0 ? 'disabled' : ''?>>cancel</button>
                    <br>
                    <?php if ((int)$clientOrder->status != 0){
                        echo "<a href=".site_url('invoice/').$clientOrder->id." class='btn btn-primary view-invoice btn-sm w-100 mt-1'>Invoice</a>";
                    }?>
                </td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('frontend/admin_header_and_footer/footer'); ?>
<script>
    let SITE_URL = "<?= site_url()?>";
</script>

<?php foreach ($scriptFileLink as $link) { ?>
    <script src="<?= $link ?>?t=<?= time() ?>"></script>
<?php } ?>
</body>
</html>
