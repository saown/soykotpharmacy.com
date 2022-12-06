<?php $this->load->view('backend/inc/head') ?>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php $this->load->view('backend/inc/sidebar')?>
        <div class="layout-page">
            <?php $this->load->view('backend/inc/header')?>
            <?php echo '<pre>'; print_r($_SESSION); echo'</pre>';?>
        </div>
    </div>
</div>
<?php $this->load->view('backend/inc/footer') ?>
