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
    <title>Analytics | E-Basura Monitoring System</title>
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
    <link rel="manifest" href="assets/img/site.webmanifest">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF Library -->
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
                                <canvas id="dailyWasteChart"></canvas>
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
                                <canvas id="monthlyWasteChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-transparent">
                                Yearly Waste Segregation Logs
                                <button id="exportYearly" class="btn btn-primary float-end">Export Yearly Data</button>
                            </div>
                            <div class="card-body">
                                <canvas id="yearlyWasteChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once __DIR__ . '/templates/footer.php'; ?>
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
            highlightedDays : allowedDates,
            lockDaysFilter: (date) => {
                return !allowedDates.includes(date.format('YYYY-MM-DD'));
            }
        });

        // Example data for the charts
        const dailyWasteData = [12, 19, 3, 5, 2, 3]; // Sample data for daily
        const monthlyWasteData = [65, 59, 80, 81, 56, 55, 40]; // Sample data for monthly
        const yearlyWasteData = [150, 200, 180, 220]; // Sample data for yearly

        const dailyWasteChartCtx = document.getElementById('dailyWasteChart').getContext('2d');
        const monthlyWasteChartCtx = document.getElementById('monthlyWasteChart').getContext('2d');
        const yearlyWasteChartCtx = document.getElementById('yearlyWasteChart').getContext('2d');

        // Daily Waste Chart
        const dailyWasteChart = new Chart(dailyWasteChartCtx, {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Daily Waste Segregation',
                    data: dailyWasteData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Monthly Waste Chart
        const monthlyWasteChart = new Chart(monthlyWasteChartCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Monthly Waste Segregation',
                    data: monthlyWasteData,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Yearly Waste Chart
        const yearlyWasteChart = new Chart(yearlyWasteChartCtx, {
            type: 'pie',
            data: {
                labels: ['2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'Yearly Waste Segregation',
                    data: yearlyWasteData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Yearly Waste Segregation'
                    }
                }
            }
        });

        document.getElementById('exportYearly').addEventListener('click', () => {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.text("Yearly Waste Segregation Report", 10, 10);
            doc.text("2021: " + yearlyWasteData[0], 10, 20);
            doc.text("2022: " + yearlyWasteData[1], 10, 30);
            doc.text("2023: " + yearlyWasteData[2], 10, 40);
            doc.text("2024: " + yearlyWasteData[3], 10, 50);

            doc.save("yearly_waste_report.pdf");
        });
    </script>

</body>
</html>
