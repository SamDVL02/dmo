<?php include "inc/header.php"; ?>
<!-- Preloader Start Here -->
<!-- <div id="preloader"></div> -->
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    <?php include "inc/navbar.php"; ?>
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <?php include "inc/sidebar.php"; ?>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>TAF</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><?php echo $_SESSION['station'] ?> Records</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Teacher Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <!-- <h3>All Records</h3> -->
                        </div>
                        <div class="dropdown">
                            <!-- <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div> -->
                        </div>
                        <form class="mg-b-20">
                            <!-- <div class="row gutters-8">
                            <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                <input type="text" placeholder="Search by ID ..." class="form-control">
                            </div>
                            <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                                <input type="text" placeholder="Search by Name ..." class="form-control">
                            </div>
                            <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                <input type="text" placeholder="Search by Phone ..." class="form-control">
                            </div>
                            <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                            </div>
                        </div> -->
                        </form>
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Time</th>
                                        <th>Services</th>
                                        <th>Validity Begin Date</th>
                                        <th>Validity Begin Time</th>
                                        <th>Validity End Date</th>
                                        <th>Validity End Time</th>
                                        <th>TAF Cancellation</th>
                                        <th>Wind Direction</th>
                                        <th>Wind Speed (2 digits)</th>
                                        <th>Wind Speed (1 digit)</th>
                                        <th>Visibility</th>
                                        <th>Weather Descriptor</th>
                                        <th>Subject</th>
                                        <th>Weather Phenomenon</th>
                                        <th>Weather Intensity</th>
                                        <th>First Cloud Layer Amount</th>
                                        <th>First Cloud Layer Type</th>
                                        <th>First Cloud Layer Height</th>
                                        <th>Third Cloud Layer Amount</th>
                                        <th>Second Cloud Layer Height</th>
                                        <th>Fourth Cloud Layer Amount</th>
                                        <th>Fourth Cloud Layer Height</th>
                                        <th>CAVOK</th>
                                        <th>CSV</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                // Fetch data from the database
                                require_once "inc/session.php";
                                require_once "inc/db.php";
                                require_once "inc/function.php";

                                $station = $_SESSION['station']; // Use the session variable to filter data

                                $sql = "SELECT * FROM taf_data WHERE station = :station"; // Adjust the query to filter by station
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':station', $station);
                                $stmt->execute();
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (empty($rows)): ?>
                                    <tr>
                                        <td colspan="26" class="text-center">No data found</td>
                                        <!-- Adjust colspan based on number of columns -->
                                    </tr>
                                    <?php else:
                                    foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_type']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['month']); ?></td>
                                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_time']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_services']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_validity_begin_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_validity_begin_time']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_validity_end_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_validity_end_time']); ?></td>
                                        <td><?php echo htmlspecialchars($row['taf_cancellation']); ?></td>
                                        <td><?php echo htmlspecialchars($row['wind_direction']); ?></td>
                                        <td><?php echo htmlspecialchars($row['wind_speed_2']); ?></td>
                                        <td><?php echo htmlspecialchars($row['wind_speed_1']); ?></td>
                                        <td><?php echo htmlspecialchars($row['visibility']); ?></td>
                                        <td><?php echo htmlspecialchars($row['weather_descriptor']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($row['weather_phenomenon']); ?></td>
                                        <td><?php echo htmlspecialchars($row['weather_intensity']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_layer_amount_1']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_layer_type_1']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_height_1']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_layer_amount_3']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_layer_type_2']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_height_2']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cloud_layer_amount_4']); ?></td>
                                        <!-- <td><?php echo htmlspecialchars($row['cloud_height_4']); ?></td> -->
                                        <td><?php echo htmlspecialchars($row['cavok']); ?></td>
                                        <td>
                                            <a href="csv3.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-success">Download</a>
                                            <!-- <a href="pdf3.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Download PDF</a> -->
                                        </td>
                                        <td>
                                            <a href="editspci.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-warning">Edit</a>
                                            <?php if ($_SESSION["profile"] == "super-user") { ?>
                                            <a href="deletespci.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-danger">Delete</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php endforeach;
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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