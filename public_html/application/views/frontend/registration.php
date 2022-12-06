<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- title -->
    <title>Sign Up</title>

    <!-- css link -->
    <link rel="stylesheet" href="<?= site_url('assets/bootstrap/css/bootstrap.min.css')?>?t=<?= time()?>">
    <link rel="stylesheet" href="<?= site_url('assets/front-end/css/auth.css')?>?t=<?= time()?>">
</head>
<body>
<div class="signup">
    <div class="logo text-center mb-4 mt-5">
        <p class="h1">Sign Up</p>
    </div>
    <form id="registration-form" class="p-2" method="post" action="<?= site_url('registrationProcess')?>">
        <div class="mb-2">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Enter your username." id="username"/>
        </div>
        <div class="mb-2">
            <label class="form-label" for="email">Email Address</label>
            <input class="form-control" type="email" name="email" placeholder="Enter your email." id="email"/>
        </div>
        <div class="mb-2">
            <label class="form-label" for="address_line_1">Address 1</label>
            <input class="form-control" type="text" name="address_line_1" placeholder="Enter your address." id="address_line_1"/>
        </div>
        <div class="mb-2">
            <label class="form-label" for="address_line_2">Address 2 (Optional)</label>
            <input class="form-control" type="text" name="address_line_2" placeholder="Enter your address." id="address_line_2"/>
        </div>
        <div class="mb-2">
            <label class="form-label" for="phone_number">Phone Number</label>
            <input class="form-control" type="text" name="phone_number" placeholder="Enter your phone number." id="phone_number"/>
        </div>
        <div class="mb-2">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter your password." id="password">
        </div>
        <div class="mb-2">
            <label class="form-label" for="confirmed-password">Confirmed Password</label>
            <input class="form-control" type="password" name="confirmed_password" placeholder="Enter your password again." id="confirmed-password">
        </div>
        <div class="mb-2">
            <label for="district" class="form-label">District</label>
            <select name="district" id="district" class="form-select">
                <option value="Dhaka">Dhaka</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="city" class="form-label">City</label>
            <select name="city" id="city" class="form-select">
                <option value="Dhaka">Dhaka</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="post_code" class="form-label">Post Code</label>
            <input type="text" name="post_code" id="post_code" class="form-control" placeholder="Enter your post code.">
        </div>
        <button type="submit" class="btn btn-success w-100 mt-2 signup-form-btn">Sign Up</button>
    </form>
    <div class="text-center mt-2 mb-5">
        <a href="<?= site_url()?>"><- Back</a>
    </div>
</div>

<!-- script link -->
<script>
    let SITE_URL = "<?= site_url()?>";
</script>
<script src="<?= site_url('assets/sweetalert2/sweetalert2.js')?>"></script>
<script src="<?= site_url('assets/jquery/jquery-3.6.0.js')?>"></script>
<script src="<?= site_url('assets/bootstrap/js/bootstrap.min.js')?>?t=<?= time()?>"></script>
<script src="<?= site_url('assets/front-end/js/custom/registration.js')?>?t=<?= time()?>"></script>
</body>
</html>