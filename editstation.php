<?php require_once "inc/session.php" ?>
<?php require_once "inc/db.php" ?>
<?php require_once "inc/function.php" ?>
<?php $_SESSION["TrackingURL"]= $_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php
$id =$_GET['id'];
if(isset($_POST["submit"])){
                $name = trim($_POST["name"]);
                $region = trim($_POST["region"]);
                $district = trim($_POST["district"]);
                $iata = trim($_POST["iata"]);
                $icao = trim($_POST["icao"]);
                $type = trim($_POST["type"]);
                $station_id = trim($_POST["station_id"]);
                $longitude = trim($_POST["long"]);
                $lat = trim($_POST["lat"]);
                $sql = "UPDATE station 
                        SET name = :name, region = :region, district = :district, 
                            iata = :iata, icao = :icao, type = :type, station_id = :station_id, longitude = :longitude, 
                            latitude = :latitude
                        WHERE id = :id";



            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':region', $region);
            $stmt->bindValue(':district', $district);
            $stmt->bindValue(':iata', $iata);
            $stmt->bindValue(':icao', $icao);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':station_id', $station_id);
            $stmt->bindValue(':longitude', $longitude);
            $stmt->bindValue(':latitude', $lat);
            $stmt->bindValue(':id', $id);
            $results = $stmt->execute();
            if ($results) {
            $_SESSION["SuccessMessage"]=" Station Updated  ";
            Redirect_to("view.php");
            }else 
            {
            $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
            Redirect_to("editstation.php");
        }
}
?>
                        <?php
                                $sql  = "SELECT * FROM station WHERE id='$id'";
                                $stmt = $conn ->query($sql);
                                while ($rows=$stmt->fetch()) {
                                $id    = $rows['id'];
                                $name = $rows['name'];
                                $region = $rows['region'];
                                $district = $rows['district'];
                                $iata = $rows['iata'];
                                $icao = $rows['icao'];
                                $station_id = $rows['station_id'];
                                $type = $rows['type'];
                                $longitude = $rows['longitude'];
                                $latitude = $rows['latitude'];
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
</head>
<body>
    <?php require_once "inc/navbar.php" ?>
    <div class="dashboard-page-one">
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="index.php"><img src="img/logo.jpg" alt="logo"></a>
                </div>
            </div>
            <?php  include 'inc/sidebar.php' ?>
        </div>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <h3>Update Station</h3>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                </div>
                            </div>
                            <form class="" action="editstation.php?id=<?php echo $id; ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Name</label>
                                            <input type="text" placeholder="" name="name" value="<?php echo $name ?> "
                                                class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Region</label>
                                            <input type="text" placeholder="" name="region"
                                                value="<?php echo $region ?>" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>District</label>
                                            <input type="text" placeholder="" name="district"
                                                value="<?php echo $district ?>" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>IATA</label>
                                            <input type="text" placeholder="" name="iata" value="<?php echo $iata ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>ICAO</label>
                                            <input type="text" placeholder="" name="icao" value="<?php echo $icao ?>"
                                                class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Type</label>
                                            <input type="text" placeholder="" name="type" value="<?php echo $type ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Station ID</label>
                                            <input type="text" placeholder="" name="station_id"
                                                value="<?php echo $station_id ?>" class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Longitude</label>
                                            <input type="number" placeholder="" name="long"
                                                value="<?php echo $longitude ?>" step="any" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Latitude</label>
                                            <input type="number" placeholder="" name="lat"
                                                value="<?php echo $latitude ?>" step="any" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="submit"
                                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                            <button type="reset"
                                                class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                            </form>

                        </div>
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
    <script src="js/select2.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>