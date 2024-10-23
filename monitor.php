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
    <title>Live Monitoring | E-Basura Monitoring System</title>
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
                                    Live Monitoring
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main page content-->
            <div class="container px-4">
                <div class="card">
                    <div class="card-body  text-center ">
                        <div class="video-container">
                            <canvas id="videoCanvas" width="640" height="480"></canvas>
                                <span id="predictions"></span>

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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/index.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById('videoCanvas');
            const context = canvas.getContext('2d');
            const predictionsDiv = document.getElementById('predictions');

            let websocket;

            function connectWebSocket() {
                websocket = new WebSocket('https://cas-websocket.ebasura.online/');

                websocket.onopen = function() {
                    console.log('WebSocket connection established');
                };

                websocket.onmessage = function(event) {
                    try {
                        // Parse the incoming message
                        const message = JSON.parse(event.data);
                        const frameData = message.frame;
                        const predictions = message.predictions;

                        // Convert the frame data from base64 to an image
                        const img = new Image();
                        img.onload = function() {
                            context.clearRect(0, 0, canvas.width, canvas.height);
                            context.drawImage(img, 0, 0, canvas.width, canvas.height);
                        };
                        img.src = frameData;

                        // Display the predictions
                        predictionsDiv.innerHTML = '<h3>Predictions:</h3>';
                        predictions.forEach(prediction => {
                            const label = prediction[0];
                            const confidence = prediction[1];
                            predictionsDiv.innerHTML += `<p>${label}: ${(confidence * 100).toFixed(2)}%</p>`;
                        });
                    } catch (error) {
                        console.error('Error processing message:', error);
                    }
                };

                websocket.onerror = function(error) {
                    console.error('WebSocket Error:', error);
                };

                websocket.onclose = function(event) {
                    console.warn('WebSocket closed. Attempting to reconnect in 3 seconds...', event.reason);
                    setTimeout(connectWebSocket, 3000); // Retry connection after 3 seconds
                };
            }

            // Start the initial connection
            connectWebSocket();
        });
    </script>
</body>
</html>
