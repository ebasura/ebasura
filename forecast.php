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
    <title>Forecast | E-Basura Monitoring System</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF Library -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
         .chart-container {
            margin-bottom: 50px;
        }
        h1, h2 {
            text-align: center;
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
                                        Forecast
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
                                <div class="card-body">
                                 <div id="forecastCharts"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <?php include_once __DIR__ . '/templates/footer.php'; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="js/index.js"></script>
        <script>
        var apiEndpoint = `${bitress.Http.api_url}/api/forecast`;

        // Fetch data from the API
        fetch(apiEndpoint)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(function(data) {
                // Proceed with data processing and chart rendering
                renderCharts(data);
            })
            .catch(function(error) {
                console.error('There was a problem with the fetch operation:', error);
            });

        function renderCharts(data) {
            var chartsDiv = document.getElementById('cha');

            // Group data by bin_name
            var bins = {};

            data.forEach(function(binData) {
                var binName = binData.bin_name;
                if (!bins[binName]) {
                    bins[binName] = {};
                }
                bins[binName][binData.waste_type] = binData.forecast;
            });

            Object.keys(bins).forEach(function(binName, index) {
                var binData = bins[binName];
                var recyclableData = binData['Recyclable'] || [];
                var nonRecyclableData = binData['Non-Recyclable'] || [];

                var containerDiv = document.createElement('div');
                containerDiv.className = 'chart-container';

                var heading = document.createElement('h2');
                heading.textContent = binName;
                containerDiv.appendChild(heading);

                var chartDiv = document.createElement('div');
                chartDiv.id = 'chart' + index;
                containerDiv.appendChild(chartDiv);

                chartsDiv.appendChild(containerDiv);

                // Function to parse date and time into a timestamp
                function parseDateTime(dateStr, timeStr) {
                    // dateStr is in "YYYY-MM-DD"
                    // timeStr is in "HH:MM AM/PM"
                    var dateTimeStr = dateStr + ' ' + timeStr;
                    var dateTime = new Date(dateTimeStr);
                    if (isNaN(dateTime)) {
                        console.error('Invalid date/time:', dateStr, timeStr);
                        return null;
                    }
                    return dateTime.getTime();
                }

                // Process data into timestamped data points
                function processData(forecastData) {
                    return forecastData.map(function(item) {
                        var timestamp = parseDateTime(item.date, item.time);
                        return {
                            x: timestamp,
                            y: item.predicted_level
                        };
                    }).filter(function(item) {
                        return item.x !== null;
                    }).sort(function(a, b) {
                        return a.x - b.x;
                    });
                }

                var recyclableSeries = processData(recyclableData);
                var nonRecyclableSeries = processData(nonRecyclableData);

                var options = {
                    chart: {
                        type: 'area',
                        height: 350
                    },
                    series: [
                        {
                            name: 'Recyclable',
                            data: recyclableSeries
                        },
                        {
                            name: 'Non-Recyclable',
                            data: nonRecyclableSeries
                        }
                    ],
                    xaxis: {
                        type: 'datetime',
                        title: {
                            text: 'Date and Time'
                        },
                        labels: {
                            datetimeUTC: false,
                            format: 'dd MMM HH:mm'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Predicted Level (%)'
                        },
                        min: 0,
                        max: 100
                    },
                    tooltip: {
                        shared: true,
                        x: {
                            format: 'dd MMM yyyy HH:mm'
                        },
                        y: {
                            formatter: function(value) {
                                return value !== null ? value.toFixed(2) + '%' : 'No Data';
                            }
                        }
                    },
                    markers: {
                        size: 4
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    legend: {
                        position: 'top'
                    }
                };

                var chart = new ApexCharts(chartDiv, options);
                chart.render();
            });
        }
    </script>
</body>

</html>