<?php
require 'inc/db.php';
require 'inc/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userid = $_SESSION['userid'];

function getCurrentDate() {
    return date('Y-m-d');
}

function getRecords($conn, $filter, $userid) {
    $stmt = null;

    switch ($filter) {
        case 'daily':
            $currentDate = getCurrentDate();
            $stmt = $conn->prepare("SELECT * FROM metar WHERE DATE(created_at) = :currentDate");
            $stmt->bindParam(':currentDate', $currentDate);
            break;

        case 'weekly':
            $stmt = $conn->prepare("SELECT * FROM metar WHERE created_at >= CURRENT_DATE - INTERVAL 7 DAY");
            break;

        case 'monthly':
            $stmt = $conn->prepare("SELECT * FROM metar WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
            break;
    }

    if ($stmt) {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

$filter = isset($_POST['filter']) ? $_POST['filter'] : 'daily';
$records = getRecords($conn, $filter, $userid);
$date = getCurrentDate();

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Records for $date</title>";
echo "<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
        color: #4CAF50;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        transition: transform 0.3s ease;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: white;
        transition: background-color 0.3s ease;
    }
    tr:hover {
        background-color: #f1f1f1;
        transform: scale(1.02);
    }
    tr {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:nth-child(odd) {
        background-color: #fff;
    }
    select {
        margin-bottom: 20px;
        padding: 10px;
        font-size: 16px;
    }
</style>";
echo "</head>";
echo "<body>";
echo "<h1>Metar Report</h1>";
echo "<form method='POST' action=''>";
echo "<label for='filter'>Filter by:</label>";
echo "<select name='filter' id='filter' onchange='this.form.submit()'>";
echo "<option value='daily'" . ($filter === 'daily' ? ' selected' : '') . ">Daily</option>";
echo "<option value='weekly'" . ($filter === 'weekly' ? ' selected' : '') . ">Weekly</option>";
echo "<option value='monthly'" . ($filter === 'monthly' ? ' selected' : '') . ">Monthly</option>";
echo "</select>";
echo "</form>";

echo "<table>";
echo "<thead><tr>";
echo "<th>Metar Data</th>";
echo "</tr></thead>";

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

    function getOktas($oktas) {
        if ($oktas === null) return "";
        if ($oktas == 0) return "SKC";
        if ($oktas <= 2) return "FEW";
        if ($oktas <= 5) return "SCT";
        if ($oktas <= 7) return "BKN";
        return "OVC";
    }

    echo "<tbody>";
    foreach ($records as $record) {
        $constant = "METOR";
        $icao = $station['icao'];
        $date = date('d');
        $time_of_observation = $record['time_of_observation'];
        $wind_direction = str_pad($record['wind_direction'], 3, "0", STR_PAD_LEFT);
        $wind_speed = $record['wind_speed'];
        $visibility = (int)$record['visibility'];
        $dry_bulb_temp = $record['dry_bulb_temperature'];
        $dew_point_temp = $record['dew_point_temperature'];
        $qnh = (int)$record['qnh_hpa'];
        $trend = $record['trend'];
        $remarks = $record['remarks'];

        

        $oktas1 = getOktas($record['first_significant_cloud_oktas']);
        $oktas2 = getOktas($record['second_significant_cloud_oktas']);
        $oktas3 = getOktas($record['third_significant_cloud_oktas']);

        $f_sign_cloud_height = str_pad((int)($record['first_significant_cloud_height'] / 100), 3, "0", STR_PAD_LEFT);
        $s_sign_cloud_height = str_pad((int)($record['second_significant_cloud_height'] / 100), 3, "0", STR_PAD_LEFT);
        $t_sign_cloud_height = str_pad((int)($record['third_significant_cloud_height'] / 100), 3, "0", STR_PAD_LEFT);

        $data = $constant . " " . $icao . " " . $date . $time_of_observation . "Z " . $wind_direction . $wind_speed . "KT " .
            $visibility . " " . $oktas1 . $f_sign_cloud_height . " " . $oktas2 . $s_sign_cloud_height . " " .
            $oktas3 . $t_sign_cloud_height . " " . (int)$dry_bulb_temp . "/" . (int)$dew_point_temp . " " . "Q" . $qnh . " " . $trend . " " . $remarks;

        echo "<tr>";
        echo "<td><b>" . htmlspecialchars($data) . "</b></td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No records found for the specified date.";
}

echo "</body></html>";
?>
