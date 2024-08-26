<?php
    include_once 'init.php';

// if (!$login->isLoggedIn()) {
//     header("Location: login.php");
//     die();
// }
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
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <style>
        .responsive-canvas {
            width: 100%;
        }
        .video-container {
            width: 100%;
            max-width: 100%;
            position: relative;
        }

        .video-container .video-js {
            width: 100%; 
            height: 0;
            padding-top: 56.25%;
            top: 0;
            left: 0;
        }

        .video-container .vjs-tech {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body class="nav-fixed">

<?php include __DIR__ . '/templates/topnav.php'; ?>
<div id="layoutSidenav">
    <?php include __DIR__ . '/templates/sidenav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                                    Welcome to E-Basura
                                </h1>
                                <div class="page-header-subtitle">A Web Monitoring System</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="row">
                    <div class="col-xl-4 mb-4">
                        <!-- Dashboard example card 3-->
                        <a class="card lift h-100" href="#!">
                            <div class="card-body d-flex justify-content-center flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="me-3">
                                        <h5>Live Camera Feed</h5>
                                    </div>
                                </div>
                                <div class="video-container">
                                    <img id="video-stream" width="640" height="250" alt="Video Stream" class="img-thumbnail">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 mb-4">
                        <!-- Dashboard example card 1-->
                        <a class="card lift h-100" href="#!">
                            <div class="card-body d-flex justify-content-center flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="me-3">
                                        <h6 class="text-center">Recyclable Bin Status</h6>
                                    </div>
                                </div>
                                <canvas class="responsive-canvas" id="recyclable_bin"></canvas>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 mb-4">
                        <!-- Dashboard example card 2-->
                        <a class="card lift h-100" href="#!">
                            <div class="card-body d-flex justify-content-center flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="me-3">
                                        <h6 class="text-center">Non-Recyclable Bin Status</h6>
                                    </div>
                                </div>
                                <canvas class="responsive-canvas" id="non_recyclable_bin"></canvas>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-12 mb-2">
                        <div class="d-flex justify-content-center">
                            <div class="card">
                               <div class="card-body">
                                   LOL
                               </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    LOL
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    LOL
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    LOL
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table_logs">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Classification</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></div>
                                                Tiger Nixon
                                            </div>
                                        </td>
                                        <td>Non-Recyclable</td>
                                        <td>August 23, 2024 8:21 AM</td>
                                    </tr>
                                    </tbody>
                                </table>
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
    <script src="js/index.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        const videoStream = document.getElementById('video-stream');
        const socket = new WebSocket('ws://localhost:8765');

        socket.onopen = function() {
            console.log("WebSocket connection established");
        };

        socket.onmessage = function(event) {
            // Set the image source to the received base64 image data
            videoStream.src = 'data:image/jpeg;base64,' + event.data;
        };

        socket.onclose = function() {
            console.log("WebSocket connection closed");
        };

        socket.onerror = function(error) {
            console.error("WebSocket error observed:", error);
        };
    </script>


</body>
</html>