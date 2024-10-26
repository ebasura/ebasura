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
        #loader {
    text-align: center;
    margin-top: 20px;
        }

        .spinner {
            margin: 0 auto;
            width: 50px;
            height: 50px;
            border: 5px solid lightgray;
            border-top: 5px solid #1E90FF; /* Blue color */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        #loader p {
            font-size: 18px;
            margin-top: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
                                 <div id="loader" style="display: none;">
                                    <div class="spinner"></div>
                                    <p>Loading data, please wait...</p>
                                </div>

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
        <script src="bootstrap.php"></script>
        <script>
    // Define the API endpoint
    var apiEndpoint = `${bitress.Http.api_url}/api/forecast`;

    // Maximum number of retries
    var maxRetries = 5;

    // Initial delay before retrying (in milliseconds)
    var retryDelay = 2000; // 2 seconds

    // Show the loader initially
    document.getElementById('loader').style.display = 'block';

    // Function to check if the endpoint is available
    function checkEndpointAvailability(url) {
        return fetch(url, { method: 'HEAD' })
            .then(function(response) {
                return response.ok;
            })
            .catch(function(error) {
                return false;
            });
    }

    // Function to wait for the endpoint to become available
    function waitForEndpoint(url, retries, delay) {
        return new Promise(function(resolve, reject) {
            function attempt() {
                checkEndpointAvailability(url).then(function(isAvailable) {
                    if (isAvailable) {
                        resolve();
                    } else if (retries > 0) {
                        console.log(`Endpoint not available. Retrying in ${delay / 1000} seconds...`);
                        setTimeout(function() {
                            retries--;
                            delay *= 2; // Exponential backoff
                            attempt();
                        }, delay);
                    } else {
                        reject(new Error('API endpoint is not available after multiple attempts.'));
                    }
                });
            }
            attempt();
        });
    }

    // Main function to fetch data and render charts
    function fetchDataAndRenderCharts() {
        // Fetch data from the API
        fetch(apiEndpoint)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(function(data) {
                // Hide the loader
                document.getElementById('loader').style.display = 'none';

                // Proceed with data processing and chart rendering
                renderCharts(data);
            })
            .catch(function(error) {
                console.error('There was a problem with the fetch operation:', error);
                document.getElementById('loader').style.display = 'none';
                alert('Unable to fetch data from the API. Please try again later.');
            });
    }

    // Call waitForEndpoint and then fetch data and render charts
    waitForEndpoint(apiEndpoint, maxRetries, retryDelay)
        .then(function() {
            // Endpoint is available, proceed to fetch data and render charts
            fetchDataAndRenderCharts();
        })
        .catch(function(error) {
            console.error(error.message);
            document.getElementById('loader').style.display = 'none';
            alert('API endpoint is not available. Please try again later.');
        });

    // Function to render charts
    function renderCharts(data) {
        var chartsDiv = document.getElementById('forecastCharts');

        // Clear any existing charts (optional)
        chartsDiv.innerHTML = '';

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

            // Create card container
            var containerDiv = document.createElement('div');
            containerDiv.className = 'card mb-4';

            // Create card header with bin name
            var cardHeader = document.createElement('div');
            cardHeader.className = 'card-header text-center';

            var heading = document.createElement('h5');
            heading.className = 'card-title';
            heading.className = 'text-white';
            heading.textContent = binName;
            cardHeader.appendChild(heading);
            containerDiv.appendChild(cardHeader);

            // Create card body for the chart
            var cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            var chartDiv = document.createElement('div');
            chartDiv.id = 'chart' + index;
            cardBody.appendChild(chartDiv);
            containerDiv.appendChild(cardBody);

            chartsDiv.appendChild(containerDiv);

            // Function to parse date and time into a timestamp
            function parseDateTime(dateStr, timeStr) {
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
                    height: 350,
                    animations: {
                        enabled: false
                    },
                    zoom: {
                        enabled: false
                    }
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
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width: 1
                },
                markers: {
                    size: 1 // Disable markers
                },
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
                legend: {
                    position: 'top'
                }
            };

            // Create a function to render a chart when it's visible
            function lazyLoadChart(chartDiv, options) {
                var observer = new IntersectionObserver(function(entries) {
                    if (entries[0].isIntersecting) {
                        var chart = new ApexCharts(chartDiv, options);
                        chart.render();
                        observer.disconnect(); // Stop observing after rendering
                    }
                });
                observer.observe(chartDiv);
            }

            // Use the function when creating chart divs
            lazyLoadChart(chartDiv, options);
        });
    }

    </script>
</body>

</html>