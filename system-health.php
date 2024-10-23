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
    <link rel="manifest" href="assets/img/site.webmanifest">
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/custom.css">
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
                                    System Health Monitoring
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

                        <!-- CAS Bin Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title text-white mb-0">
                                    <i class="fas fa-microchip"></i> CAS Bin
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <!-- CAS Ultrasonic Sensor 1 -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-wave-square me-2"></i> CAS Ultrasonic Sensor (1)
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cas-sensor1" class="badge bg-danger">
                                                <i id="cas-icon1" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CAS Ultrasonic Sensor 2 -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-wave-square me-2"></i> CAS Ultrasonic Sensor (2)
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cas-sensor2" class="badge bg-danger">
                                                <i id="cas-icon2" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CAS Infrared Sensor -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-sun me-2"></i> CAS Infrared Sensor
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cas-proximitySensor" class="badge bg-danger">
                                                <i id="cas-icon3" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CAS Servo -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-cogs me-2"></i> CAS Servo
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cas-servo" class="badge bg-danger">
                                                <i id="cas-icon4" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- CTE Bin Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title text-white mb-0">
                                    <i class="fas fa-microchip"></i> CTE Bin
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <!-- CTE Ultrasonic Sensor 1 -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-wave-square me-2"></i> CTE Ultrasonic Sensor (1)
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cte-sensor1" class="badge bg-danger">
                                                <i id="cte-icon1" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CTE Ultrasonic Sensor 2 -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-wave-square me-2"></i> CTE Ultrasonic Sensor (2)
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cte-sensor2" class="badge bg-danger">
                                                <i id="cte-icon2" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CTE Infrared Sensor -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-sun me-2"></i> CTE Infrared Sensor
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cte-proximitySensor" class="badge bg-danger">
                                                <i id="cte-icon3" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CTE Servo -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-cogs me-2"></i> CTE Servo
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cte-servo" class="badge bg-danger">
                                                <i id="cte-icon4" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- CBME Bin Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title text-white mb-0">
                                    <i class="fas fa-microchip"></i> CBME Bin
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <!-- CBME Ultrasonic Sensor 1 -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-wave-square me-2"></i> CBME Ultrasonic Sensor (1)
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cbme-sensor1" class="badge bg-danger">
                                                <i id="cbme-icon1" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CBME Ultrasonic Sensor 2 -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-wave-square me-2"></i> CBME Ultrasonic Sensor (2)
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cbme-sensor2" class="badge bg-danger">
                                                <i id="cbme-icon2" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CBME Infrared Sensor -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-sun me-2"></i> CBME Infrared Sensor
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cbme-proximitySensor" class="badge bg-danger">
                                                <i id="cbme-icon3" class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                    <!-- CBME Servo -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="sensor-name">
                                            <i class="fas fa-cogs me-2"></i> CBME Servo
                                        </div>
                                        <div class="status-indicator">
                                            <span id="cbme-servo" class="badge bg-danger">
                                                <i id="cbme-icon4"class="fas fa-times-circle status-icon"></i> Offline
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        <?php include_once __DIR__ . '/templates/footer.php'; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="js/dashboard.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // CAS WebSocket Connection
            const casWebSocket = new WebSocket('https://cas-websocket.ebasura.online/');
            casWebSocket.onopen = function() {
                console.log('CAS WebSocket connection established');
            };
            casWebSocket.onmessage = function(event) {
                try {
                    const message = JSON.parse(event.data);
                    if (message.health_status) {
                        updateSensorStatus('cas', message.health_status);
                    }
                } catch (error) {
                    console.error('Error processing CAS message:', error);
                }
            };

            // CTE WebSocket Connection
            const cteWebSocket = new WebSocket('https://cte-websocket.ebasura.online/');
            cteWebSocket.onopen = function() {
                console.log('CTE WebSocket connection established');
            };
            cteWebSocket.onmessage = function(event) {
                try {
                    const message = JSON.parse(event.data);
                    if (message.health_status) {
                        updateSensorStatus('cte', message.health_status);
                    }
                } catch (error) {
                    console.error('Error processing CTE message:', error);
                }
            };

            // CBME WebSocket Connection
            const cbmeWebSocket = new WebSocket('https://cbme-websocket.ebasura.online/');
            cbmeWebSocket.onopen = function() {
                console.log('CBME WebSocket connection established');
            };
            cbmeWebSocket.onmessage = function(event) {
                try {
                    const message = JSON.parse(event.data);
                    if (message.health_status) {
                        updateSensorStatus('cbme', message.health_status);
                    }
                } catch (error) {
                    console.error('Error processing CBME message:', error);
                }
            };

            // Function to update sensor statuses dynamically based on the prefix
            function updateSensorStatus(prefix, health_status) {
                updateBadgeStatus(`#${prefix}-sensor1`, `#${prefix}-icon1`, health_status.sensors.recyclable_bin);
                updateBadgeStatus(`#${prefix}-sensor2`, `#${prefix}-icon2`, health_status.sensors.non_recyclable_bin);
                updateBadgeStatus(`#${prefix}-proximitySensor`, `#${prefix}-icon3`, health_status.sensors.proximity);
                updateBadgeStatus(`#${prefix}-servo`, `#${prefix}-icon4`, health_status.servo_online);
            }

            // Function to update the badge and icon for a sensor based on status
            function updateBadgeStatus(badgeSelector, iconSelector, isOnline) {
                const badgeElement = document.querySelector(badgeSelector);
                const iconElement = document.querySelector(iconSelector);

                if (isOnline) {
                    badgeElement.className = 'badge bg-success';
                    iconElement.className = 'fas fa-check-circle status-icon'; // Set icon for online
                    badgeElement.innerHTML = '<i class="fas fa-check-circle status-icon"></i> Online';
                } else {
                    badgeElement.className = 'badge bg-danger';
                    iconElement.className = 'fas fa-times-circle status-icon'; // Set icon for offline
                    badgeElement.innerHTML = '<i class="fas fa-times-circle status-icon"></i> Offline';
                }
            }
        });
    </script>
</body>
</html>
