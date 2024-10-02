<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="index.html"><img src="img/logo1.png" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">
            <li class="nav-item sidebar-nav-item">
                <a href="index.php" class="nav-link">
                    <i class="fas fa-chart-line"></i><span>Dashboard</span>
                </a>
            </li>

            <?php if ($_SESSION["role"] == "admin"): ?>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="fas fa-home"></i><span>Stations</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item"><a href="register.php" class="nav-link"><i class="fas fa-plus"></i> Register</a></li>
                        <li class="nav-item"><a href="view.php" class="nav-link"><i class="fas fa-eye"></i> View</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            <?php if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "super-user") : ?>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="fas fa-users"></i><span>Users</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item"><a href="users.php" class="nav-link"><i class="fas fa-user-plus"></i> Register</a></li>
                        <li class="nav-item"><a href="all-users.php" class="nav-link"><i class="fas fa-users"></i> View</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="fas fa-eye"></i><span>Observatory (OBS)</span></a>
                <ul class="nav sub-group-menu">
                    <?php if (in_array($_SESSION["role"], ["admin", "user", "super-user"])): ?>
                        <li class="nav-item"><a href="metar.php" class="nav-link"><i class="fas fa-file-alt"></i> Meta Generate Report Interface</a></li>
                        <li class="nav-item"><a href="synop.php" class="nav-link"><i class="fas fa-file-alt"></i> Synop Generate Report Interface</a></li>
                        <li class="nav-item"><a href="speci.php" class="nav-link"><i class="fas fa-file-alt"></i> Speci Generate Report Interface</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="view_metar_data.php" class="nav-link"><i class="fas fa-eye"></i> View Station Metar</a></li>
                    <li class="nav-item"><a href="view_daily_metar.php" class="nav-link"><i class="fas fa-eye"></i> Metar (TXT)</a></li>
                    <li class="nav-item"><a href="view_synop_data.php" class="nav-link"><i class="fas fa-eye"></i> View Station SYNOP</a></li>
                    <li class="nav-item"><a href="synop_report.php" class="nav-link"><i class="fas fa-eye"></i> Synop (TXT)</a></li>
                    <li class="nav-item"><a href="all-speci.php" class="nav-link"><i class="fas fa-eye"></i> View Station Speci</a></li>
                    <li class="nav-item"><a href="speci_report.php" class="nav-link"><i class="fas fa-eye"></i> Speci (TXT)</a></li>
                </ul>
            </li>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="fas fa-calendar-day"></i><span>Terminal Aerodrome Forecast (TAF)</span></a>
                <ul class="nav sub-group-menu">
                    <?php if (in_array($_SESSION["role"], ["admin", "user", "super-user"])): ?>
                        <li class="nav-item"><a href="autogen_taf.php" class="nav-link"><i class="fas fa-robot"></i> Auto Generate TAF</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="view_taf.php" class="nav-link"><i class="fas fa-eye"></i> View Achieved TAF Parameter</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-eye"></i> View Temperature Trend</a></li>
                    <li class="nav-item"><a href="view_pressure_trend.php" class="nav-link"><i class="fas fa-eye"></i> View Pressure Trend</a></li>
                </ul>
            </li>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Status Monitoring</span></a>
                <ul class="nav sub-group-menu">
                    <?php if (in_array($_SESSION["role"], ["admin", "user", "super-user"])): ?>
                        <li class="nav-item"><a href="collection.php" class="nav-link"><i class="fas fa-cloud-showers-heavy"></i> Collection of Severe Weather Event</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="view_severe.php" class="nav-link"><i class="fas fa-cloud-showers-heavy"></i> View Reported Severe Weather Element</a></li>
                </ul>
            </li>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="fas fa-sun"></i><span>Climate Data Monitoring</span></a>
                <ul class="nav sub-group-menu">
                    <?php if (in_array($_SESSION["role"], ["admin", "user", "super-user"])): ?>
                        <li class="nav-item"><a href="collection.php" class="nav-link"><i class="fas fa-cloud-showers-heavy"></i> Collection of Severe Weather Event</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="view_severe.php" class="nav-link"><i class="fas fa-cloud-showers-heavy"></i> View Reported Severe Weather Element</a></li>
                </ul>
            </li>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="fas fa-seedling"></i><span>Agromet Data Collection</span></a>
                <ul class="nav sub-group-menu">
                    <?php if (in_array($_SESSION["role"], ["admin", "user", "super-user"])): ?>
                        <li class="nav-item"><a href="agro.php" class="nav-link"><i class="fas fa-calendar-day"></i> 602 Daily Weather Observation</a></li>
                        <li class="nav-item"><a href="agro1.php" class="nav-link"><i class="fas fa-calendar-day"></i> AGRO 1 Crop Field Observation</a></li>
                        <li class="nav-item"><a href="agro2.php" class="nav-link"><i class="fas fa-calendar-day"></i> AGRO 2 Perennial Crop with Pattern</a></li>
                        <li class="nav-item"><a href="agro3.php" class="nav-link"><i class="fas fa-calendar-day"></i> AGRO 3 Perennial Crop without Pattern</a></li>
                        <li class="nav-item"><a href="soil_temp.php" class="nav-link"><i class="fas fa-temperature-low"></i> 509b Soil Temperature 0600UTC</a></li>
                        <li class="nav-item"><a href="soil_temp2.php" class="nav-link"><i class="fas fa-temperature-low"></i> 509b Soil Temperature 1200UTC</a></li>
                        <li class="nav-item"><a href="soil_temp3.php" class="nav-link"><i class="fas fa-tint"></i> AGGRo 5 Soil Moisture</a></li>
                        <li class="nav-item"><a href="dekad.php" class="nav-link"><i class="fas fa-calendar-week"></i> Dekad Field Status</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="view_agro.php" class="nav-link"><i class="fas fa-eye"></i> View 602 Daily Weather Observation</a></li>
                    <li class="nav-item"><a href="view_agro1.php" class="nav-link"><i class="fas fa-eye"></i> View AGRO 1 Crop Field Observation</a></li>
                    <li class="nav-item"><a href="view_agro2.php" class="nav-link"><i class="fas fa-eye"></i> View AGRO 2 Perennial Crop with Pattern</a></li>
                    <li class="nav-item"><a href="view_agro3.php" class="nav-link"><i class="fas fa-eye"></i> View AGRO 3 Perennial Crop without Pattern</a></li>
                    <li class="nav-item"><a href="view_soil_temp.php" class="nav-link"><i class="fas fa-eye"></i> View 509b Soil Temperature 0600UTC</a></li>
                    <li class="nav-item"><a href="view_soil_temp2.php" class="nav-link"><i class="fas fa-eye"></i> View 509b Soil Temperature 1200UTC</a></li>
                    <li class="nav-item"><a href="view_soil_temp3.php" class="nav-link"><i class="fas fa-eye"></i> View AGGRo 5 Soil Moisture</a></li>
                    <li class="nav-item"><a href="view_dekad.php" class="nav-link"><i class="fas fa-eye"></i> View Dekad Field Status</a></li>
                </ul>
            </li>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="fas fa-info-circle"></i><span>Other Supporting Info.</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item"><a href="maintainance.php" class="nav-link"><i class="fas fa-sun"></i> Ward/District Sunrise/Sunset</a></li>
                    <li class="nav-item"><a href="maintainance.php" class="nav-link"><i class="fas fa-sun"></i> Regional Sunrise/Sunset</a></li>
                    <li class="nav-item"><a href="maintainance.php" class="nav-link"><i class="fas fa-sun"></i> Global Sunrise</a></li>
                    <li class="nav-item"><a href="maintainance.php" class="nav-link"><i class="fas fa-map-marker-alt"></i> Google Navigator</a></li>
                </ul>
            </li>

            <?php if (in_array($_SESSION["role"], ["mcc", "mcto", "dg", "cfo", "data", "dra"])): ?>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i><span>Returns</span></a>
                </li>
            <?php endif; ?>

            <?php if ($_SESSION["role"] == "admin"): ?>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i><span>Logs</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item"><a href="all-speci.php" class="nav-link"><i class="fas fa-eye"></i> View Station Logs</a></li>
                        <li class="nav-item"><a href="view_metar_data.php" class="nav-link"><i class="fas fa-eye"></i> View User Logs</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
