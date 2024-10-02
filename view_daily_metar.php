<?php
require 'inc/db.php'; 
include "inc/header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getCurrentDate() {
    return date('Y-m-d');
}

function getRecords($conn, $filter) {
    $stmt = null;

    switch ($filter) {
        case 'daily':
            $currentDate = getCurrentDate();
            $stmt = $conn->prepare("SELECT * FROM metar WHERE DATE(created_at) = :currentDate ORDER BY created_at DESC");
            $stmt->bindParam(':currentDate', $currentDate);
            break;

        case 'weekly':
            $stmt = $conn->prepare("SELECT * FROM metar WHERE created_at >= CURRENT_DATE - INTERVAL 7 DAY ORDER BY created_at DESC");
            break;

        case 'monthly':
            $stmt = $conn->prepare("SELECT * FROM metar WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) ORDER BY created_at DESC");
            break;
    }

    if ($stmt) {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

$filter = isset($_POST['filter']) ? $_POST['filter'] : 'daily';
$records = getRecords($conn, $filter);
$date = getCurrentDate();

$datas = []; // Initialize the data array

if ($records) {
    $user_id = $_SESSION['userid'];

    $sql = "SELECT station_id FROM users WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $station_id = $user['station_id'];

    $sql1 = "SELECT icao FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);

    foreach ($records as $record) {
        $constant = "METAR";
        $icao = $station['icao'];
        $time_of_observation = $record['time_of_observation'];
        $wind_direction = str_pad($record['wind_direction'], 2, '0', STR_PAD_LEFT);
        $wind_speed = $record['wind_speed'];
        $visibility = (int)$record['visibility'];

        // Cloud okta and height calculations
        $oktas = [];
        $cloud_heights = [];

        for ($i = 1; $i <= 3; $i++) {
            // Construct the column names
            $okta_key = "{$i}_significant_cloud_oktas";
            $height_key = "{$i}_significant_cloud_height";

            $f_sign_cloud_oktas = $record[$okta_key] ?? null;
            $oktas[] = match($f_sign_cloud_oktas) {
                0 => "SKC",
                1, 2 => "FEW",
                3, 4, 5 => "SCT",
                6, 7 => "BKN",
                8 => "OVC",
                default => "N/A"
            };

            $cloud_height = (int)($record[$height_key] ?? 0) / 100;
            $cloud_heights[] = str_pad($cloud_height, 2, '0', STR_PAD_LEFT);
        }

        $dry_bulb_temp = (int)$record['dry_bulb_temperature'];
        $dew_point_temp = (int)$record['dew_point_temperature'];
        $qnh = (int)$record['qnh_hpa'];
        $trend = $record['trend'];
        $remarks = $record['remarks'];
        $id = $record['id']; // Get the ID of the record

        // Combine data into a single string
        $metar = sprintf(
            "%s %s %s%sZ %s%sKT %d %s%s %s%s %s%s %d/%d Q%d %s %s\n",
            $constant, $icao, $date, $time_of_observation,
            $wind_direction, $wind_speed, $visibility,
            $oktas[0], $cloud_heights[0],
            $oktas[1], $cloud_heights[1],
            $oktas[2], $cloud_heights[2],
            $dry_bulb_temp, $dew_point_temp, $qnh, $trend, $remarks
        );

        // Append the ID and $metar string to the $datas array
        $datas[] = ['id' => $id, 'data' => $metar];
    }
} else {
    $datas[] = ['id' => null, 'data' => "No records found for the specified date."];
}
?>

<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITAL METEOROLOGICAL OBSERVATORY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
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
    <?php include "inc/navbar.php" ?>
    <div class="dashboard-page-one">
        <?php include "inc/sidebar.php" ?>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area"></div>
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title"></div>
                    </div>
                    <div class="table-responsive">
                        <form method='POST' action=''>
                            <label for='filter'>Filter by:</label>
                            <select name='filter' id='filter' onchange='this.form.submit()'>
                                <option value='daily' <?= $filter === 'daily' ? 'selected' : '' ?>>Daily</option>
                                <option value='weekly' <?= $filter === 'weekly' ? 'selected' : '' ?>>Weekly</option>
                                <option value='monthly' <?= $filter === 'monthly' ? 'selected' : '' ?>>Monthly</option>
                            </select>
                        </form>
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>METAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($datas)): ?>
                                    <?php foreach ($datas as $item): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['id']) ?></td>
                                            <td><b><?= nl2br(htmlspecialchars($item['data'])) ?></b></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2">No records found for the specified date.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
