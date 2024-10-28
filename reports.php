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
    <title>Reports | E-Basura Monitoring System</title>
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
                                        <div class="page-header-icon"><i class="fa-light fa-monitor-waveform"></i></div>
                                        Reports
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
                                <div class="card-header">Logs</div>
                                <div class="card-body">
                                    <button class="btn btn-primary mb-3"
                                        onclick="window.open('print_logs.php', '_blank')">Print PDF</button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover dt-responsive"
                                            id="waste_logs_table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Bin Name</th>
                                                    <th>Trash Type</th>
                                                    <th>Confidence Level</th>
                                                    <th>Date Created</th>
                                                    <th class="no-sort">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>


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

        <!-- Modal for displaying larger image -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Waste Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" class="img-fluid" alt="Waste Image">
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js">
        </script>
    <script src="bootstrap.php"></script>
    <script>
         function showImage(imageUrl) {
            // Set the image URL in the modal
            document.getElementById('modalImage').src = imageUrl;
        }

        // Function to print the table as a PDF
        function printPdf() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.text('Waste Forecast Table', 10, 10);
            doc.autoTable({
                html: '#forecastTable',
                startY: 20,
                theme: 'grid'
            });

            doc.save('waste_forecast.pdf');
        }

        // Event listener for printing the PDF
        $('#printPdfBtn').on('click', function() {
            printPdf();
        });

        // Initialize data fetch
        $(document).ready(function() {
            fetchData();
        });


        let ballTd = $('#waste_logs_table').DataTable({
            "iDisplayLength": 10,
            processing: true,
            serverSide: true,
            responsive: true,
            serverMethod: 'post',
            ajax: {
                url: 'ajax.php',
                data: {
                    action: 'dtFetchLogs'
                }
            },
            columns: [{
                    data: 'waste_id'
                },
                {
                    data: 'waste_image'
                },
                {
                    data: 'bin_name'
                },
                {
                    data: 'waste_type'
                },
                {
                    data: 'confidence'
                },
                {
                    data: 'date_created'
                },
                {
                    data: 'actions'
                }
            ],
            columnDefs: [{
                "target": "no-sort",
                "orderable": false
            }]
        });



        $(document).on('click', '.delete-log', function() {

            let id = $(this).data('id');

            // SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, make the AJAX request to delete the log
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: {
                            action: 'deleteLog',
                            id: id
                        },
                        success: function(response) {
                            // Parse the JSON response
                            let res = JSON.parse(response);
                            // Check if status is true
                            if (res.success === true) {
                                // Show success message
                                Swal.fire(
                                    'Deleted!',
                                    'Your log has been deleted.',
                                    'success'
                                );

                                ballTd.ajax.reload(null, false);

                                // Optionally, remove the log from the UI or refresh the page
                            } else {
                                // Handle case where status is false
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting your log.',
                                    'error'
                                );
                            }
                        },

                        error: function(xhr, status, error) {
                            // Handle error
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting your log.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        </script>


</body>

</html>