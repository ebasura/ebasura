<?php
include_once 'init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}

$settings_obj = new SystemSettings();
$settings = $settings_obj->getSettings();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>System Settings | E-Basura Monitoring System</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                              <input class="form-control" id="app_name" type="text" placeholder="Application Name" value="<?= $settings['app_name']; ?>" />
                                          </div>

                                          <div class="mb-3">
                                              <label class="small mb-1" for="app_version">App Version</label>
                                              <input class="form-control" id="app_version" type="text" placeholder="Application Name" value="<?php echo APP_VERSION; ?>" />
                                          </div>

                                          <hr>

                                          <div class="mb-3">
                                              <label class="small mb-1" for="trash_bin_selector">Dashboard Trash Bin</label>
                                              <select name="trash_bin_selector" id="trash_bin_selector" class="form-control">
                                                  <option value="1" selected >CAS Trash Bin</option>
                                                  <option value="2">CTE Trash Bin</option>
                                                  <option value="3">CBME Trash Bin</option>
                                              </select>
                                          </div>

                                      </div>
                                  </div>
                               </form>
                           </div>
                       </div>




                   </div>

                   <div class="col-lg-4">
                       <div class="card card-header-actions mb-4">
                           <div class="card-header">
                               Model Configuration
                               <div class="d-flex">
                                   <button type="button" class="btn btn-outline-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#model_modal">Upload Model</button>
                               </div>
                           </div>
                           <div class="card-body">
                               <form id="update_model">
                                   <div class="mb-3">
                                       <label class="small mb-1" for="model_name">Model Version</label>
                                       <select name="model_name" id="model_name" class="form-control">
                                           <option disabled>Select Version</option>
                                           <option value="1" selected>TensorFlow Lite v1.1</option>
                                       </select>
                                   </div>
                                   <div class="mb-3">
                                       <button type="button" id="update_model_button" class="btn btn-primary">Save changes</button>
                                   </div>
                               </form>
                           </div>
                       </div>
                       <div class="card card-header-actions mb-4">
                           <div class="card-header ">
                               Notification Preferences
                           </div>
                           <div class="card-body">
                               <form>

                                   <div class="mb-3">
                                       <label for="notify_sms">API Key</label>
                                       <input class="form-control" type="text" id="sms_api_key" name="sms_api_key" value="<?php echo $settings['api_key']; ?>" readonly>
                                   </div>


                                   <div class="mb-3">
                                       <label for="notify_sms">SMS Receiver</label>
                                       <input class="form-control" type="text" id="notify_sms" name="notify_sms" value="<?php echo $settings['sms_receiver']; ?>">
                                   </div>

                                   <div class="mb-3">
                                       <label for="alert_threshold">Alert Threshold:</label>
                                       <input class="form-control" type="number" id="alert_threshold" name="alert_threshold" value="<?php echo $settings['alert_threshold']; ?>">
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
                    <form id="model-upload-form">

                        <div class="mb-3">
                            <label for="model_description">Model Description</label>
                            <input type="text" id="model_description" name="model_description" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="model_file">Tflite Model</label>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
    $(document).ready(function () {
    $("#upload_model").on('click', function (e) {
        e.preventDefault();
        var formData = new FormData($("#model-upload-form")[0]);
        
        $.ajax({
            url: 'https://api.ebasura.online/upload-model', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle success
                alert("File uploaded successfully!");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle error
                alert("File upload failed: " + textStatus);
            }
        });
    });

    $("#update_model_button").on('click', function(e){
        e.preventDefault();
        var model_name = $('#model_name').val();

        Swal.fire({
            text: 'Continuing the update will restart the server',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                    title: "Updated!",
                    text: "The model has been updated. Restarting server.",
                    icon: "success"
                    });
                }
            });



    });
});

</script>

</body>
</html>
