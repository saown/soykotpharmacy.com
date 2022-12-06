<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= site_url('assets/backend/assets/vendor/libs/jquery/jquery.js')?>"></script>
<script src="<?= site_url('assets/backend/assets/vendor/libs/popper/popper.js')?>"></script>
<script src="<?= site_url('assets/backend/assets/vendor/js/bootstrap.js')?>"></script>
<script src="<?= site_url('assets/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')?>"></script>

<script src="<?= site_url('assets/backend/assets/vendor/js/menu.js')?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= site_url('assets/backend/assets/vendor/libs/apex-charts/apexcharts.js')?>"></script>

<!-- Main JS -->
<script src="<?= site_url('assets/backend/assets/js/main.js')?>"></script>

<!-- Page JS -->
<script src="<?= site_url('assets/backend/assets/js/dashboards-analytics.js')?>"></script>
<script src="<?= site_url('assets/backend/js/sweetalert2.js')?>"></script>

<script>
    const SITE_URL = '<?= site_url()?>';
</script>

<?php
if (isset($pScript)){
    foreach ($pScript as $key) {
       echo "<script src='" .$key. "'></script>";
    }
}
if (isset($dashboardScript)){
    foreach ($dashboardScript as $key) {
        echo "<script src='" .$key. "'></script>";
    }
}

if (isset($orderScript)){
    foreach ($orderScript as $key) {
        echo "<script src='" .$key. "'></script>";
    }
}
?>
<script src="<?= site_url('assets/backend/js/custom/main.js')?>"></script>

</body>
</html>