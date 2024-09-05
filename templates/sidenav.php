<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="bell"></i></div>
                    Alerts
                    <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                </a>
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Messages
                    <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                </a>
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Home</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                        <a class="nav-link" href="index.php">
                            Overview
                        </a>
                        <a class="nav-link" href="monitor.php">Real-time Monitoring
                            <span class="badge ms-auto"><i class="fa fa-dot-circle text-danger"></i> </span>
                        </a>
                    </nav>
                </div>
                <a class="nav-link" href="analytics.php">
                    <div class="nav-link-icon"><i data-feather="bar-chart-2"></i></div>
                    Analytics
                </a>
                <a class="nav-link" href="reports.php">
                    <div class="nav-link-icon"><i data-feather="book"></i></div>
                    Reports
                </a>

                <!-- Sidenav Heading (Addons)-->
                <div class="sidenav-menu-heading">Configuration</div>
                <!-- Sidenav Link (Charts)-->
                <a class="nav-link" href="logs.php">
                    <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                    Logs
                </a>
                <a class="nav-link" href="account-settings.php">
                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                    Account Settings
                </a>
                <!-- Sidenav Link (Tables)-->
                <a class="nav-link" href="system-settings.php">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    System Settings
                </a>
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">
                    <?php
                    if (!empty($u['first_name']) && !empty($u['last_name'])) {
                        echo $u['first_name'] . ' ' . $u['last_name'];
                    } else {
                        echo $u['username'];
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</div>