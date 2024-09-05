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

                           </div>
                           <div class="card-body">
                               <form>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="mb-3">
                                              <label class="small mb-1" for="app_name">App Name</label>
                                              <input class="form-control" id="app_name" type="text" placeholder="Application Name" value="<?php echo APP_NAME; ?>" />
                                          </div>
                                          <div class="mb-3">
                                              <label class="small mb-1" for="app_version">App Version</label>
                                              <input class="form-control" id="app_version" type="text" placeholder="Application Name" value="<?php echo APP_VERSION; ?>" />
                                          </div>

                                      </div>
                                  </div>
                               </form>
                           </div>
                       </div>

                       <div class="card card-header-actions ">
                           <div class="card-header">
                               Database Configuration

                           </div>
                           <div class="card-body">
                               <form>
                                   <div class="mb-3">

                                   <label for="db_host">DB Host:</label>
                                   <input class="form-control" id="db_host" type="text" name="db_host" value="<?php echo DB_HOST; ?>">
                                   </div>
                                   <div class="mb-3">

                                       <label for="db_user">DB User:</label>
                                   <input class="form-control" id="db_user" type="text" name="db_user" value="<?php echo DB_USER; ?>">
                                       </div>
                                       <div class="mb-3">

                                           <label for="db_pass">DB Password:</label>
                                   <input class="form-control" id="db_pass" type="password" name="db_pass" value="<?php echo DB_PASS; ?>">
                                           </div>
                                           <div class="mb-3">

                                               <label for="db_name">DB Name:</label>
                                   <input class="form-control" id="db_name" type="text" name="db_name" value="<?php echo DB_NAME; ?>">
                                               </div>

                                               <div class="mb-3">
                                       <button type="button" id="update_model" class="btn btn-primary">Save changes</button>
                                   </div>
                               </form>
                           </div>
                       </div>


                   </div>

                   <div class="col-lg-4">
                       <div class="card mb-4">
                           <div class="card-header">Notification Preferences</div>
                           <div class="card-body">
                               <form>
                                   <!-- Form Group (notification preference checkboxes)-->
                                   <div class="form-check mb-3">
                                       <input class="form-check-input" id="checkAutoGroup" type="checkbox" checked />
                                       <label class="form-check-label" for="checkAutoGroup">Receive alerts when bin is full. </label>
                                   </div>

                                   <div class="mb-3">
                                       <label for="notify_sms">Notification SMS:</label>
                                       <input class="form-control" type="text" id="notify_sms" name="notify_sms" value="<?php echo NOTIFY_SMS; ?>">
                                   </div>

                                   <div class="mb-3">
                                       <label for="alert_threshold">Alert Threshold:</label>
                                       <input class="form-control" type="number" id="alert_threshold" name="alert_threshold" value="<?php echo ALERT_THRESHOLD; ?>">
                                   </div>

                                   <div class="mb-3">
                                       <button type="button" id="update_model" class="btn btn-primary">Save changes</button>
                                   </div>

                               </form>
                           </div>
                       </div>

                       <div class="card card-header-actions ">
                           <div class="card-header">
                               Model Configuration
                               <div class="d-flex">
                                   <button type="button" class="btn btn-outline-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#model_modal">Upload Model</button>
                               </div>
                           </div>
                           <div class="card-body">
                               <form>
                                   <div class="mb-3">
                                       <label class="small mb-1" for="model_name">Model Version</label>
                                       <select name="model_name" id="model_name" class="form-control">
                                           <option disabled>Select Version</option>
                                           <option value="1" selected>TensorFlow Lite v1.1</option>
                                       </select>
                                   </div>
                                   <div class="mb-3">
                                       <button type="button" id="update_model" class="btn btn-primary">Save changes</button>
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



    <div class="modal fade" id="model_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Model Settings</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="model_file">Upload Model</label>
                            <input type="file" name="model_file" id="model_file" class="form-control">
                            <div id="model_file_help" class="form-text">Models are generated from <a target="_blank" href="https://teachablemachine.withgoogle.com/">Teachable Machine by Google</a> </div>
                        </div>
                        <div class="mb-3">
                            <button type="button" id="upload_model" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
