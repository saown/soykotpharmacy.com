<?php $this->load->view('backend/inc/head') ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php $this->load->view('backend/inc/sidebar')?>
            <div class="layout-page">
                <?php $this->load->view('backend/inc/header')?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Ordered Product List</h4>
                        <div class="w-px-150 mb-4">
                            <label for="order-date" class="form-label">Date</label>
                            <input class="form-control" type="date" value="<?= date('Y-m-d')?>" id="order-date">
                        </div>
                        <?php $totalPriceArray = []; foreach ($productList as $key){$totalPriceArray[] = $key->quantity * $key->single_price;} $totalPrice = array_sum($totalPriceArray);?>

                        <div class="text-end mb-4"> Total Price : <?= $totalPrice?> tk</div>
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Company Name</th>
                                        <th>Quantity Type</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    <?php foreach ($productList as $product){?>
                                        <tr>
                                            <td><?= $product->brand_name . " ". $product->brand_weight?></td>
                                            <td><?= $product->brand_company_name?></td>
                                            <td><?= $product->quantity_type?></td>
                                            <td><?= $product->quantity?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('backend/inc/footer') ?>