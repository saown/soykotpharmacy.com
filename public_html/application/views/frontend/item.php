<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Items</title>
    <?php foreach ($styleFileLink as $styleLink):?>
        <link rel="stylesheet" href="<?= $styleLink?>?t=<?= time()?>">
    <?php endforeach;?>

</head>
<body>
<?php $this->load->view('frontend/hfSection/header');?>

<main>
    <div class="cart-list-with-summery container mt-5 mb-5 min-vh-100">
    <p class="text-center h2 mb-3">YOUR CARTS</p>
    <div class="row">
        <div class="cart-list col-md-8">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Details</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php if (count($this->cart->contents()) > 0) :?>
                        <tbody>
                        <?php foreach ($cartItems as $item):?>
                        <tr>
                            <td style="width: 50%">
                                <span class="cart-p-name"><?= $item['name']?></span>
                            </td>
                            <td style="width: 6%">
                                <input type="number" min="1" name="qty" data-id="<?= $item['rowid']?>" id="quantity" class="cartQty" value="<?= $item['qty']?>" autocomplete="off">
                            </td>
                            <td style="width: 25%"><?= $item['qtyType']." : ".$item['price']?> tk</td>
                            <td class="totalPrice" style="width: 20%"><?= $item['subtotal']?> tk</td>
                            <td style="width: 20%">
                                <button type="button" class="cart-p-delete-btn btn btn-danger d-flex justify-content-center align-items-center" data-id="<?= $item['rowid']?>">
                                    <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.69201 5.0769C3.81441 5.0769 3.93181 5.12553 4.01836 5.21209C4.10492 5.29864 4.15355 5.41604 4.15355 5.53844V11.0769C4.15355 11.1993 4.10492 11.3167 4.01836 11.4033C3.93181 11.4898 3.81441 11.5384 3.69201 11.5384C3.5696 11.5384 3.45221 11.4898 3.36565 11.4033C3.2791 11.3167 3.23047 11.1993 3.23047 11.0769V5.53844C3.23047 5.41604 3.2791 5.29864 3.36565 5.21209C3.45221 5.12553 3.5696 5.0769 3.69201 5.0769ZM5.9997 5.0769C6.12211 5.0769 6.2395 5.12553 6.32606 5.21209C6.41261 5.29864 6.46124 5.41604 6.46124 5.53844V11.0769C6.46124 11.1993 6.41261 11.3167 6.32606 11.4033C6.2395 11.4898 6.12211 11.5384 5.9997 11.5384C5.87729 11.5384 5.7599 11.4898 5.67334 11.4033C5.58679 11.3167 5.53816 11.1993 5.53816 11.0769V5.53844C5.53816 5.41604 5.58679 5.29864 5.67334 5.21209C5.7599 5.12553 5.87729 5.0769 5.9997 5.0769ZM8.76893 5.53844C8.76893 5.41604 8.7203 5.29864 8.63375 5.21209C8.54719 5.12553 8.4298 5.0769 8.30739 5.0769C8.18498 5.0769 8.06759 5.12553 7.98103 5.21209C7.89448 5.29864 7.84585 5.41604 7.84585 5.53844V11.0769C7.84585 11.1993 7.89448 11.3167 7.98103 11.4033C8.06759 11.4898 8.18498 11.5384 8.30739 11.5384C8.4298 11.5384 8.54719 11.4898 8.63375 11.4033C8.7203 11.3167 8.76893 11.1993 8.76893 11.0769V5.53844Z" fill="white"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.76923C12 3.01405 11.9027 3.24883 11.7296 3.42194C11.5565 3.59505 11.3217 3.69231 11.0769 3.69231H10.6154V12C10.6154 12.4896 10.4209 12.9592 10.0747 13.3054C9.72844 13.6516 9.25886 13.8462 8.76923 13.8462H3.23077C2.74114 13.8462 2.27156 13.6516 1.92534 13.3054C1.57912 12.9592 1.38462 12.4896 1.38462 12V3.69231H0.923077C0.678262 3.69231 0.443473 3.59505 0.270363 3.42194C0.0972524 3.24883 0 3.01405 0 2.76923V1.84615C0 1.60134 0.0972524 1.36655 0.270363 1.19344C0.443473 1.02033 0.678262 0.923077 0.923077 0.923077H4.15385C4.15385 0.678262 4.2511 0.443473 4.42421 0.270363C4.59732 0.0972525 4.83211 0 5.07692 0L6.92308 0C7.16789 0 7.40268 0.0972525 7.57579 0.270363C7.7489 0.443473 7.84615 0.678262 7.84615 0.923077H11.0769C11.3217 0.923077 11.5565 1.02033 11.7296 1.19344C11.9027 1.36655 12 1.60134 12 1.84615V2.76923ZM2.41662 3.69231L2.30769 3.74677V12C2.30769 12.2448 2.40494 12.4796 2.57806 12.6527C2.75117 12.8258 2.98595 12.9231 3.23077 12.9231H8.76923C9.01405 12.9231 9.24883 12.8258 9.42194 12.6527C9.59505 12.4796 9.69231 12.2448 9.69231 12V3.74677L9.58338 3.69231H2.41662ZM0.923077 2.76923V1.84615H11.0769V2.76923H0.923077Z" fill="white"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                        <?php else:?>
                            <tbody class="tbody">
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-danger" role="alert">
                                        <span> Please add product to cart!</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        <?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <div class="cart-summery col-md-4">
            <div class="card">

                <div class="card-body">
                    <p class="card-title text-uppercase text-center h5">summery</p>
                    <hr>
                    <p class="card-text">Total Products : <span class="cart-count"><?php if ($this->session->has_userdata('cart_contents') && count($this->cart->contents()) != null){
                                echo count($this->cart->contents());
                            }else{
                                echo 0;
                            }?></span></p>
                    <p class="card-text">Total : <span class="subTotal"><?= $subTotal?></span> tk</p>
                    <p class="card-text">Discount (<span class="discount-percentage"><?= $discount?></span>%) : <span class="discount-price"><?= $discountPrice?></span> tk</p>
                    <p class="card-text">Delivery Fee : <span class="delivery_fee"><?= $delivery_fee?></span> tk</p>
                    <p class="card-text">Grand Total : <span class="grandTotal"><?= $grandTotal?></span> tk</p>

                    <div class="couponMessage"></div>
                    <button type="button" class="btn btn-success mt-3 check-out-btn">Check Out</button>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php $this->load->view('frontend/hfSection/footer')?>
<script>
    const SITE_URL = '<?= site_url()?>';
    let couponCode = "<?= ($this->session->has_userdata('couponCode'))? $this->session->userdata('couponCode'): ''?>"
    let csrf_token = "<?= $this->session->userdata('csrf_token')?>";
</script>
<?php foreach ($scriptFileLink as $scriptLink):?>
    <script src="<?= $scriptLink?>?t=<?= time()?>"></script>
<?php endforeach;?>

</body>
</html>