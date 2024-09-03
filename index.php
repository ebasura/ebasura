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
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css" integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        /* Card styling */
        .rpi {
            width: 150px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            font-family: 'Arial', sans-serif;
            margin: 8px;
        }

        .card-body {
            padding: 12px;
            text-align: center;
        }

        .card-body h6 {
            margin-bottom: 15px;
            font-size: 13px;
            color: #333;
        }

        /* Progress bar container */
        .progress {
            background-color: #f1f1f1;
            border-radius: 16px;
            overflow: hidden;
            height: 20px;
            width: 100%;
        }

        /* Progress bar itself */
        .progress-bar {
            background-color: #4caf50;
            height: 100%;
            text-align: center;
            color: #fff;
            line-height: 20px; /* vertically centers the text */
            transition: width 0.4s ease;
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
                                        <h5>Real Time Monitoring</h5>
                                    </div>
                                </div>
                                <div class="video-container">
                                    <img id="video-stream"  alt="Video Stream" class="img-thumbnail">
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


                </div>

                <div class="row">

                    <div class="col-lg-12 mb-2">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <div class="d-flex float-end w-25">
                                    <select id="monthly_log_option" class="form-control">
                                        <option selected disabled>Choose Year</option>
                                        <option>2024</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="monthly_logs_chart"></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-8 mb-2">

                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-header">Logs</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="logs_table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Trash Type</th>
                                                <th>Date Created</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $basura = new Basura();
                                            $trash_data = $basura->get();

                                            echo json_encode($trash_data);
                                            foreach ($trash_data as $row):
                                            ?>
                                            <tr>
                                                <td><?= htmlentities($row['waste_data_id']) ?></td>
                                                <td class="col-4">
                                                    <img id="image" class="img-thumbnail w-25" src="<?= $row['image_url'] ?>" alt="Trash Image">
                                                </td>
                                                <?php if($row['name'] == 'Recyclable'): ?>
                                                <td><div class="badge bg-primary rounded-pill"><?= $row['name'] ?></div></td>
                                                <?php else: ?>
                                                <td><div class="badge bg-secondary rounded-pill"><?= $row['name'] ?></div></td>
                                                <?php endif; ?>
                                                <td>2024-09-03</td>
                                                <td>
                                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa-regular fa-trash-can"></i></button>
                                                </td>
                                            </tr>

                                            <?php
                                            endforeach;
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div id="daily_logs_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 mb-2">

                        <div class="card card-header-actions mb-4">
                            <div class="card-header">
                                Trash Bin Weights
                            </div>
                            <div class="card-body">
                                <div id="trash_bin_weights"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/index.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#logs_table");

        const viewer = new Viewer(document.getElementById('image'), {
            inline: false,
            toolbar: false,
            viewed() {
                viewer.zoomTo(1);
            },
        });

    </script>

</body>
</html>
