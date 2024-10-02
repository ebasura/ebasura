<?php
include_once 'init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard | E-Basura Monitoring System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
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
<body class="nav-fixed">

<?php include __DIR__ . '/templates/topnav.php'; ?>
<div id="layoutSidenav">
    <?php include __DIR__ . '/templates/sidenav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                <div class="container-fluid px-4">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i class="fa-light fa-monitor-waveform"></i></div>
                                    Reports
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

         
            <div class="container px-4">
                <div class="card">
                    <div class="card-body">


                    </div>
                </div>
            </div>
        </main>

        <?php

        include_once __DIR__ . '/templates/footer.php';

        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
