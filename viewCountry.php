<?php include "inc/header.php"  ?>
<!-- Preloader Start Here -->
<div id="preloader"></div>
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    <?php include "inc/navbar.php"  ?>
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <?php include "inc/sidebar.php"  ?>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <!-- 
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>All Station</li>
                </ul> -->
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Teacher Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Countries</h3>
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
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <?php
$sql="SELECT * FROM countries";
$iduser=0;
$name = "";
$stmt = $conn->query($sql);
while ($rows = $stmt->fetch()) {
$id=$rows["id"];
// $name =$rows["username"];
$iduser++;
?>
                            <tbody>
                                <tr>
                                    <td>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label"><?php echo($iduser) ?></label>
                                        </div>
                                    </td>
                                    <td><?php echo $rows['name'] ?></td>
                                    <td><a href="editCountry.php?id=<?php echo $id; ?>"><span
                                                class="btn btn-warning">Edit</span></a>
                                        <?php if($_SESSION["profile"] == "admin"){
                                                      echo ' <a href="deleteCountry.php?id='.$id.'"><span class="btn btn-danger">Delete</span></a> </td>'; 
                                                }?>
                                    </td>
                                    <!-- <td><a href="edituser.php?id=<?php echo $id; ?>"><span class="btn btn-warning">Edit</span></a> -->


                                    <?php
// if($_SESSION["profile"] == "super-admin"){

// echo '

// <a href="deleteuser.php?id='.$id.'"><span class="btn btn-danger">Delete</span></a>
// </td>';
// }

?>
                                    </td>
                                </tr>


                            </tbody>
                            <?php } ?>
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


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/all-book.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:33:58 GMT -->

</html>