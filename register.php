<?php

require_once "inc/session.php";
require_once "inc/db.php";
require_once "inc/function.php";

$country_name = "Tanzania";

if (isset($_POST["submit"])) {
    $name = strtolower(trim($_POST["name"]));
    $country = strtolower($_POST["country"]);
    $region = strtolower(trim($_POST["region"]));
    $district = strtolower(trim($_POST["district"]));
    $icao = strtolower(trim($_POST["icao"]));
    $iata = strtolower(trim($_POST["iata"]));
    $station_id = strtolower(trim($_POST["station_id"]));
    $type = strtolower(trim($_POST["type"]));
    $region_block_number = strtolower(trim($_POST["region_block_number"]));
    $station_number = strtolower(trim($_POST["station_number"]));
    $long = strtolower(trim($_POST["long"]));
    $lat = strtolower(trim($_POST["lat"]));
    $sqlCheck = "SELECT * FROM station WHERE name = :station";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindValue(':station', $name);
    $stmtCheck->execute();
    if ($stmtCheck->rowCount() > 0) {
        echo "<div class='alert alert-danger'>Station already exists.</div>";
    } else {
        $sql= "INSERT INTO station (name, region, district, icao, iata, station_id, type, region_block_number,
        station_number, longitude, latitude, country)
        VALUES (:name, :region, :district, :icao, :iata, :station_id, :type, :region_number, :station_number, :long, :lat, :country)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':region', $region);
        $stmt->bindValue(':district', $district);
        $stmt->bindValue(':icao', $icao);
        $stmt->bindValue(':iata', $iata);
        $stmt->bindValue(':station_id', $station_id);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':region_number', $region_block_number);
        $stmt->bindValue(':station_number', $station_number);
        $stmt->bindValue(':long', $long);
        $stmt->bindValue(':lat', $lat);
        $stmt->bindValue(':country', $country);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION["SuccessMessage"] = "Station added successfully";
            Redirect_to("view.php");
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong.</div>";
        }
    }

}

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
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.jpg">
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
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ccc;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }
    </style>
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>
<body>
    <div id="preloader"></div>
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
                                        <h3>New Station</h3>
                                    </div>
                                </div>
                                <form class="new-added-form" method="POST" action="register.php">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Name</label>
                                            <input type="text" placeholder="" name="name" class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Country</label>
                                            <input type="text" placeholder="<?php echo $country_name ?>"
                                                value="<?php echo $country_name ?>" name="country" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Region</label>
                                            <input type="text" placeholder="" name="region" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>District</label>
                                            <input type="text" placeholder="" name="district" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>ICAO</label>
                                            <input type="text" placeholder="" name="icao" class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>IATA</label>
                                            <input type="text" placeholder="" name="iata" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>ID</label>
                                            <input type="text" placeholder="" name="station_id" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Type</label>
                                            <input list="typeOptions" name="type" class="form-control" required
                                                id="typeInput" oninput="checkOther()">
                                            <datalist id="typeOptions">
                                                <option value="Synoptic"></option>
                                                <option value="Agro-Met"></option>
                                                <option value="Climate"></option>
                                                <option value="AWS"></option>
                                                <option value="Rainfall"></option>
                                            </datalist>
                                        </div>
                                        <script>
                                        function checkOther() {
                                            const input = document.getElementById('typeInput');
                                            if (input.value === 'Other') {

                                            }
                                        }
                                        </script>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Region Block Number</label>
                                            <input type="text" placeholder="" name="region_block_number" class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Station Number</label>
                                            <input type="text" placeholder="" name="station_number" class="form-control" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Longitude</label>
                                            <input type="number" placeholder="" name="long" class="form-control"
                                                step="any" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Latitude</label>
                                            <input type="number" placeholder="" name="lat" class="form-control"
                                                step="any" required>
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="submit"
                                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
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
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>