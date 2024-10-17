<?php 
include "inc/header.php";
include "inc/db.php";
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid'];
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$name = 'Unknown Station'; 
if ($user) {
    $station_id = $user['station_id'];
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
                            <h3><b><?php echo ($_SESSION['role'] == "admin") ? "All" : $name; ?> TAF Report Records</b></h3>
                        </div>
                    </div>

                    <div class="filter-area">
                        <label for="filter">Download CSV:</label>
                        <select id="filter" name="filter" class="form-control" style="display: inline-block; width: auto;">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                        <button id="downloadCsv" class="btn btn-primary">Download</button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Services</th>
                                    <th>Validity Begin Date</th>
                                    <th>Validity End Date</th>
                                    <th>Validity End Time</th>
                                    <th>Cancellation</th>
                                    <th>Wind Direction</th>
                                    <th>Wind Speed 2</th>
                                    <th>Wind Speed 1</th>
                                    <th>Visisbility</th>
                                    <th>Weather Descriptor</th>
                                    <th>Subject</th>
                                    <th>Weather Phenomenon</th>
                                    <th>Weather Intensity</th>
                                    <th>Clod layer Type 1</th>
                                    <th>Cloud Height 1</th>
                                    <th>Cloyd Layer Amount 3</th>
                                    <th>Cloud layer Type 2</th>
                                    <th>Cloud Height 2</th>
                                    <th>Cloud Layer Amount 4</th>
                                    <th>Cloud Height 4</th>
                                    <th>Cavok</th>
                                    <th>Actions</th>
                                    <th>CSV</th>
                                </tr>
                            </thead>

                            <tbody>
    <?php
    $id = 0;
    try {
        $sql = ($_SESSION['role'] == "admin") 
            ? "SELECT * FROM taf_data" 
            : "SELECT * FROM taf_data WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);
        if ($_SESSION['role'] != "admin") {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }

        $stmt->execute();

        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id++;
    ?>
            <tr>
                <td><?php echo htmlspecialchars($id); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_type']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_date']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_time']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_services']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_validity_begin_date']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_validity_begin_time']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_validity_end_date']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_validity_end_time']); ?></td>
                <td><?php echo htmlspecialchars($rows['taf_cancellation']); ?></td>
                <td><?php echo htmlspecialchars($rows['wind_direction']); ?></td>
                <td><?php echo htmlspecialchars($rows['wind_speed_2']); ?></td>
                <td><?php echo htmlspecialchars($rows['wind_speed_1']); ?></td>
                <td><?php echo htmlspecialchars($rows['visibility']); ?></td>
                <td><?php echo htmlspecialchars($rows['weather_descriptor']); ?></td>
                <td><?php echo htmlspecialchars($rows['subject']); ?></td>
                <td><?php echo htmlspecialchars($rows['weather_phenomenon']); ?></td>
                <td><?php echo htmlspecialchars($rows['weather_intensity']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_layer_amount_1']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_layer_type_1']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_height_1']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_layer_amount_3']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_layer_type_2']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_height_2']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_layer_amount_4']); ?></td>
                <td><?php echo htmlspecialchars($rows['cloud_height_4']); ?></td>
                <td><?php echo htmlspecialchars($rows['cavok']); ?></td>
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

<script>
    document.getElementById('downloadCsv').addEventListener('click', function() {
    const filter = document.getElementById('filter').value;
    window.location.href = `download_taf_csv.php?filter=${filter}`;
    });
</script>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
