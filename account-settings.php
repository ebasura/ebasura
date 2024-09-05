<?php
include_once 'init.php';

if (!$login->isLoggedIn()) {
    header('Location: login.php' );

} else {

    $user = new User();
    $userDetail = $user->getUserDetails();
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
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <script>
        var id = <?= $userDetail['user_id']; ?>
    </script>
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
                                    Account Settings
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main page content-->
            <div class="container px-4">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card mb-3">
                            <div class="card-header">
                        Change Profile
                            </div>
                            <div class="card-body">
                        <form enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control" id="avatar">
                            </div>
                            <div class="mb-3">
                                <label for="firstname-input">First Name</label>
                                <input type="text" class="form-control" value="<?= !empty($userDetail['first_name']) ? htmlentities($userDetail['first_name']) : '' ?>" id="firstname-input">
                            </div>

                            <div class="mb-3">
                                <label for="lastname-input">Last Name</label>
                                <input type="text" class="form-control" value="<?= !empty($userDetail['last_name']) ? htmlentities($userDetail['last_name']) : '' ?>" id="lastname-input">
                            </div>

                            <div class="mb-3">
                                <button type="button" id="changeProfileBtn" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                Change Password
                            </div>
                            <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" value="" id="old_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" value="" id="new_password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" value="" id="confirm_password">
                            </div>
                            <div class="mb-3">
                                <button type="button" id="changePasswordBtn" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6">


                        <div class="card mb-3">
                            <div class="card-header">
                                Advanced Security
                            </div>
                            <div class="card-body">
                        <form>

                            <?php if($userDetail['tfa_enabled'] == 0): ?>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#validatePass">
                                        Use two-factor authentication
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disable2fa">
                                        Disable two-factor authentication
                                    </button>
                                </div>
                            <?php endif; ?>
                        </form>
                            </div>
                        </div>



                        <div class="card mb-3">
                            <div class="card-header">
                                Recent Logins
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="recent_login_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">User Agent</th>
                                        <th scope="col">IP Address</th>
                                        <th scope="col">Last Online</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM login_sessions WHERE user_id = :uid";
                                    $user_id = $userDetail['user_id'];
                                    $stmt = $db->prepare($sql);
                                    $stmt->bindParam(":uid", $user_id);
                                    $stmt->execute();

                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                        ?>
                                        <tr>
                                            <td><?= $row['user_agent'] ?></td>
                                            <td><?= $row['ip_address'] ?></td>
                                            <td><?= $row['datetime'] ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <div class="modal fade" id="validatePass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Set up two-factor authentication</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <p class="mb-0">To continue, please enter your password for verification.</p>
                            <div class="form-group">
                                <input type="password" id="2fapasswordverify" class="form-control" placeholder="Enter your Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="verifyPassBtn" data-bs-dismiss="modal" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="disable2fa" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Disable two-factor authentication</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <p class="mb-0">To continue, please enter your password for verification.</p>
                            <div class="form-group">
                                <input type="password" id="2fadisablepassword" class="form-control" placeholder="Enter your Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="disable2faBtn" data-bs-dismiss="modal" class="btn btn-danger">Turn off</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="tfaSetup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Set up two-factor authentication</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <p class="mb-3">Now, Let's get started.</p>
                            <div class="d-flex justify-content-sm-center">
                                <div class="mb-3 border border-1">
                                    <img src="" id="tfaQRCode"/>
                                </div>
                            </div>

                            <p id="secretKey" class="fs-4 fw-bold text-center text-uppercase border border-secondary"></p>
                            <input type="hidden" id="secret_key">

                            <div class="form-floating">
                                <input type="number" class="form-control" name="6digitcode" id="6digitcode" placeholder="6 Digit Verification Code">
                                <label for="6digitcode">6 Digit Verification Code</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="confirmSetup" class="btn btn-primary">Confirm</button>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="assets/js/sha512.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/tfa-auth.js"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#recent_login_table", {
            searchable: false,
            fixedColumns: true,
            perPage: 3

        });
    </script>
</body>
</html>
