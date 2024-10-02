<?php 
include "inc/header.php";
include "inc/db.php";

// Ensure user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid'];

// Prepare and execute the first query to get the station_id
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize station name
$name = 'Unknown Station'; 

// Check if user data was fetched
if ($user) {
    $station_id = $user['station_id'];

    // Prepare and execute the second query to get the station name
    $sql1 = "SELECT name FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Set station name if found
    if ($station) {
        $name = $station['name'];
    }
}

?>

<!doctype html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITAL METEOROLOGICAL OBSERVATORY</title>
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
    <?php include "inc/navbar.php"; ?>
    <div class="dashboard-page-one">
        <?php include "inc/sidebar.php"; ?>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area"></div>
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><b><?php echo ($_SESSION['role'] == "admin") ? "All" : $name; ?> Metar Report Records</b></h3>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Time of Observation</th>
                                    <th>Wind Direction</th>
                                    <th>Wind Speed</th>
                                    <th>Visibility</th>
                                    <th>Present Weather</th>
                                    <th>Total Sky Cloud Cover</th>
                                    <th>First Significant Cloud Oktas</th>
                                    <th>First Significant Cloud Height</th>
                                    <th>Second Significant Cloud Oktas</th>
                                    <th>Second Significant Cloud Height</th>
                                    <th>Second Individual Cloud Layer Type</th>
                                    <th>Third Significant Cloud Oktas</th>
                                    <th>Third Significant Cloud Height</th>
                                    <th>Fourth Significant Cloud Oktas</th>
                                    <th>Fourth Significant Cloud Height</th>
                                    <th>Dry Bulb Temperature</th>
                                    <th>Dew Point Temperature</th>
                                    <th>Maximum Temperature</th>
                                    <th>Minimum Temperature</th>
                                    <th>QNH (H)</th>
                                    <th>QNH (W)</th>
                                    <th>CLP (H)</th>
                                    <th>MSLP</th>
                                    <th>GPM</th>
                                    <th>Vapor Pressure</th>
                                    <th>Relative Humidity</th>
                                    <th>Wet Bulb Temperature</th>
                                    <th>Gun Bellean Reset Value</th>
                                    <th>Gun Bellean Read Value</th>
                                    <th>Wind Run</th>
                                    <th>Total Precipitation (Past 24 hours)</th>
                                    <th>Trend</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                    <th>Metar</th>
                                </tr>
                            </thead>

                            <tbody>
    <?php
    $id = 0;
    try {
        // Adjust query based on user role
        $sql = ($_SESSION['role'] == "admin") 
            ? "SELECT * FROM metar" 
            : "SELECT * FROM metar WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        
        // Bind parameter only if the user is not an admin
        if ($_SESSION['role'] != "admin") {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }

        $stmt->execute();

        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id++;
    ?>
            <tr>
                <td><?php echo htmlspecialchars($id); ?></td>
                <td><?php echo htmlspecialchars($rows['time_of_observation']); ?></td>
                <td><?php echo htmlspecialchars($rows['wind_direction']); ?></td>
                <td><?php echo htmlspecialchars($rows['wind_speed']); ?></td>
                <td><?php echo htmlspecialchars($rows['visibility']); ?></td>
                <td><?php echo htmlspecialchars($rows['present_weather']); ?></td>
                <td><?php echo htmlspecialchars($rows['total_sky_cloud_cover']); ?></td>
                <td><?php echo htmlspecialchars($rows['first_significant_cloud_oktas']); ?></td>
                <td><?php echo htmlspecialchars($rows['first_significant_cloud_height']); ?></td>
                <td><?php echo htmlspecialchars($rows['second_significant_cloud_oktas']); ?></td>
                <td><?php echo htmlspecialchars($rows['second_significant_cloud_height']); ?></td>
                <td><?php echo htmlspecialchars($rows['second_individual_cloud_layer_type']); ?></td>
                <td><?php echo htmlspecialchars($rows['third_significant_cloud_oktas']); ?></td>
                <td><?php echo htmlspecialchars($rows['third_significant_cloud_height']); ?></td>
                <td><?php echo htmlspecialchars($rows['fourth_significant_cloud_oktas']); ?></td>
                <td><?php echo htmlspecialchars($rows['fourth_significant_cloud_height']); ?></td>
                <td><?php echo htmlspecialchars($rows['dry_bulb_temperature']); ?></td>
                <td><?php echo htmlspecialchars($rows['dew_point_temperature']); ?></td>
                <td><?php echo htmlspecialchars($rows['max_temperature']); ?></td>
                <td><?php echo htmlspecialchars($rows['min_temperature']); ?></td>
                <td><?php echo htmlspecialchars($rows['qnh_hpa']); ?></td>
                <td><?php echo htmlspecialchars($rows['qnh_whole']); ?></td>
                <td><?php echo htmlspecialchars($rows['c_l_p']); ?></td>
                <td><?php echo htmlspecialchars($rows['mslp']); ?></td>
                <td><?php echo htmlspecialchars($rows['gpm']); ?></td>
                <td><?php echo htmlspecialchars($rows['vapor_pressure']); ?></td>
                <td><?php echo htmlspecialchars($rows['relative_humidity']); ?></td>
                <td><?php echo htmlspecialchars($rows['wet_bulb_temperature']); ?></td>
                <td><?php echo htmlspecialchars($rows['g_reset']); ?></td>
                <td><?php echo htmlspecialchars($rows['g_read']); ?></td>
                <td><?php echo htmlspecialchars($rows['wind_run']); ?></td>
                <td><?php echo htmlspecialchars($rows['total_precipitation_24h']); ?></td>
                <td><?php echo htmlspecialchars($rows['trend']); ?></td>
                <td><?php echo htmlspecialchars($rows['remarks']); ?></td>
                <td>
                    <a href="editmetar.php?id=<?php echo htmlspecialchars($rows['id']); ?>">
                        <span class="btn btn-warning">Edit</span>
                    </a>
                    <?php if ($_SESSION["role"] == "super-user" || $_SESSION["role"] == "admin") { ?>
                        <a href="deletemetor.php?id=<?php echo htmlspecialchars($rows['id']); ?>">
                            <span class="btn btn-danger">Delete</span>
                        </a>
                    <?php } ?>
                </td>
                <td>
                    <a href="pdf_metar.php?id=<?php echo htmlspecialchars($rows['id']); ?>" class="btn btn-success">Download</a>
                </td>
            </tr>
    <?php
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='100%'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    }
    ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jquery-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
