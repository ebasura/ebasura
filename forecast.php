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
    <title>Forecast | E-Basura Monitoring System</title>
    <link href="css/styles.css" rel="stylesheet" />
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF Library -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
         .chart-container {
            margin-bottom: 50px;
        }
        h1, h2 {
            text-align: center;
        }
        #loader {
    text-align: center;
    margin-top: 20px;
        }

        .spinner {
            margin: 0 auto;
            width: 50px;
            height: 50px;
            border: 5px solid lightgray;
            border-top: 5px solid #1E90FF; /* Blue color */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        #loader p {
            font-size: 18px;
            margin-top: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
                                        Forecast
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Main page content-->
                <div class="container px-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                            <div class="card-body">
                                <div class="container">
                                <iframe id="binIframe" src="https://backend.ebasura.online/api/forecast/" scrolling="no" style=" width: 100%; height: 500px;  overflow: hidden;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <?php include_once __DIR__ . '/templates/footer.php'; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="bootstrap.php"></script>
</body>

</html>