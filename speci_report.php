<?php
require 'inc/db.php'; 
require 'inc/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getCurrentDate() {
    return date('Y-m-d');
}

function getRecords($conn, $filter) {
    $stmt = null;

    switch($filter) {
        case 'daily':
            $currentDate = getCurrentDate();
            $stmt = $conn->prepare("SELECT * FROM speci WHERE DATE(created_at) = :currentDate");
            $stmt->bindParam(':currentDate', $currentDate);
            break;

        case 'weekly':
            $stmt = $conn->prepare("SELECT * FROM speci WHERE created_at >= CURRENT_DATE - INTERVAL 7 DAY");
            break;

        case 'monthly':
            $stmt = $conn->prepare("SELECT * FROM speci WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
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

// Start HTML output
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>SPECI</title>";
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
echo "<h1>SPECI TEXT</h1>";

// Filter form
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


    echo "<tbody>";
    foreach ($records as $record) {

        $constant = "SPECI";
        $icao = $station['icao'];
        $date = date('d');
        $time_of_observation = $record['time_of_observation'];
        $wind_direction = $record['wind_direction'];
        if(strlen($wind_direction) == 2)
        {
            $wind_direction = "0".$wind_direction;
        }
        $wind_speed = $record['wind_speed'];
        $visibility = (int)$record['visibility'];
        $oktas1 = "";
        $oktas2 = "";
        $oktas3 = "";
        $f_sign_cloud_oktas = $record['first_significant_cloud_oktas'];
        if($f_sign_cloud_oktas)
        {
            if($f_sign_cloud_oktas == 0)
            {
                $oktas1 = "SKC";
            }
            elseif($f_sign_cloud_oktas == 1 || $f_sign_cloud_oktas == 2)
            {
                $oktas1 = "FEW";
            }
            elseif($f_sign_cloud_oktas == 3 || $f_sign_cloud_oktas == 4 || $f_sign_cloud_oktas == 5)
            {
                $oktas1 = "SCT";
            }
            elseif($f_sign_cloud_oktas == 6 || $f_sign_cloud_oktas == 7)
            {
                $oktas1 = "BKN";
            }
            elseif($f_sign_cloud_oktas == 8)
            {
                $oktas1 = "OVC";
            }
        }
        $s_sign_cloud_oktas = $record['second_significant_cloud_oktas'];
        if($s_sign_cloud_oktas)
        {
            if($s_sign_cloud_oktas == 0)
            {
                $oktas2 = "SKC";
            }
            elseif($s_sign_cloud_oktas == 1 || $s_sign_cloud_oktas == 2)
            {
                $oktas2 = "FEW";
            }
            elseif($s_sign_cloud_oktas == 3 || $s_sign_cloud_oktas == 4 || $s_sign_cloud_oktas == 5)
            {
                $oktas2 = "SCT";
            }
            elseif($s_sign_cloud_oktas == 6 || $s_sign_cloud_oktas == 7)
            {
                $oktas2 = "BKN";
            }
            elseif($s_sign_cloud_oktas == 8)
            {
                $oktas2 = "OVC";
            }
        }
        $t_sign_cloud_oktas = $record['third_significant_cloud_oktas'];
        if($t_sign_cloud_oktas)
        {
            if($t_sign_cloud_oktas == 0)
            {
                $oktas3 = "SKC";
            }
            elseif($t_sign_cloud_oktas == 1 || $t_sign_cloud_oktas == 2)
            {
                $oktas3 = "FEW";
            }
            elseif($t_sign_cloud_oktas == 3 || $t_sign_cloud_oktas == 4 || $t_sign_cloud_oktas == 5)
            {
                $oktas3 = "SCT";
            }
            elseif($t_sign_cloud_oktas == 6 || $t_sign_cloud_oktas == 7)
            {
                $oktas3 = "BKN";
            }
            elseif($t_sign_cloud_oktas == 8)
            {
                $oktas3 = "OVC";
            }
        }
        $f_sign_cloud_height = (int)($record['first_significant_cloud_height']/100);
        if(strlen($f_sign_cloud_height))
        {
            $f_sign_cloud_height = "0".$f_sign_cloud_height;
        }
        $s_sign_cloud_height = (int)($record['second_significant_cloud_height']/100);
        if(strlen($s_sign_cloud_height))
        {
            $s_sign_cloud_height = "0".$s_sign_cloud_height;
        }
        $t_sign_cloud_height = (int)($record['third_significant_cloud_height']/100);
        if(strlen($t_sign_cloud_height))
        {
            $t_sign_cloud_height = "0".$t_sign_cloud_height;
        }
        
        $dry_bulb_temp = $record['dry_bulb_temperature'];
        $dew_point_temp = $record['dew_point_temperature'];
        $qnh = (int)$record['qnh_h'];
        $trend = $record['trend'];
        $remarks = $record['remarks'];


        $data = $constant ." ".$icao ." ".$date.$time_of_observation."Z"." ".$wind_direction.$wind_speed."KT"." ".$visibility." ".$oktas1.$f_sign_cloud_height." ".$oktas2.$s_sign_cloud_height." ".$oktas3.$t_sign_cloud_height." ".(int)$dry_bulb_temp."/".(int)$dew_point_temp." "."Q".$qnh." ".$trend." ".$remarks;  // Include combined data
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
