<?php include "inc/header.php" ?>
<!-- Preloader Start Here -->
<!-- <div id="preloader"></div> -->
<!-- Preloader End Here -->
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
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><?php echo $_SESSION['station'] ?> Agro Weather</li>
                </ul>
            </div>
            <!-- Breadcrumbs Area End Here -->
            <!-- Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><?php echo strtoupper($_SESSION['station']) ?> Agrometeorological Daily Weather Report
                                (AGRO-MET)</h3>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <!-- <th>Station</th> -->
                                    <th>Geo Latitude</th>
                                    <!-- <th>Date</th> -->
                                    <th>Geo Longitude</th>
                                    <th>District</th>
                                    <th>Observer Name</th>
                                    <th>Year</th>
                                    <th>Crop_type</th>
                                    <th>Observation Agriculture</th>
                                    <th>Pheno Phase</th>
                                    <th>General Assessment</th>
                                    <th>Density Sowing area</th>
                                    <th>Density Area</th>
                                    <th>Plant Height</th>
                                    <th>Damage Adv Date</th>
                                    <th>Pest/Disease Damage Pecentage</th>
                                    <th>Weed Spread Marks</th>
                                    <th>Harvest Date</th>
                                    <th>signature</th>
                                    <th>CSV</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // Include your database connection file
                                // Assuming the session has been started earlier

                                // Get the station name from the session
                                $station = $_SESSION['station'];

                                // Query to fetch METAR data only for the station in session
                                $sql = "SELECT * FROM dackend WHERE station = :station"; 
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':station', $station, PDO::PARAM_STR);
                                $stmt->execute();
                                $id = 0;

                                // Loop through the rows and display the data
                                while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $id++;
                                
                                ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $rows['longitude']; ?></td>
                                    <td><?php echo $rows['latitude']; ?></td>
                                    <td><?php echo $rows['geo_latitude']; ?></td>
                                    <td><?php echo $rows['geo_longitude']; ?></td>
                                    <td><?php echo $rows['district_name']; ?></td>
                                    <td><?php echo $rows['observer_name']; ?></td>
                                    <td><?php echo $rows['year']; ?></td>
                                    <td><?php echo $rows['crop_type']; ?></td>
                                    <td><?php echo $rows['obs_agri']; ?></td>
                                    <td><?php echo $rows['pheno_phase']; ?></td>
                                    <td><?php echo $rows['general_assessment']; ?></td>
                                    <td><?php echo $rows['density_sowing_area']; ?></td>
                                    <td><?php echo $rows['density_area']; ?></td>
                                    <td><?php echo $rows['plant_height']; ?></td>
                                    <td><?php echo $rows['damage_adv_date']; ?></td>
                                    <td><?php echo $rows['pest_disease_damage_percent']; ?></td>
                                    <td><?php echo $rows['weed_spread_marks']; ?></td>
                                    <td><?php echo $rows['harvest_date']; ?></td>
                                    <td><?php echo $rows['signature']; ?></td>
                                    <td>
                                        <a href="csv.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-success">Download</a>
                                        <!-- <a href="pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Download PDF</a> -->
                                    </td>
                                    <td><a href="edituser.php?id=<?php echo $id; ?>"><span
                                                class="btn btn-warning">Edit</span></a>
                                        <?php if($_SESSION["profile"] == "super-user"){
                                                      echo ' <a href="deletemetor.php?id='.$id.'"><span class="btn btn-danger">Delete</span></a> </td>'; 
                                                }?>
                                    </td>
                                </tr>
                                <?php } ?>
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