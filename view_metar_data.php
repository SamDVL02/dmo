<?php 
include "inc/header.php";
include "inc/db.php";

    if (!isset($_SESSION['userid'])) 
    {
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="style.css">
    <style>
        #deleteModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transform: translateY(-30px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .modal-buttons #confirmDelete {
            background-color: #d9534f;
            color: white;
        }

        .modal-buttons #cancelDelete {
            background-color: #5bc0de;
            color: white;
        }

        #deleteModal.active .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
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
                                    <th>Id</th>
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
                                </tr>
                            </thead>
                            <tbody>
    <?php
    $id = 0;
    try {
        $sql = ($_SESSION['role'] == "admin") 
            ? "SELECT * FROM metar" 
            : "SELECT * FROM metar WHERE user_id = :user_id";

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
                    <a href="editmetar.php?id=<?php echo htmlspecialchars($rows['id']); ?>" class="btn btn-warning">Edit</a>
                    <?php if ($_SESSION["role"] == "super-user" || $_SESSION["role"] == "admin") { ?>
                        <button onclick='openModal(<?php echo htmlspecialchars($rows["id"]); ?>)' class="btn btn-danger">Delete</button>
                    <?php } ?>
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

<div id="deleteModal">
    <div class="modal-content">
        <p>Are you sure you want to delete this metar?</p>
        <div class="modal-buttons">
            <button id="confirmDelete">Yes, Delete</button>
            <button id="cancelDelete">Cancel</button>
        </div>
    </div>
</div>

<script>
    let deleteId;
    function openModal(id) {
        deleteId = id;
        document.getElementById('deleteModal').style.display = 'flex';
        setTimeout(function() {
            document.getElementById('deleteModal').classList.add('active');
        }, 10);
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.remove('active');
        setTimeout(function() {
            document.getElementById('deleteModal').style.display = 'none';
        }, 300);
    }

    document.getElementById('cancelDelete').addEventListener('click', closeModal);

    document.getElementById('confirmDelete').addEventListener('click', function() {
        window.location.href = `deletemetor.php?id=${deleteId}`;
    });
</script>

<script>
    document.getElementById('downloadCsv').addEventListener('click', function() {
        const filter = document.getElementById('filter').value;
        window.location.href = `download_csv.php?filter=${filter}`;
    });
</script>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>