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
                                    System Setting
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main page content-->
            <div class="container px-4">
               <div class="row">
                   <div class="col-lg-8">
                       <div class="card card-header-actions mb-4">
                           <div class="card-header">
                               System Configuration
<!--                               <div class="form-check form-switch">-->
<!--                                   <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" checked="" />-->
<!--                                   <label class="form-check-label" for="flexSwitchCheckChecked"></label>-->
<!--                               </div>-->
                           </div>
                           <div class="card-body">
                               <form>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label class="small mb-1" for="app_name">App Name</label>
                                              <input class="form-control" id="app_name" type="text" placeholder="Application Name" value="" />
                                          </div>
                                          <div class="mb-3">
                                              <label class="small mb-1" for="app_version">App Version</label>
                                              <input class="form-control" id="app_version" type="text" placeholder="Application Name" value="" />
                                          </div>

                                      </div>
                                  </div>
                               </form>
                           </div>
                       </div>

                   </div>

                   <div class="col-lg-4">
                       <div class="card">
                           <div class="card-header">Notification Preferences</div>
                           <div class="card-body">
                               <form>
                                   <!-- Form Group (notification preference checkboxes)-->
                                   <div class="form-check mb-2">
                                       <input class="form-check-input" id="checkAutoGroup" type="checkbox"  />
                                       <label class="form-check-label" for="checkAutoGroup">Receive alerts when bin is full. </label>
                                   </div>

                               </form>
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
