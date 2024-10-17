<?php require_once "inc/session.php"; ?>
<?php require_once "inc/db.php"; ?>
<?php require_once "inc/function.php"; ?>
<?php 
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); 
$id = $_GET['id'];
if (isset($_POST["add"])) 

{
    $time_obs = $_POST['Time_obs'];
    $type = $_POST['Barometer'];
    $damage = $_POST['ff'];
    $user_id = $_SESSION['userid'];

    $sql = "UPDATE severe_data_events SET 
    time_obs = :time_obs, 
    event_type = :event_type, 
    damage = :damage, 
    WHERE id = :user_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':time_obs', $time_obs, PDO::PARAM_STR);
    $stmt->bindParam(':event_type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':damage', $damage, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $result = $stmt->execute();


    if ($result) {
        $_SESSION["SuccessMessage"] = "Metar Data updated successfully";
        header("Location: view_severe.php");
        exit();
    } else {
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        header("Location: editsevere.php?id=$id");
        exit();
    }
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
    <div id="wrapper" class="wrapper bg-ash">
        <?php include 'inc/navbar.php'  ?>
        <div class="dashboard-page-one">
            <?php include  'inc/sidebar.php'?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                </div>
                <?php
                            $sql  = "SELECT * FROM severe_data_events WHERE id='$id'";
                            $stmt = $conn ->query($sql);
                            while ($rows=$stmt->fetch()) 
                            {
                            $id    = $rows['id'];
                            $time_of_observation = $rows['time_obs'];
                            $type   = $rows['event_type'];
                            $damage = $rows["damage"];
                        }
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3><b>Edit Severe Event</b></h3>
                                    </div>
                                    <div class="dropdown">

                                    </div>
                                </div>
                                <form class="new-added-form" method="POST"  action="editsevere.php?id=<?php echo $id; ?>">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Muda wa Tukio</label>
                                            <input type="time" placeholder="" name="Time_obs" class="form-control" value="<?php echo $time_of_observation ?>" required>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Aina ya Tukio</label>
                                            <select class="select2" name="Barometer" value="<?php echo $type ?>" required>
                                            <option>Radi kali</option>
                                            <option value="mafuriko">Mafuriko</option>
                                            <option value="upepo mkali">Upepo mkali nchikavu</option>
                                            <option value="upepo makali ziwani">Upepo mkali ziwani</option>
                                            <option value="upepo mkali baharini">Upepo mkali baharini</option>
                                            <option  value="mawimbi">Mawimbi Makubwa ziwani</option>
                                            <option  value="mawimbi makubwa">Mawimbi Makubwa Mabarini</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Madhara</label>
                                            <input type="text" placeholder="" name="ff"  value="<?php echo $damage ?>" class="form-control">
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
            <script type="text/javascript">
            </script>
</body>

</html>