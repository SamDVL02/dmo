<?php 
include "inc/header.php";
include "inc/db.php";

$user_id = $_SESSION['userid'];

// Prepare and execute the first query to get the station_id
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data was fetched
if ($user) {
    $station_id = $user['station_id'];

    // Prepare and execute the second query to get the station name
    $sql1 = "SELECT name FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Check if station data was fetched
    if ($station) {
        $name = $station['name'];
    } else {
        $name = 'Unknown Station'; // Default value if station is not found
    }
} else {
    $name = 'Unknown Station'; // Default value if user is not found
}

 ?>
<!-- Preloader Start Here -->
<!-- <div id="preloader"></div> -->
<!-- Preloader End Here -->


<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/account-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:34:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DMO</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    <?php include "inc/navbar.php" ?>
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <?php include "inc/sidebar.php" ?>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcrumbs Area Start Here -->
            <div class="breadcrumbs-area">
               
            </div>
            <!-- Breadcrumbs Area End Here -->
            <!-- Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><b><?php
                            if($_SESSION['role'] == "admin"){
                                echo "All";
                            }
                            else
                             {
                                echo $name;
                             }
                             ?> Speci Report Records</b></h3>
                        
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Observation Time</th>
                                    <th>Wind Direction</th>
                                    <th>Wind Speed</th>
                                    <th>Visibility</th>
                                    <th>Present Weather</th>
                                    <th>Total Sky Cloud Cover</th>
                                    <th>1st Significant Cloud Oktas</th>
                                    <th>1st Significant Cloud Height</th>
                                    <th>2nd Significant Cloud Oktas</th>
                                    <th>2nd Significant Cloud Height</th>
                                    <th>2nd Individual Cloud Layer Type</th>
                                    <th>3rd Significant Cloud Oktas</th>
                                    <th>3rd Significant Cloud Height</th>
                                    <th>4th Significant Cloud Oktas</th>
                                    <th>4th Significant Cloud Height</th>
                                    <th>Dry Bulb Temperature</th>
                                    <th>Dew Point Temperature</th>
                                    <th>QNH (H)</th>
                                    <th>QNH (W)</th>
                                    <th>CLP</th>
                                    <th>Wet Bulb Temperature</th>
                                    <th>Trend</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                           
    $user_id = $_SESSION['userid'];
    $id = 0;

    try {
        if ($_SESSION['role'] == "admin") {
            $sql = "SELECT * FROM speci";
        } else {
            $sql = "SELECT * FROM speci WHERE user_id = :user_id";
        }

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
                                <td><?php echo $id ?></td>
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
            <td><?php echo htmlspecialchars($rows['qnh_h']); ?></td>
            <td><?php echo htmlspecialchars($rows['qnh_w']); ?></td>
            <td><?php echo htmlspecialchars($rows['clp']); ?></td>
            <td><?php echo htmlspecialchars($rows['wet_bulb_temperature']); ?></td>
            <td><?php echo htmlspecialchars($rows['trend']); ?></td>
            <td><?php echo htmlspecialchars($rows['remarks']); ?></td>
                                    <!-- <td>
                                        <a href="csv.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success">Download</a> -->
                                    <!-- </td> -->
                                    <td>
                                        <a href="editspci.php?id=<?php echo htmlspecialchars($rows['id'], ENT_QUOTES, 'UTF-8'); ?>"><span class="btn btn-warning">Edit</span></a>
                                        <?php if ($_SESSION["role"] == "super-user" || $_SESSION["role"] == "admin"): ?>
                                            <a href="deletespeci.php?id=<?php echo htmlspecialchars($rows['id'], ENT_QUOTES, 'UTF-8'); ?>"><span class="btn btn-danger">Delete</span></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . htmlspecialchars($e->getMessage());
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Area End Here -->
        </div>
    </div>
    <!-- Page Area End Here -->
</div>

<!-- jquery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Scroll Up Js -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- Data Table Js -->
<script src="js/jquery.dataTables.min.js"></script>
<!-- Custom Js -->
<script src="js/main.js"></script>

</body>

</html>
