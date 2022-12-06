<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- title -->
    <title>Place Order</title>

    <!-- css link -->
    <?php foreach ($styleFileLink as $link):?>
        <link rel="stylesheet" href="<?= $link?>?t=<?= time()?>">
    <?php endforeach;?>
</head>
<body>
<?php $this->load->view('frontend/hfSection/header');?>

<div class="modal fade" id="edit-shipping-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Shipping Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-name">Full Name</label>
                        <input class="form-control" type="text" name="name" id="edit-shipping-name" value="<?= $this->session->userdata('shippingInfo')['username']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-email">Email</label>
                        <input class="form-control" type="email" name="email" id="edit-shipping-email" value="<?= $this->session->userdata('shippingInfo')['email']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-phone-number">Phone Number</label>
                        <input class="form-control" type="number" name="phoneNumber" id="edit-shipping-phone-number" value="<?= $this->session->userdata('shippingInfo')['phone_number']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-address-1">Address 1</label>
                        <input class="form-control" type="text" name="address-1" id="edit-shipping-address-1" value="<?= $this->session->userdata('shippingInfo')['address_line_1']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-address-2">Address 2</label>
                        <input class="form-control" type="text" name="address-2" id="edit-shipping-address-2" value="<?= $this->session->userdata('shippingInfo')['address_line_2']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-district">District</label>
                        <select class="form-select" name="district" id="edit-shipping-district">
                            <option value="Dhaka">Dhaka</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="edit-shipping-city" class="form-label">City</label>
                        <select class="form-select" name="city" id="edit-shipping-city">
                            <option value="Dhaka">Dhaka</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-shipping-post-code">Post Code</label>
                        <input class="form-control" type="text" name="postCode" id="edit-shipping-post-code" value="<?= $this->session->userdata('shippingInfo')['post_code']?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success save-edit-shipping-info-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-billing-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Billing Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-name">Full Name</label>
                        <input class="form-control" type="text" name="name" id="edit-billing-name" placeholder="Your name" value="<?= $this->session->userdata('billingInfo')['username']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-email">Email </label>
                        <input class="form-control" type="email" name="email" id="edit-billing-email" value="<?= $this->session->userdata('billingInfo')['email']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-phone-number">Phone Number</label>
                        <input class="form-control" type="number" name="phoneNumber" id="edit-billing-phone-number" value="<?= $this->session->userdata('billingInfo')['phone_number']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-address-1">Address 1</label>
                        <input class="form-control" type="text" name="address-1" id="edit-billing-address-1" value="<?= $this->session->userdata('billingInfo')['address_line_1']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-address-2">Address 2</label>
                        <input class="form-control" type="text" name="address-2" id="edit-billing-address-2" value="<?= $this->session->userdata('billingInfo')['address_line_2']?>">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-district">District</label>
                        <select class="form-select" name="district" id="edit-billing-district">
                            <option value="Dhaka">Dhaka</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="edit-billing-city" class="form-label">City</label>
                        <select class="form-select" name="city" id="edit-billing-city">
                            <option value="Dhaka">Dhaka</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label class="form-label" for="edit-billing-post-code">Post Code</label>
                        <input class="form-control" type="text" name="postCode" id="edit-billing-post-code" value="<?= $this->session->userdata('billingInfo')['post_code']?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success save-edit-billing-info-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="cart-list-with-summery container mt-5 mb-5 min-vh-100">
        <p class="text-center h2 mb-3">Place Your Order</p>
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
                            </tr>
                            </thead>
                            <?php if (count($this->cart->contents()) > 0) :?>
                                <tbody>
                                <?php foreach ($cartItems as $item):?>
                                    <tr>
                                        <td style="width: 50%">
                                            <span class="cart-p-name"><?= $item['name']?></span>
                                        </td>
                                        <td style="width: 5%">
                                             <?= $item['qty']?>
                                        </td>
                                        <td style="width: 25%"><?= $item['qtyType']." : ".$item['price']?> tk</td>
                                        <td class="totalPrice" style="width: 20%"><?= $item['subtotal']?> tk</td>
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
                        <p class="card-title text-uppercase h5">Shipping & Billing</p>
                        <hr>
                        <div class="billing-and-shopping-address">
                            <p class="card-text">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                      <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                      <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    <span class="shipping-address">
                                        <?= "<strong>".$this->session->userdata('shippingInfo')['username']."</strong> : " . $this->session->userdata('shippingInfo')['address_line_1'] . ' ' . $this->session->userdata('shippingInfo')['address_line_2']?>
                                    </span>
                                </span>
                                <button class="edit-shipping-address-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                            </p>
                            <p class="card-text">
                                <span class=''>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                                    </svg>
                                    <span class="billing-address">
                                        Billing will be done from the shipping address.
                                    </span>
                                </span>
                            </p>
                        </div>
                        <p class="card-title text-uppercase h5 mt-3">Order Summary</p>
                        <hr>
                        <p class="card-text">Total : <span class="subTotal"><?= $subTotal?></span> tk</p>
                        <p class="card-text">Discount (<span class="discount-percentage"><?= $discount?></span>%) : <span class="discount-price"><?= $discountPrice?></span> tk</p>
                        <p class="card-text">Delivery Fee : <span class="delivery_fee"><?= $delivery_fee?></span> tk</p>
                        <p class="card-text">Grand Total : <span class="grandTotal"><?= $grandTotal?></span> tk</p>
                        <div class="couponMessage"></div>
                        <button type="button" class="btn btn-success mt-3 place-order-btn w-100 submitOrder">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('frontend/hfSection/footer');?>
<script>
    let SITE_URL = "<?= site_url()?>"
</script>
<?php foreach ($scriptFileLink as $script) :?>
    <script src="<?= $script?>?t=<?= time()?>"></script>
<?php endforeach;?>
</body>
</html>

