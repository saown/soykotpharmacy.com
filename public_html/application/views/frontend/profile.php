<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <?php foreach ($styleFileLink as $link){?>
    <link rel="stylesheet" href="<?= $link?>?t=<?= time()?>">
    <?php }?>
</head>
<body>
<?php $this->load->view('frontend/admin_header_and_footer/header');?>
<main class="container mt-5">
    <div class="row justify-content-between">
        <div class="col-md-6 card">
            <div class="card-body">
                <h4 class="text-center card-title">Your Personal Info</h4>
                <form class="personal-info-form" method="post" action="<?= site_url('changeProfileInfo')?>">
                    <div class="mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?= $client_data->username?>">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?= $client_data->email?>">
                    </div>
                    <div class="mb-2">
                        <label for="address_line_1" class="form-label">Address 1</label>
                        <input type="text" name="address_line_1" class="form-control" id="address_line_1" value="<?= $client_data->address_line_1?>">
                    </div>
                    <div class="mb-2">
                        <label for="address_line_2" class="form-label">Address 2</label>
                        <input type="text" name="address_line_2" class="form-control" id="address_line_2" value="<?= $client_data->address_line_2?>">
                    </div>
                    <div class="mb-2">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" value="<?= $client_data->phone_number?>">
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
        <div class="col-md-5 card">
            <div class="card-body">
                <h4 class="text-center card-title">Password</h4>
                <form class="password-change-form" method="post" action="<?= site_url('changePassword')?>">
                    <div class="mb-2">
                        <label for="old-pass" class="form-label">Old Password</label>
                        <input type="password" name="old-pass" class="form-control" id="old-pass" placeholder="Enter your old password">
                    </div>
                    <div class="mb-2">
                        <label for="new-pass" class="form-label">New Password</label>
                        <input type="password" name="new-pass" class="form-control" id="new-pass" placeholder="Enter your new password">
                    </div>
                    <div class="mb-2">
                        <label for="confirm-pass" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" placeholder="Retype your new password">
                    </div>
                    <button type="submit" class="btn btn-success password-changes-btn">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('frontend/admin_header_and_footer/footer');?>
<script>
    let SITE_URL = "<?= site_url()?>";
</script>

<?php foreach ($scriptFileLink as $link){?>
<script src="<?= $link?>?t=<?= time()?>"></script>
<?php }?>
</body>
</html>
