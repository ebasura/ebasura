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
    <!--    Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"/>
    <style>
    body {
        background-color: white !important; 
        color: black !important; 
    }
   
    .sidenav .nav-link {
    color: black !important; 
    transition: color 0.3s ease !important;
}


.sidenav .nav-link:hover {
    color: darkred !important; 
    background-color: white !important; 
}


.sidenav .nav-link.active {
    color: darkred !important; 
}

    .navbar, .page-header, .card-header {
        background-color: #8B0000;
        color: white !important;
    }

    .btn-primary {
        background-color: #8B0000 !important; 
        border-color: #8B0000 !important;
        color: white !important; 
    }

    .btn-primary:hover {
        background-color: #a00000 !important;
        border-color: #a00000 !important;
    }

    .card, .table {
        background-color: #fff; 
        color: black; 
    }
    .text-primary, .text-secondary, .text-success, .text-danger, .text-info {
        color: black !important;
    }

    .bg-gradient-primary-to-secondary {
        background: linear-gradient(90deg, #8B0000, #600000) !important;
    }

    .progress-bar {
        background-color: #8B0000 !important; 
    }

    .page-header-title, .page-header-subtitle, .small {
        color: darkgrey; 
    }
</style>
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
<script src="assets/js/index.js"></script>
</body>
</html>
