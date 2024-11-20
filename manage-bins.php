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
    <title>Manage Bins | E-Basura Monitoring System</title>
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
    <link rel="manifest" href="assets/img/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.css" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
    #loader {
        text-align: center;
        margin-top: 20px;
    }

    .spinner {
        margin: 0 auto;
        width: 50px;
        height: 50px;
        border: 5px solid lightgray;
        border-top: 5px solid #1E90FF;
        /* Blue color */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    #loader p {
        font-size: 18px;
        margin-top: 10px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    </style>
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
                                        <div class="page-header-icon"><i class="fa fa-trash"></i></div>
                                        Manage Bins
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="container px-4">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-header">Manage Bins</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBinModal">Add Bin</button>
                                        <table class="table table-striped table-hover dt-responsive"
                                            id="waste_logs_table">
                                            <thead>
                                                <tr>
                                                    <th>Bin ID</th>
                                                    <th>Bin Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM `waste_bins`;";
                                                $stmt = $db->query($sql);
                                                $stmt->execute();
                                                while($row = $stmt->fetch()):
                                            ?>
                                                <tr>
                                                    <td><?= $row['bin_id'] ?></td>
                                                    <td><?= $row['bin_name'] ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-secondary btn-sm edit" data-id="<?= $row['bin_id'] ?>"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <button class="btn btn-danger btn-sm delete" data-id="<?= $row['bin_id'] ?>"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                    </td>
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
            </main>

            <?php

        include_once __DIR__ . '/templates/footer.php';

        ?>

        </div>


        <div class="modal fade" id="editBinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form>
                            <div class="mb-3">
                                <label for="edit_bin_name">Bin Name</label>
                                <input type="text" name="edit_bin_name" id="edit_bin_name" class="form-control" placeholder="Enter Bin Name">
                            </div>
                            <div class="mb-3">
                                <label for="edit_bin_description">Bin Description</label>
                                <textarea name="edit_bin_description" id="edit_bin_description" class="form-control" placeholder="Enter Bin Description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" name="editBinButton" id="addBinButton">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addBinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="bin_name">Bin Name</label>
                                <input type="text" name="bin_name" id="bin_name" class="form-control" placeholder="Enter Bin Name">
                            </div>
                            <div class="mb-3">
                                <label for="bin_description">Bin Description</label>
                                <textarea name="bin_description" id="bin_description" class="form-control" placeholder="Enter Bin Description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" name="addBinButton" id="addBinButton">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="bootstrap.php"></script>
        <script>
            $(document).ready(function () { 

                $(document).on('click', '.edit', function () { 
                    let $id = $(this).data('id')
                        $.ajax({
                            type: "POST",
                            url: 'ajax.php',
                            data: {
                                action: 'editBin',
                                id: $id
                            }
                        })
                 });

                $(document).on('click', '.delete', function () { 
                    let $id = $(this).data('id')
                        $.ajax({
                            type: "POST",
                            url: 'ajax.php',
                            data: {
                                action: 'deleteBin',
                                id: $id
                            }
                        })
                 });

             })
        </script>


</body>

</html>