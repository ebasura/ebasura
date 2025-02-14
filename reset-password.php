<?php

include_once 'config/init.php';

if (isset($_GET['key'])){
    $confirm_key = $_GET['key'];
} else {
    $confirm_key = "";
}

if ($login->isLoggedIn()) {
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password | <?= APP_NAME ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/my-login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
      <!-- Android Chrome -->
      <link rel="icon" sizes="192x192" href="assets/img/android-chrome-192x192.png">
    <link rel="icon" sizes="512x512" href="assets/img/android-chrome-512x512.png">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">

    <!-- Web App Manifest -->
    <link rel="manifest" href="assets/img/site.webmanifest">
    <!--    Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"/>
    <link rel="stylesheet" href="assets/css/custom.css">

</head>

<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img src="assets/images/logo/phpLoginRegisterSystem.png" alt="logo">
                </div>
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title">Reset Password</h4>
                        <div class="well">
                            <div class="form-group">
                                <label for="reset_code">Reset Code</label>
                                <input type="text" id="reset_code" class="form-control" placeholder="Enter the confirmation code" value="<?= $confirm_key ?>">
                            </div>

                            <div class="form-group">
                                <label for="new_password">Enter new password</label>
                                <input type="text" id="new_password" class="form-control" placeholder="Enter your new password">
                            </div>

                            <div class="form-group m-0">
                                <button type="button" id="reset_pass_button" class="btn btn-primary btn-block">
                                   Reset Password
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="footer">
                    Copyright &copy; <?= date("Y") ?> &mdash; <?= APP_NAME ?>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://parsleyjs.org/dist/parsley.min.js"></script>
<script src="assets/js/sha512.min.js"></script>
<script src="bootstrap.php"></script>
</body>
</html>
