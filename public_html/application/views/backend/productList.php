<?php $this->load->view('backend/inc/head') ?>
<!-- Add New Product Modal -->
<div class="modal fade" id="add-new-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="post" action="<?= site_url('addNewProduct')?>">
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_type" class="form-label">Product Type</label>
                        <input type="text" class="form-control" name="brand_type" id="brand_type" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_weight" class="form-label">Product Power</label>
                        <input type="text" class="form-control" name="brand_weight" id="brand_weight" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_generic_name" class="form-label">Generic Name</label>
                        <input type="text" class="form-control" name="brand_generic_name" id="brand_generic_name" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="brand_company_name" id="brand_company_name" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price_type0" class="form-label">Price Type</label>
                            <input type="text" class="form-control" name="price_type0" id="price_type0" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price0" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price0" id="price0" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type1" class="form-label">Price Type 1</label>
                            <input type="text" class="form-control" name="price_type1" id="price_type1" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price1" class="form-label">Price 1</label>
                            <input type="text" class="form-control" name="price1" id="price1" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type2" class="form-label">Price Type 2</label>
                            <input type="text" class="form-control" name="price_type2" id="price_type2" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price2" class="form-label">Price 2</label>
                            <input type="text" class="form-control" name="price2" id="price2" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type3" class="form-label">Price Type 3</label>
                            <input type="text" class="form-control" name="price_type3" id="price_type3" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price3" class="form-label">Price 3</label>
                            <input type="text" class="form-control" name="price3" id="price3" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type4" class="form-label">Price Type 4</label>
                            <input type="text" class="form-control" name="price_type4" id="price_type4" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price4" class="form-label">Price 4</label>
                            <input type="text" class="form-control" name="price4" id="price4" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type5" class="form-label">Price Type 5</label>
                            <input type="text" class="form-control" name="price_type5" id="price_type5" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price5" class="form-label">Price 5</label>
                            <input type="text" class="form-control" name="price5" id="price5" placeholder="Enter Your Product Name.">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save-new-product">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="edit-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="position:relative;">
            <div style="

                        width: 100%;
                        min-height: 100vh;
                        position: absolute;
                        display: flex;
                        z-index: 1;
                        background: #3a3a3a30;
                        justify-content: center;
                        align-items: center;
            " class="loading d-none">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= site_url('editProduct')?>" id="edit-product-form">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="brand_name" id="edit_brand_name" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_type" class="form-label">Product Type</label>
                        <input type="text" class="form-control" name="brand_type" id="edit_brand_type" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_weight" class="form-label">Product Power</label>
                        <input type="text" class="form-control" name="brand_weight" id="edit_brand_weight" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_generic_name" class="form-label">Generic Name</label>
                        <input type="text" class="form-control" name="brand_generic_name" id="edit_brand_generic_name" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="mb-3">
                        <label for="brand_company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="brand_company_name" id="edit_brand_company_name" placeholder="Enter Your Product Name.">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price_type0" class="form-label">Price Type</label>
                            <input type="text" class="form-control" name="price_type0" id="edit_price_type0" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price0" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price0" id="edit_price0" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type1" class="form-label">Price Type 1</label>
                            <input type="text" class="form-control" name="price_type1" id="edit_price_type1" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price1" class="form-label">Price 1</label>
                            <input type="number" class="form-control" name="price1" id="edit_price1" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type2" class="form-label">Price Type 2</label>
                            <input type="text" class="form-control" name="price_type2" id="edit_price_type2" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price2" class="form-label">Price 2</label>
                            <input type="number" class="form-control" name="price2" id="edit_price2" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type3" class="form-label">Price Type 3</label>
                            <input type="text" class="form-control" name="price_type3" id="edit_price_type3" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price3" class="form-label">Price 3</label>
                            <input type="number" class="form-control" name="price3" id="edit_price3" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type4" class="form-label">Price Type 4</label>
                            <input type="text" class="form-control" name="price_type4" id="edit_price_type4" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price4" class="form-label">Price 4</label>
                            <input type="number" class="form-control" name="price4" id="edit_price4" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_type5" class="form-label">Price Type 5</label>
                            <input type="text" class="form-control" name="price_type5" id="edit_price_type5" placeholder="Enter Your Product Name.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price5" class="form-label">Price 5</label>
                            <input type="number" class="form-control" name="price5" id="edit_price5" placeholder="Enter Your Product Name.">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary save-edit-btn">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php $this->load->view('backend/inc/sidebar')?>
        <div class="layout-page">
            <?php $this->load->view('backend/inc/header')?>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Product List</h4>
                    <div class="">
                        <form method="post" action="<?= site_url('uploadCSVFile')?>" enctype="multipart/form-data" class="csv_upload_form mb-5">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Your CSV Files</label>
                                <input class="form-control" type="file" id="formFile" name="csv_data" accept=".csv">
                            </div>
                            <button type="submit" class="btn btn-primary csv_upload_form_btn">Upload</button>
                        </form>
                    </div>
                    <button type="button" class="btn btn-primary mb-5 add-new-product" data-bs-toggle="modal" data-bs-target="#add-new-product">Add New Product</button>
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name And Type</th>
                                    <th>Details</th>
                                    <th>Prices</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <?php foreach ($productList as $product):?>
                                <tr>
                                    <td><?= $product->brand_name . " ". $product->brand_weight?> </td>
                                    <td><?= $product->brand_generic_name?></td>
                                    <td><?php
                                        if(round((int)$product->price0) != 0){echo $product->price_type0. " : " . round($product->price0). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price1) != 0){echo $product->price_type1. " : " . round($product->price1). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price2) != 0){echo $product->price_type2. " : " . round($product->price2). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price3) != 0){echo $product->price_type3. " : " . round($product->price3). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price4) != 0){echo $product->price_type4. " : " . round($product->price4). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price5) != 0){echo $product->price_type5. " : " . round($product->price5). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price6) != 0){echo $product->price_type6. " : " . round($product->price6). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price7) != 0){echo $product->price_type7. " : " . round($product->price7). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price8) != 0){echo $product->price_type8. " : " . round($product->price8). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price9) != 0){echo $product->price_type9. " : " . round($product->price9). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price10) != 0){echo $product->price_type10. " : " . round($product->price10). " tk<br>";}else{ echo'';}
                                        if(round((int)$product->price11) != 0){echo $product->price_type11. " : " . round($product->price11). " tk<br>";}else{ echo'';}

                                        ?></td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-outline-primary btn-sm product-edit-btn" data-id="<?= $product->id?>"><span class="tf-icons bx bx-edit-alt"></span></button>
                                        <button type="button" class="btn btn-icon btn-outline-danger btn-sm product-delete-btn" data-id="<?= $product->id?>"><span class="tf-icons bx bx-trash"></span></button>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        <?= $this->pagination->create_links()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('backend/inc/footer') ?>
