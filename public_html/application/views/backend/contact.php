<?php $this->load->view('backend/inc/head') ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php $this->load->view('backend/inc/sidebar')?>
            <div class="layout-page">
                <?php $this->load->view('backend/inc/header')?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Contact Message</h4>

                        <?php echo "<pre>"; print_r($contactUsMessages); echo "</pre>";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('backend/inc/footer') ?>