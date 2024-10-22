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
                        <?php
                        $user = new User();
                        if($user->adminAccessOnly()):
                    ?>
                        <a class="nav-link" href="monitor">Real-time Monitoring
                            <span class="badge ms-auto"><i class="fa fa-dot-circle text-danger"></i> </span>
                        </a>
                        <?php endif; ?>
                    </nav>
                </div>
                <a class="nav-link" href="forecast">
                    <div class="nav-link-icon"><i data-feather="bar-chart-2"></i></div>
                    Forecast
                </a>
                <a class="nav-link" href="reports">
                    <div class="nav-link-icon"><i data-feather="book"></i></div>
                    Reports
                </a>
                <?php    if($user->adminAccessOnly()): ?>
                <a class="nav-link" href="logs">
                    <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                    Logs
                </a>
                <a class="nav-link" href="system-health">
                    <div class="nav-link-icon"><i data-feather="refresh-cw"></i></div>
                    System Health
                </a>
                <?php endif; ?>

                <!-- Sidenav Heading (Addons)-->
                <div class="sidenav-menu-heading">Configuration</div>
                <!-- Sidenav Link (Charts)-->

                <a class="nav-link" href="account-settings">
                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                    Account Settings
                </a>

                <?php
                    if($user->adminAccessOnly()):
                ?>
                <div class="sidenav-menu-heading">Admin Configuration</div>
                <!-- Sidenav Link (Tables)-->
                <a class="nav-link" href="user-settings">
                    <div class="nav-link-icon"><i class="fa fa-user-cog"></i></div>
                    Users Settings
                </a>

                <a class="nav-link" href="system-settings">
                    <div class="nav-link-icon"><i data-feather="tool"></i></div>
                    System Settings
                </a>
                <?php endif; ?>
               
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