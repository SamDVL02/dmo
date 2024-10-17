<?php 
include "inc/header.php";
include "inc/db.php";
$user_id = $_SESSION['userid'];
$sql = "SELECT station_id FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
    $station_id = $user['station_id'];
    $sql1 = "SELECT name FROM station WHERE id = :station_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute(['station_id' => $station_id]);
    $station = $stmt1->fetch(PDO::FETCH_ASSOC);
    if ($station) {
        $name = $station['name'];
    } else {
        $name = 'Unknown Station';
    }
} else {
    $name = 'Unknown Station';
}
?>


<!doctype html>
<html class="no-js" lang="">
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

        .model-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transform: translateY(-30px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .model-content p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
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
            transition: background-color 0.2s ease;
        }

        .modal-buttons #confirmDelete {
            background-color: #d9534f;
            color: white;
        }

        .modal-buttons #confirmDelete:hover {
            background-color: #c9302c;
        }

        .modal-buttons button:hover {
            background-color: #5bc0de;
            color: white;
        }

        .modal-buttons button:last-child {
            background-color: #5bc0de;
            color: white;
        }

        .modal-buttons button:last-child:hover {
            background-color: #31b0d5;
        }

        /* Smooth modal opening */
        #deleteModal.active .model-content {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
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
                        <div class="item-title">
                            <h3><b><?php
                                if($_SESSION['role'] == "admin"){
                                    echo "All";
                                }
                                else {
                                    echo $name;
                                }
                                ?> Speci Report Records</b></h3>
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
                                <td>
                                    <a href="editspci.php?id=<?php echo htmlspecialchars($rows['id'], ENT_QUOTES, 'UTF-8'); ?>"><span class="btn btn-warning">Edit</span></a>
                                    <?php if ($_SESSION["role"] == "super-user" || $_SESSION["role"] == "admin"): ?>
                                        <a href="#" onclick="openModal(<?php echo htmlspecialchars($rows['id'], ENT_QUOTES, 'UTF-8'); ?>); return false;"><span class="btn btn-danger">Delete</span></a>
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
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="model-content">
        <p>Are you sure you want to delete this Speci Report?</p>
        <div class="modal-buttons">
            <button id="confirmDelete" onclick="confirmDelete()">Yes</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
let deleteId = null;

function openModal(id) {
    deleteId = id;
    const modal = document.getElementById('deleteModal');
    modal.classList.add('active');
    modal.style.display = "flex";
}

function closeModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('active');
    setTimeout(() => {
        modal.style.display = "none";
    }, 300);
}

function confirmDelete() {
    window.location.href = "deletespeci.php?id=" + deleteId;
}
</script>

<script>
    document.getElementById('downloadCsv').addEventListener('click', function() {
    const filter = document.getElementById('filter').value;
    window.location.href = `download_speci_csv.php?filter=${filter}`;
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