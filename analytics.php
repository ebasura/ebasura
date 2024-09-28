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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    
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
                                    Analytics
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main page content-->
            <div class="container px-4">
               <div class="row">
                <div class="col-12">
                <div class="card mb-4">
                            <div class="card-header bg-transparent">
                                Daily Waste Segregation Logs
                                <div class="d-flex float-end w-25">
                                   <input id="daily_logs" class="form-control form-control-sm" placeholder="Choose Date">
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="monthly_logs_chart"></div>
                            </div>
                        </div>

                </div>
                <div class="col-12">
                <div class="card mb-4">
                            <div class="card-header bg-transparent">
                            Monthly Waste Segregation Logs
                                <div class="d-flex float-end w-25">
                                    <select id="monthly_log_option" class="form-control form-control-sm">
                                        <option selected disabled>Choose Month</option>
                                        <option>2024</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="monthly_logs_chart"></div>
                            </div>
                        </div>

                </div>
                <div class="col-12">
                <div class="card mb-4">
                            <div class="card-header bg-transparent">
                            Yearly Waste Segregation Logs
                            
                            </div>
                            <div class="card-body">
                                <div id="monthly_logs_chart"></div>
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
    <script>

const allowedDates = ['2024-09-28', '2024-10-05', '2024-10-12'];

const picker = new Litepicker({
    element: document.getElementById('daily_logs'),
    allowDates: allowedDates, 
    highlightedDays : allowedDates, // Highlight the allowed dates
    lockDaysFilter: (date) => {
                return !allowedDates.includes(date.format('YYYY-MM-DD'));
    }
});



</script>


</body>
</html>
