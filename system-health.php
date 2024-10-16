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
    <title>Logs | E-Basura Monitoring System</title>
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
    <link rel="manifest" href="assets/img/site.webmanifest">    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        ul {
            list-style-type: none;
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
                                    <div class="page-header-icon"><i data-feather="refresh-cw"></i></div>
                                    System Health
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

                <!-- Device Status Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title text-white mb-0">
                            <i class="fas fa-microchip"></i> CAS Bin
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- Ultrasonic Sensor 1 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-wave-square me-2"></i> Ultrasonic Sensor (1)
                                </div>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Online
                                </span>
                            </li>
                            <!-- Ultrasonic Sensor 2 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-wave-square me-2"></i> Ultrasonic Sensor (2)
                                </div>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle"></i> Offline
                                </span>
                            </li>
                            <!-- Servo -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-cogs me-2"></i> Servo
                                </div>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Online
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- Device Status Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title text-white mb-0">
                            <i class="fas fa-microchip"></i> CBME Bin
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- Ultrasonic Sensor 1 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-wave-square me-2"></i> Ultrasonic Sensor (1)
                                </div>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Online
                                </span>
                            </li>
                            <!-- Ultrasonic Sensor 2 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-wave-square me-2"></i> Ultrasonic Sensor (2)
                                </div>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle"></i> Offline
                                </span>
                            </li>
                            <!-- Servo -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-cogs me-2"></i> Servo
                                </div>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Online
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- Device Status Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title text-white mb-0">
                            <i class="fas fa-microchip"></i> CTE Bin
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- Ultrasonic Sensor 1 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-wave-square me-2"></i> Ultrasonic Sensor (1)
                                </div>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Online
                                </span>
                            </li>
                            <!-- Ultrasonic Sensor 2 -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-wave-square me-2"></i> Ultrasonic Sensor (2)
                                </div>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle"></i> Offline
                                </span>
                            </li>
                            <!-- Servo -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-cogs me-2"></i> Servo
                                </div>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Online
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>


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
