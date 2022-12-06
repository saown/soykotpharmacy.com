<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <?php foreach ($styleFileLink as $styleLink):?>
        <link rel="stylesheet" href="<?= $styleLink?>?t=<?= time()?>">
    <?php endforeach;?>

</head>
<body>
<?php $this->load->view('frontend/hfSection/header');?>
<div class="contact">
    <form action="<?= site_url('contactUsMessage')?>" method="post" class="contact-form">
        <span class="text-center text-uppercase h2">Contact With Us</span>
        <label for="name" class="mb-2">Name</label>
        <input type="text" name="name" id="name" class="mb-3" placeholder="Enter your name">
        <label for="email" class="mb-2">Email</label>
        <input type="email" name="email" id="email" class="mb-3" placeholder="Enter your email">
        <label for="message" class="mb-2">Message</label>
        <textarea name="message" id="message" rows="5"></textarea>
        <button type="submit" class="btn btn-success mt-3 contact-from-btn">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.9996 1L6.84961 8.15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 1L9.45 14L6.85 8.15L1 5.55L14 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Send
        </button>
    </form>
</div>
<?php $this->load->view('frontend/hfSection/footer')?>
<script>
    const SITE_URL = '<?= site_url()?>';
    let csrf_token = "<?= $this->session->userdata('csrf_token')?>";
</script>
<?php foreach ($scriptFileLink as $scriptLink):?>
    <script src="<?= $scriptLink?>?t=<?= time()?>"></script>
<?php endforeach;?>

</body>
</html>