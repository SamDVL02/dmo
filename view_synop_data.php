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
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
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

        .modal-content {
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

        .modal-content p {
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
                <div class="breadcrumbs-area">
                </div>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3><?php 
                             if($_SESSION['role'] == "admin"){
                                echo "All";
                            }
                            else
                             {
                                echo strtoupper($_SESSION['station']);
                             }
                             ?> Synop Report Records</h3>
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
                                        <th>Measuring Instrument</th>
                                        <th>Precipitation Indicator</th>
                                        <th>Station Operation Weather</th>
                                        <th>Height Lowest Cloud Base</th>
                                        <th>Visibility</th>
                                        <th>Precipitation Duration</th>
                                        <th>Present Weather</th>
                                        <th>Past Weather One</th>
                                        <th>Past Weather Two</th>
                                        <th>Low level Cloud Type</th>
                                        <th>Medium level Cloud Type</th>
                                        <th>High level Cloud Type</th>
                                        <th>Grass Temperature</th>
                                        <th>Character Intensity of Precipitation</th>
                                        <th>Hours from Precipitation to Observation</th>
                                        <th>Precipitation Amount</th>
                                        <th>Type of Instrument Evaporation</th>
                                        <th>Sunshine Segments</th>
                                        <th>Cup Added Removed</th>
                                        <th>First Lowest Cloud Layer Type</th>
                                        <th>First Lowest Cloud Layer Height</th>
                                        <th>Second Lowest Cloud Layer Type</th>
                                        <th>Second Lowest Cloud Layer Height</th>
                                        <th>Third Lowest Cloud Layer Type</th>
                                        <th>Third Lowest Cloud Layer Height</th>
                                        <th>Fourth Lowest Cloud Layer Type</th>
                                        <th>Fourth Lowest Cloud Layer Height</th>
                                        <th>Wind Direction</th>
                                        <th>Wind Speed</th>
                                        <th>Total Sky Cloud Cover</th>
                                        <th>First Significant cloud Oktas</th>
                                        <th>Second Significant cloud Oktas</th>
                                        <th>Third Significant cloud Oktas</th>
                                        <th>Fourth Significant cloud Oktas</th>
                                        <th>Dry Bulb Temperature</th>
                                        <th>Dew Point Temperature</th>
                                        <th>Maximum Temperature</th>
                                        <th>Minimum Temperature</th>
                                        <th>C.L.P</th>
                                        <th>M.S.L.P</th>
                                        <th>GPM</th>
                                        <th>Total Precipitation 24hrs</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                               $user_id = $_SESSION['userid'];
                               $id = 0;
                           
                               try {
                                   if ($_SESSION['role'] == "admin") {
                                       $sql = "SELECT * FROM synop";
                                   } else {
                                       $sql = "SELECT * FROM synop WHERE user_id = :user_id";
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
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo htmlspecialchars($rows['time_of_observation']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['wind_measuring_instruments']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['indicator_for_precipitation_data']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['station_operation_weather']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['height_of_lowest_cloud_base']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['visibility']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['precipitation_duration']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['present_weather']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['past_weather_1']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['past_weather_2']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['low_level_cloud_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['medium_level_cloud_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['high_level_cloud_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['grass_temperature']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['character_intensity_of_precipitation']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['hours_from_precipitation_to_observation']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['precipitation_amount']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['type_of_instrument_for_evaporation_measurement']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['sunshine_card_segments']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['cups_added_removed']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['first_lowest_cloud_layer_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['first_lowest_cloud_layer_base_height']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['second_lowest_cloud_layer_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['second_lowest_cloud_layer_base_height']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['third_lowest_cloud_layer_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['third_lowest_cloud_layer_base_height']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['fourth_lowest_cloud_layer_type']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['fourth_lowest_cloud_layer_base_height']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['wind_direction']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['wind_speed']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['t_s_c_c']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['f_s_c']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['s_s_c']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['t_s_c']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['fo_s_c']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['d_b_t']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['d_p_t']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['max_t']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['min_t']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['c_l_p']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['m_s_l_p']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['gpm']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['t_p_24']); ?></td>
                                        <td>
                                            <a href="editsynop.php?id=<?php echo $rows['id']; ?>" class="btn btn-warning">Edit</a>
                                            <?php if ($_SESSION["role"] == "admin") { ?>
                                            <a href="#" onclick='openModal(<?php echo $rows['id']; ?>); return false;' class="btn btn-danger">Delete</a>
                                            <?php } ?>
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
        <div class="modal-content">
            <p>Are you sure you want to delete this record?</p>
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
        window.location.href = "deletesynop.php?id=" + deleteId;
    }
    </script>
    <script>
        document.getElementById('downloadCsv').addEventListener('click', function() {
        const filter = document.getElementById('filter').value;
        window.location.href = `download_synop_csv.php?filter=${filter}`;
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