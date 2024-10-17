<?php 

include "inc/header.php";
include "inc/db.php";

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid'];

// Fetch the user's station ID
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = 'Unknown Station'; 

if ($user) {
    $station_id = $user['station_id'];
    // Fetch the station name
    $sql1 = "SELECT name FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);
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
                            <h3><b><?php echo ($_SESSION['role'] == "admin") ? "All" : $name; ?> Agrometeorological Daily Weather Report (AGRO-MET)</b></h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Crop Type</th>
                                    <th>Field Number</th>
                                    <th>Crop</th>
                                    <th>Variety</th>
                                    <th>Observation Date</th>
                                    <th>Phenological Phase</th>
                                    <th>Length</th>
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Leaf Area</th>
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
                                        ? "SELECT * FROM crop_observations" 
                                        : "SELECT * FROM crop_observations WHERE user_id = :user_id";

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
                                    <td><?php echo $rows['crop']; ?></td>
                                    <td><?php echo $rows['variety']; ?></td>
                                    <td><?php echo $rows['observation_date']; ?></td>
                                    <td><?php echo $rows['phenological_phase']; ?></td>
                                    <td><?php echo $rows['length']; ?></td>
                                    <td><?php echo $rows['width']; ?></td>
                                    <td><?php echo $rows['height']; ?></td>
                                    <td><?php echo $rows['leaf_area']; ?></td>
                                    <td>
                                        <a href="csv.php?id=<?php echo $rows['id']; ?>" class="btn btn-success">Download CSV</a>
                                    </td>
                                    <td>
                                        <a href="edituser.php?id=<?php echo $rows['id']; ?>" class="btn btn-warning">Edit</a>
                                        <?php if ($_SESSION["role"] == "admin") { ?>
                                            <a href="deleteagro1.php?id=<?php echo $rows['id']; ?>" class="btn btn-danger">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } catch (PDOException $e) {
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
<!-- jquery -->
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
