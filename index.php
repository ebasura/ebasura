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
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css" integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        .status-icon {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 8px;
    background-color: gray; /* Default color before status is known */
    }

    .status-icon.online {
        background-color: green;
    }

    .status-icon.offline {
        background-color: red;
    }

    #trash_bin_status_list {
        list-style-type: none; /* Remove default list bullets */
        padding: 0;
    }

    #trash_bin_status_list li {
        margin-bottom: 10px;
        font-size: 16px;
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
                                <div class="small">
                                        <span class="fw-500 text-white" id="current-day"></span>
                                        · <span id="current-date"></span> · <span id="current-time"></span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>



            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <!-- Dashboard info widget 4-->
                        <div class="card border-start-lg border-start-info h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="small fw-bold text-info mb-1">Current Trash Bin</div>
                                        <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                            <div class="h5"><span id="current_bin"></span> </div>
                                        </div>
                                    </div>
                                    <div class="ms-2"><i class="fas fa-trash fa-2x text-gray-200"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-xl-3 col-md-6 mb-4">
                        <!-- Dashboard info widget 2-->
                        <div class="card border-start-lg border-start-secondary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="small fw-bold text-secondary mb-1">Recyclable Bin Status</div>
                                        <div class="h5"><span id="recyclable_bin_value">0</span></div>
                                        <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                            <i class="me-1" data-feather="trending-down"></i>
                                            3%
                                        </div>
                                    </div>
                                    <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <!-- Dashboard info widget 3-->
                        <div class="card border-start-lg border-start-success h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="small fw-bold text-success mb-1">Non-Recyclable Bin Status</div>
                                        <div class="h5"><span id="non_recyclable_bin_value">0</span></div>
                                        <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                            <i class="me-1" data-feather="trending-up"></i>
                                            12%
                                        </div>
                                    </div>
                                    <div class="ms-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                <!-- <div class="col-xl-12 col-md-2 mb-4 ">
                    <ul id="trash_bin_status_list" class="d-flex justify-content-center list-unstyled p-0 m-0">
                        <li id="trash_bin_1_status" class="me-3">
                            <span class="status-icon online" id="status_icon_1"></span>
                            CAS Trash Bin
                        </li>
                        <li id="trash_bin_2_status" class="me-3">
                            <span class="status-icon" id="status_icon_2"></span>
                            CTE Trash Bin
                        </li>
                        <li id="trash_bin_3_status">
                            <span class="status-icon" id="status_icon_3"></span>
                            CBME Trash Bin
                        </li>
                    </ul>
                </div> -->


                    <div class="col-lg-8 mb-2">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                
                                <div class="d-flex float-end w-25">
                                <label for="year">Select Year:</label>
                                <select class="form-control" id="wasteChartyear" onchange="updateChart()">
                                    <option value="2024" selected>2024</option>
                                </select>
                                </div>
                            </div>
                            <div class="card-body">
                            <div id="loader" style="display: none;">
                                    <div class="spinner"></div>
                                    <p>Loading data, please wait...</p>
                                </div>
                            <div id="wasteChart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="card card-header-actions mb-2">
                            <div class="card-header">
                                Recyclable Bin
                            </div>
                            <div class="card-body">
                                <canvas class="responsive-canvas" id="recyclable_bin"></canvas>
                            </div>
                        </div>


                        <div class="card card-header-actions mb-2">
                            <div class="card-header">
                                Non Recyclable Bin
                            </div>
                            <div class="card-body">
                                <canvas class="responsive-canvas" id="non_recyclable_bin"></canvas>
                            </div>
                        </div>
                        </div>

                    <div class="col-lg-8 mb-2">
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                <div class="container">
                                <iframe id="binIframe" src="https://backend.ebasura.online/daily-waste/1/" scrolling="no" style=" width: 100%; height: 500px;  overflow: hidden;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 mb-2">
                        <div class="card mb-4">
                            <div class="card-header"> Reports</div>
                            <div class="list-group list-group-flush small">
                                <a class="list-group-item list-group-item-action" href="#!">
                                    <i class="fas fa-dollar-sign fa-fw text-blue me-2"></i>
                                    Bin Forecasts
                                </a>
                                <a class="list-group-item list-group-item-action" href="#!">
                                    <i class="fas fa-dollar-sign fa-fw text-blue me-2"></i>
                                    Bin Forecasts
                                </a>
                            </div>
                            <div class="card-footer position-relative border-top-0">
                                <a class="stretched-link" href="reports.php">
                                    <div class="text-xs d-flex align-items-center justify-content-between">
                                        View More Reports
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <!-- Project tracker card example-->
                        <div class="card card-header-actions mb-4">
                            <div class="card-header">
                                System Information
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Operating System</div>
                                    <div id="os-version" class="small">Loading...</div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Kernel Version</div>
                                    <div id="kernel-version" class="small">Loading...</div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Uptime</div>
                                    <div id="uptime" class="small">Loading...</div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Temperature</div>
                                    <div id="temperature" class="small">Loading...</div>
                                </div>

                                <hr class="p-1">

                                <!-- Progress item 1-->
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">CPU Usage</div>
                                    <div id="cpu-usage" class="small">Loading...</div>
                                </div>
                                <div class="progress mb-3">
                                    <div id="cpu-progress" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <!-- Progress item 2-->
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">RAM Usage</div>
                                    <div id="ram-usage" class="small">Loading...</div>
                                </div>
                                <div class="progress mb-3">
                                    <div id="ram-progress" class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <!-- Progress item 2-->
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Disk Usage</div>
                                    <div id="disk-usage" class="small">Loading...</div>
                                </div>
                                <div class="progress mb-3">
                                    <div id="disk-progress" class="progress-bar bg-secondary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="bootstrap.php"></script>
    <script src="js/charts.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        $(function(){

            $('#waste_logs_table').DataTable({
                "iDisplayLength": 10, 
                processing: true,
                serverSide: true,
                responsive: true,
                serverMethod: 'post',
                ajax: {
                    url:'ajax.php',
                    data: {
                        action: 'dtFetchLogs'
                    }
                },
                columns: [
                    { data: 'waste_id' },
                    { data: 'waste_image' },
                    { data: 'waste_type' },
                    { data: 'date_created' },
                    { data: 'actions' }
                ],
                columnDefs: [ {
                    "target": "no-sort",
                    "orderable": false
                } ]
            });
        });

        function updateTime() {
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const now = new Date();

            const day = days[now.getDay()];
            const date = now.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const time = now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            document.getElementById('current-day').textContent = day;
            document.getElementById('current-date').textContent = date;
            document.getElementById('current-time').textContent = time;
        }

        setInterval(updateTime, 1000); 
        updateTime(); 
    </script>

</body>
</html>
