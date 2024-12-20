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
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

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
                                            Logs
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
                                <div class="card-header">Bin Full Notification</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-striped table-hover dt-responsive"
                                            id="bin_full_logs_table">                         
                                                               <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Message</th>
                                                <th scope="col">Bin</th>
                                                <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                 
                                                    $sql = "SELECT * FROM `waste_alerts` INNER JOIN waste_bins ON waste_bins.bin_id = waste_alerts.bin_id INNER JOIN waste_type ON waste_type.waste_type_id = waste_alerts.waste_type_id;";
                                                    $stmt = $db->query($sql);
                                                    $stmt->execute();
                                                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach($row as $r):
                                                ?>
                                                <tr>
                                                    <th scope="row"><?= $r['alert_id'] ?></th>
                                                    <td><?= $r['message'] ?></td>
                                                    <td><?= $r['bin_name'] ?> (<?= $r['name'] ?>)</td>
                                                    <td><?= $r['timestamp'] ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">Bin Level Logs</div>
                                <div class="card-body">
                                    <button class="btn btn-primary mb-3"
                                        onclick="window.open('print_logs.php', '_blank')">Print PDF</button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover dt-responsive"
                                            id="bin_logs_table">
                                            <thead>
                                                <tr>
                                                    <th>Bin Name</th>
                                                    <th>Bin Type</th>
                                                    <th>Waste Level</th>
                                                    <th>Waste Level Percentage</th>
                                                    <th>Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $settings_obj = new SystemSettings();
                                                $settings = $settings_obj->getSettings();
                                                
                                                $sql = "SELECT * FROM `bin_fill_levels` INNER JOIN waste_type ON waste_type.waste_type_id = bin_fill_levels.waste_type INNER JOIN waste_bins ON waste_bins.bin_id = bin_fill_levels.bin_id ORDER BY timestamp DESC;";
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
                                                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                foreach($row as $r):
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $r['bin_name'] ?></th>
                                                <td><?= $r['name'] ?></td>
                                                <td><?= $r['fill_level'] ?></td>
                                                <td>
                                                <?php 
                                                    $height = floatval($settings['initial_depth']) - floatval($r['fill_level']); 
                                                    echo ($height / floatval($settings['initial_depth'])) * 100;
                                                ?>
                                                </td>
                                                <td><?= $r['timestamp'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
        <script src="js/litepicker.js"></script>
        <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
        <script src="bootstrap.php"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
        <script>
            const dataTable = new simpleDatatables.DataTable("#bin_full_logs_table");
            const dataTable1 = new simpleDatatables.DataTable("#bin_logs_table");
        </script>
    </body>
    </html>
