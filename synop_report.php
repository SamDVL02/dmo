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
            $stmt = $conn->prepare("SELECT * FROM synop WHERE DATE(created_at) = :currentDate ORDER BY created_at DESC");
            $stmt->bindParam(':currentDate', $currentDate);
            break;
        case 'weekly':
            $stmt = $conn->prepare("SELECT * FROM synop WHERE created_at >= CURRENT_DATE - INTERVAL 7 DAY ORDER BY created_at DESC");
            break;
        case 'monthly':
            $stmt = $conn->prepare("SELECT * FROM synop WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) ORDER BY created_at DESC");
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
$datas = [];

if ($records) {
    $user_id = $_SESSION['userid'];
    
    // Fetch user's station_id
    $sql = "SELECT station_id FROM users WHERE id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $station_id = $user['station_id'];

    // Fetch station ICAO code
    $sql1 = "SELECT icao FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);

    $constant = "AAXX";
    $datePart = date('d');
    
    // Build $datas string
    foreach ($records as $record) {
        $datas[] = $constant . " " . $datePart . " " .
                   $record['time_of_observation'] . " " .
                   $record['wind_measuring_instruments'] . " " .
                   $record['indicator_for_precipitation_data'] . " " .
                   $record['station_operation_weather'] . " " .
                   $record['height_of_lowest_cloud_base'] . " " .
                   $record['visibility'] . " " .
                   $record['precipitation_duration'] . " " .
                   $record['present_weather'] . " " .
                   $record['past_weather_1'] . " " .
                   $record['past_weather_2'] . " " .
                   $record['low_level_cloud_type'] . " " .
                   $record['medium_level_cloud_type'] . " " .
                   $record['high_level_cloud_type'] . " " .
                   $record['grass_temperature'] . " " .
                   $record['character_intensity_of_precipitation'] . " " .
                   $record['hours_from_precipitation_to_observation'] . " " .
                   $record['precipitation_amount'] . " " .
                   $record['type_of_instrument_for_evaporation_measurement'] . " " .
                   $record['sunshine_card_segments'] . " " .
                   $record['cups_added_removed'] . " " .
                   $record['first_lowest_cloud_layer_type'] . " " .
                   $record['first_lowest_cloud_layer_base_height'] . " " .
                   $record['second_lowest_cloud_layer_type'] . " " .
                   $record['second_lowest_cloud_layer_base_height'] . " " .
                   $record['third_lowest_cloud_layer_type'] . " " .
                   $record['third_lowest_cloud_layer_base_height'] . " " .
                   $record['fourth_lowest_cloud_layer_type'] . " " .
                   $record['fourth_lowest_cloud_layer_base_height'] . " " .
                   $record['wind_direction'] . " " .
                   $record['wind_speed'] . " " .
                   $record['t_s_c_c'] . " " .
                   $record['f_s_c'] . " " .
                   $record['s_s_c'] . " " .
                   $record['t_s_c'] . " " .
                   $record['fo_s_c'] . " " .
                   $record['d_b_t'] . " " .
                   $record['d_p_t'] . " " .
                   $record['max_t'] . " " .
                   $record['min_t'] . " " .
                   $record['c_l_p'] . " " .
                   $record['m_s_l_p'] . " " .
                   $record['gpm'] . " " .
                   $record['t_p_24'] . " " .
                   $user_id;
    }
    
} else {
    echo "No Synop records found";
}
?>

<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DMO</title>
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
                                  
                                    <th>SYNOP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($datas)): ?>
                                <?php foreach ($datas as $data): ?>
                                        <tr>
                                        <td><b><?php echo $data ?></b></td>
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
