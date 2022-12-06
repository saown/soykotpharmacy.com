<?php $this->load->view('backend/inc/head') ?>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php $this->load->view('backend/inc/sidebar') ?>
        <div class="layout-page">
            <?php $this->load->view('backend/inc/header') ?>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Order List</h4>
                    <div class="w-px-150 mb-5">
                        <label for="order-date" class="form-label">Date</label>
                        <input class="form-control" type="date" value="<?= date('Y-m-d')?>" id="order-date">
                    </div>
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Details</th>
                                    <th>Order Date</th>
                                    <th>Total Product</th>
                                    <th>Total price</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <?php foreach ($orderList as $order): ?>
                                    <tr>
                                        <td class="w-px-300">
                                            <div>
                                                <p class="card-text m-0"><strong>To,</strong></p>
                                                <p class="card-text m-0">Name : <?= $order->personal_name?> </p>
                                                <p class="card-text m-0">Phone : <?= $order->personal_phone?></p>
                                                <p class="card-text m-0 w-px-300 text-truncate" title="<?= $order->personal_address?>">Address : <?= $order->personal_address?></p>
                                                <p class="card-text m-0"><strong>From,</strong></p>
                                                <p class="card-text m-0">Name : <?= $order->shippingName?></p>
                                                <p class="card-text m-0">Phone : <?= $order->shippingPhoneNum?></p>
                                                <p class="card-text m-0 w-px-300 text-truncate" title="<?= $order->shippingAddress?>">Address : <?= $order->shippingAddress?></p>
                                            </div>
                                        </td>
                                        <td><?= $order->orderDate?></td>
                                        <td class="text-center"><?= $order->itemNum?></td>
                                        <td class="text-center"><?= $order->total_price?></td>
                                        <td class="w-px-100">
                                            <div class="d-flex flex-column gap-2">
                                                <button type="button" class="btn btn-icon btn-outline-danger btn-sm order-delete-btn" data-id="<?= $order->id?>"><span class="tf-icons bx bx-trash"></span></button>
                                                <select id="status" name="status" class="form-select form-select-sm w-auto" data-id="<?= $order->id?>">
                                                    <option <?= ((int)$order->status === 0)? 'selected' :''?> value="0">Canceled</option>
                                                    <option <?= ((int)$order->status === 1)? 'selected' :''?> value="1">On Hold</option>
                                                    <option <?= ((int)$order->status === 2)? 'selected' :''?> value="2">Processing</option>
                                                    <option <?= ((int)$order->status === 3)? 'selected' :''?> value="3">Complete</option>
                                                </select>
                                                <button type="button" class="btn btn-primary btn-sm view-invoice" data-id="<?= $order->id?>">View Invoice</button>
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
    </div>
</div>
<?php $this->load->view('backend/inc/footer') ?>
