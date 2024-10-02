<?php

include "inc/header.php";
include "inc/db.php";

if (!isset($_SESSION['userid']) || !isset($_SESSION['role'])) {
    die("User is not logged in.");
}
$role = ucfirst($_SESSION['role']);
try {
    $user_id = $_SESSION['userid'];
    $sql = "SELECT station_id FROM users WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        throw new Exception("User not found.");
    }
    $station_id = $user['station_id'];
    $sqlTotalUsers = "SELECT COUNT(*) AS total_users FROM users";
    $stmtTotalUsers = $conn->prepare($sqlTotalUsers);
    $stmtTotalUsers->execute();
    $resultTotalUsers = $stmtTotalUsers->fetch(PDO::FETCH_ASSOC);
    $totalUsers = $resultTotalUsers['total_users'];
    $sqlStationUsers = "SELECT COUNT(*) AS user_count FROM users WHERE station_id = :station_id";
    $stmtStationUsers = $conn->prepare($sqlStationUsers);
    $stmtStationUsers->execute(['station_id' => $station_id]);
    $resultStationUsers = $stmtStationUsers->fetch(PDO::FETCH_ASSOC);
    $user_count = $resultStationUsers['user_count'];
    $sqlTotalStations = "SELECT COUNT(*) AS total_stations FROM station";
    $stmtTotalStations = $conn->prepare($sqlTotalStations);
    $stmtTotalStations->execute();
    $resultTotalStations = $stmtTotalStations->fetch(PDO::FETCH_ASSOC);
    $totalStations = $resultTotalStations['total_stations'];
    $sqlActiveUsersStation = "SELECT COUNT(*) AS active_users_station 
                              FROM users 
                              WHERE station_id = :station_id AND is_online = 1";
    $stmtActiveUsersStation = $conn->prepare($sqlActiveUsersStation);
    $stmtActiveUsersStation->execute(['station_id' => $station_id]);
    $resultActiveUsersStation = $stmtActiveUsersStation->fetch(PDO::FETCH_ASSOC);
    $activeUsersStation = $resultActiveUsersStation['active_users_station'];
    $sqlActiveUsersTotal = "SELECT COUNT(*) AS active_users_total 
                            FROM users 
                            WHERE is_online = 1";
    $stmtActiveUsersTotal = $conn->prepare($sqlActiveUsersTotal);
    $stmtActiveUsersTotal->execute();
    $resultActiveUsersTotal = $stmtActiveUsersTotal->fetch(PDO::FETCH_ASSOC);
    $activeUsersTotal = $resultActiveUsersTotal['active_users_total'];

} catch (PDOException $e) {
    echo "Database Error: " . htmlspecialchars($e->getMessage());
} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DMO</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/datepicker.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include "inc/navbar.php"; ?>
        <div class="dashboard-page-one">
            <?php include "inc/sidebar.php"; ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                </div>
                <div class="row gutters-20">
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-green">
                                        <i class="fas fa-house-user text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Stations</div>
                                        <div class="item-number">
                                            <span class="counter"
                                                data-num="<?php echo htmlspecialchars($totalStations); ?>">
                                                <?php echo htmlspecialchars($totalStations); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="fas fa-users text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Users</div>
                                        <div class="item-number">
                                            <span class="counter"
                                                data-num="<?php echo htmlspecialchars($totalUsers); ?>">
                                                <?php echo htmlspecialchars($totalUsers); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="fas fa-users text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Station Users</div>
                                        <div class="item-number">
                                            <span class="counter"
                                                data-num="<?php echo htmlspecialchars($user_count); ?>">
                                                <?php echo htmlspecialchars($user_count); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="fas fa-user-check text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Active Users</div>
                                        <div class="item-number">
                                            <span class="counter"
                                                data-num="<?php echo htmlspecialchars($activeUsersTotal); ?>">
                                                <?php echo htmlspecialchars($activeUsersTotal); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="fas fa-user-check text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Station Active Users</div>
                                        <div class="item-number">
                                            <span class="counter"
                                                data-num="<?php echo htmlspecialchars($activeUsersStation); ?>">
                                                <?php echo htmlspecialchars($activeUsersStation); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>