   <?php
            include "inc/db.php";
            include "inc/header.php";
            $user_id = $_SESSION['userid'];
            $sql = "SELECT station_id FROM users WHERE id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) 
            {
                $station_id = $user['station_id'];
                $sql1 = "SELECT name FROM station WHERE id = :station_id";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute(['station_id' => $station_id]);
                $station = $stmt1->fetch(PDO::FETCH_ASSOC);
                if ($station)
                {
                    $name = $station['name'];
                } 
                else 
                {
                    $name = 'Unknown Station';
                }
            }
            else 
            {
                $name = 'Unknown Station';
            }
    ?>

<div id="wrapper" class="wrapper bg-ash">
    <?php include 'inc/navbar.php'  ?>
    <div class="dashboard-page-one">
        <?php include  'inc/sidebar.php'?>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <h3><?php echo $name ?> Station</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>All Report</h3>
                                </div>
                                <div class="dropdown">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input checkAll">
                                                    <label class="form-check-label">ID</label>
                                                </div>
                                            </th>
                                            <th>Muda wa kuripoti tukio</th>
                                            <th>Tarehe</th>
                                            <th>Mwezi</th>
                                            <th>Mwaka</th>
                                            <th>Majira</th>
                                            <th>Aina ya tukio</th>
                                            <th>Kijiji</th>
                                            <th>Kata</th>
                                            <th>Wilaya</th>
                                            <th>Mkoa</th>
                                            <th>Madhara</th>
                                            <th>Jina</th>
                                            <th>Download/CSV</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $station = $_SESSION['station'];
                                    $stmt = $conn->prepare("SELECT * FROM severe_data_events WHERE station = :station");
                                    $stmt->bindParam(':station', $station);
                                    $stmt->execute();
                                    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($reports as $report) {
                                        echo "<tr>";
                                        echo "<td><div class='form-check'><input type='checkbox' class='form-check-input'><label class='form-check-label'>" . htmlspecialchars($report['id']) . "</label></div></td>";
                                        echo "<td>" . htmlspecialchars($report['time_obs']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['event_date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['month']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['year']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['event_time']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['event_type']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['village']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['ward']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['district']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['region']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['damage']) . "</td>";
                                        echo "<td>" . htmlspecialchars($report['name']) . "</td>";
                                        echo "<td>
                                                <a href='csv4.php?id=" . urlencode($report['id']) . "' class='btn btn-success'>Download CSV</a>
                                                <a href='pdf4.php?id=" . urlencode($report['id']) . "' class='btn btn-danger'>Download PDF</a>
                                              </td>";
                                        echo "<td>
                                                <a href='editspci.php?id=" . urlencode($report['id']) . "' class='btn btn-warning'>Edit</a>";
                                        if ($_SESSION["profile"] == "super-user") {
                                            echo "<a href='deletespci.php?id=" . urlencode($report['id']) . "' class='btn btn-danger'>Delete</a>";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
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
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src = "js/main.js" ></script>
        </body>

        </html>