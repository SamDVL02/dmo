<?php
include  'inc/session.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                                    <h3>Agrometeorological Daily Weather Report (AGRO-MET)</h3>
                                    </div>
                                    <div class="dropdown">
                                    </div>
                                </div>
                                <form class="new-added-form" method="POST"  action="inc/agrobackend.php">
                                    <div class="row">          
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Date</label>
                                            <input type="text" placeholder="dd/mm/yyyy" name="YY" class="form-control air-datepicker"
                                                data-position='bottom right' required>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Maximum Temperature (°C):</label>
                                            <input type="number" placeholder="" name="MT" class="form-control" step="any">
</div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Minimum Temperature (°C):</label>
                                            <input type="number" placeholder="" name="mt"  class="form-control" step="any">
                                        </div>                               
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Rainfall (mm):</label>
                                            <input type="number" placeholder="" name="r"  class="form-control" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Soil Temperature (°C):</label>
                                            <input type="number" placeholder="" name="st"  class="form-control" step="any">
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="add" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                </form>
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