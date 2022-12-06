<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Soykot Pharmacy">
    <meta name="keywords" content="Soykoy Pharmacy, Online Medicine Shop, soykotpharmacy.com, soykot_pharmacy, soykot phamacy">
    <meta name="description" content="We are creating a moment of caring health. We will deliver the medicine to your doorstep. We are providing the best medicine, the best price. Our online pharmacy with this goal.">

    <title>Soykot Pharmacy</title>
    <?php foreach ($styleFileLink as $styleLink): ?>
        <link rel="stylesheet" href="<?= $styleLink ?>?t=<?= time() ?>">
    <?php endforeach; ?>

</head>
<body>
<?php $this->load->view('frontend/hfSection/header'); ?>

<main>
<?php $this->load->view('frontend/sections/homePage/productList'); ?>
<div class="mt-5 mb-5 page-list">
<?= $this->pagination->create_links();?>
</div>
</main>
<?php $this->load->view('frontend/hfSection/footer')?>

<script>
    const SITE_URL = '<?= site_url()?>';
    let csrf_token = "<?= $this->session->userdata('csrf_token')?>";
</script>
<?php foreach ($scriptFileLink as $scriptLink): ?>
    <script src="<?= $scriptLink ?>?t=<?= time() ?>"></script>
<?php endforeach; ?>

</body>
</html>