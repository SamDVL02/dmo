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
    <title>DMO</title>
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
                            <h3><b><?php echo ($_SESSION['role'] == "admin") ? "All" : $name; ?> Crop Records</b></h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Crop Type</th>
                                    <th>Field Number</th>
                                    <th>Crop</th>
                                    <th>Variety</th>
                                    <th>Number of Trees</th>
                                    <th>Number of Bushes</th>
                                    <th>Planting Date</th>
                                    <th>Observation Date</th>
                                    <th>Growth Crop</th>
                                    <th>Specify</th>
                                    <th>Plant Height</th>
                                    <th>Fruit Diameter</th>
                                    <th>Canopy Diameter</th>
                                    <th>Tree Diameter</th>
                                    <th>Weed Infestation</th>
                                    <th>Pest Disease</th>
                                    <th>Other Observations</th>
                                    <th>CSV</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            $id = 0;
                            try {
                                // Adjust query based on user role
                                $sql = ($_SESSION['role'] == "admin") 
                                    ? "SELECT * FROM crop_data" 
                                    : "SELECT * FROM crop_data WHERE user_id = :user_id";

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
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $rows['crop_type']; ?></td>
                                    <td><?php echo $rows['field_number']; ?></td>
                                    <td><?php echo $rows['crops']; ?></td>
                                    <td><?php echo $rows['variety']; ?></td>
                                    <td><?php echo $rows['no_trees']; ?></td>
                                    <td><?php echo $rows['no_bushes']; ?></td>
                                    <td><?php echo $rows['planting_date']; ?></td>
                                    <td><?php echo $rows['observation_date']; ?></td>
                                    <td><?php echo $rows['growth_crop']; ?></td>
                                    <td><?php echo $rows['specify_other']; ?></td>
                                    <td><?php echo $rows['plant_height']; ?></td>
                                    <td><?php echo $rows['fruit_diameter']; ?></td>
                                    <td><?php echo $rows['canopy_diameter']; ?></td>
                                    <td><?php echo $rows['tree_diameter']; ?></td>
                                    <td><?php echo $rows['weed_infestation']; ?></td>
                                    <td><?php echo $rows['pest_disease']; ?></td>
                                    <td><?php echo $rows['other_observations']; ?></td>
                                    <td>
                                        <a href="csv.php?id=<?php echo $rows['id']; ?>" class="btn btn-success">Download</a>
                                    </td>
                                    <td>
                                        <a href="edituser.php?id=<?php echo $rows['id']; ?>" class="btn btn-warning">Edit</a>
                                        <?php if ($_SESSION["role"] == "admin") { ?>
                                            <a href="deleteagro2.php?id=<?php echo $rows['id']; ?>" class="btn btn-danger">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php 
                                } 
                            } catch (Exception $e) {
                                echo "Error: " . $e->getMessage();
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
