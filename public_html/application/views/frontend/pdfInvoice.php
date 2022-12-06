<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?= site_url('assets/bootstrap/css/bootstrap.min.css')?>?t=<?= time()?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }
        tr,th,td{
            border: 1px solid black;
        }
        th,td{
            line-height: 20px;
            padding: 5px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div style="height: 100px; overflow: auto">
            <div class="logo float-start text-center">
                <img src="<?= site_url('assets/front-end/assets/logo/logo.jpg')?>" alt="" width="130"><br>
                <?php if ((int)$orderInfo->status === 3){?>
                    <div class="badge bg-success text-uppercase mt-2 w-100">Paid</div>
                <?php }else{?>
                    <div class="badge bg-danger text-uppercase mt-2 w-100">Unpaid</div>
                <?php }?>
            </div>
            <div class="float-end text-end" style="line-height: 20px">
                <p style="margin-bottom: 0; font-size: 24px; font-weight: 700">Invoice</p>
                <p style="margin: 0; font-size: 16px"><?= $orderInfo->orderDate?></p>
            </div>
        </div>

        <div style="height: 200px; overflow: auto">
            <div class="float-start" style="line-height: 15px; width: 300px; word-break: break-word">
                <p style="margin: 0;font-size: 18px; font-weight: 700; text-transform: uppercase;">Shipping</p>
                <p style="margin: 10px 0 0; font-size: 14px">Name: <?= $orderInfo->shippingName?></p>
                <p style="margin: 0;font-size: 14px">Phone: (+88) <?= $orderInfo->shippingPhoneNum?></p>
                <p style="margin: 0;font-size: 14px">Email: <?= $orderInfo->shippingEmail?></p>
                <p style="margin: 0;font-size: 14px; text-transform: capitalize;">Address: <?= $orderInfo->shippingAddress?></p>
            </div>
            <div class="float-end" style="line-height: 15px; width: 300px; word-break: break-word;">
                <p style="margin: 0;font-size: 18px; font-weight: 700; text-transform: uppercase;">Billing</p>
                <p style="margin: 10px 0 0; font-size: 14px">Name: <?= $orderInfo->personal_name?></p>
                <p style="margin: 0;font-size: 14px">Phone: (+88) <?= $orderInfo->personal_phone?></p>
                <p style="margin: 0;font-size: 14px">Email: <?= $orderInfo->personal_email?></p>
                <p style="margin: 0;font-size: 14px; text-transform: capitalize;">Address: <?= $orderInfo->personal_address?></p>
            </div>
        </div>

        <table style="width: 100%">
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($productList as $product):?>
                <tr>
                    <td><?= $product->brand_generic_name." ". $product->brand_type." ".$product->brand_weight;?></td>
                    <td><?= $product->single_price;?> tk</td>
                    <td><?= $product->quantity;?></td>
                    <td><?= ((int)$product->single_price * $product->quantity)?> tk</td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="float-end" style="width: 220px; height: auto; line-height: 20px; margin-top: 25px">
            <div class="text-end">Total : <?= number_format($orderInfo->total_price,2)?> tk</div>
            <div class="text-end">Discount (<?= $discountPersentence?>%) : <?= $discountPrice?> tk</div>
            <div class="text-end">Delivery Free : <?= $deliveryFree?> tk</div>
            <div class="text-end">Grand Total : <?= $grandTotal?> tk</div>
        </div>
    </div>
    <script src="<?= site_url('assets/jquery/jquery-3.6.0.js') ?>?t=<?= time()?>"></script>
    <script src="<?= site_url('assets/bootstrap/js/bootstrap.min.js') ?>?t=<?= time()?>"></script>
</body>
</html>