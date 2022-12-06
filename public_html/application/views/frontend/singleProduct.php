<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searched Product</title>
    <?php foreach ($styleFileLink as $styleLink):?>
        <link rel="stylesheet" href="<?= $styleLink?>?t=<?= time()?>">
    <?php endforeach;?>

</head>
<body>
<?php $this->load->view('frontend/hfSection/header');?>
<main class="mb-5">

<?php $this->load->view('frontend/sections/homePage/productList');?>
</main>
<?php $this->load->view('frontend/hfSection/footer');?>

<script>
    const SITE_URL = '<?= site_url()?>';
    let csrf_token = "<?= $this->session->userdata('csrf_token')?>";
</script>
<?php foreach ($scriptFileLink as $scriptLink):?>
    <script src="<?= $scriptLink?>?t=<?= time()?>"></script>
<?php endforeach;?>

</body>
</html>