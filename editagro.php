<?php require_once "inc/session.php"; ?>
<?php require_once "inc/db.php"; ?>
<?php require_once "inc/function.php"; ?>
<?php 
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login(); 
$id = $_GET['id']; // Get the ID of the record to edit

if (isset($_POST["add"])) {
    // Collect form data
    $date = $_POST['YY'];
    $max_t = $_POST['MT'];
    $min_t = $_POST['mt'];
    $rainfall = $_POST['r'];
    $soil_temp = $_POST['st'];

    // Update query (corrected)
    $sql = "UPDATE agro_meteorological_data SET 
        date = :date, 
        max_temperature = :max_t, 
        min_temperature = :min_t, 
        rainfall = :rainfall, 
        soil_temperature = :soil_temp
        WHERE id = :id";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':max_t', $max_t);
    $stmt->bindParam(':min_t', $min_t);
    $stmt->bindParam(':rainfall', $rainfall);
    $stmt->bindParam(':soil_temp', $soil_temp);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 

    // Execute the query
    $result = $stmt->execute();
    if ($result) {
        $_SESSION["SuccessMessage"] = "Agro-meteorological data updated successfully";
        header("Location: view_agro.php");
        exit();
    } else {
        $_SESSION["ErrorMessage"] = "Something went wrong. Try again!";
        header("Location: view_agro.php?id=$id");
        exit();
    }
}
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Agro Report</title>
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
        <?php include 'inc/navbar.php'; ?>
        <div class="dashboard-page-one">
            <?php include 'inc/sidebar.php'; ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Edit Agro Report</h3>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                // Fetch data to edit
                                $sql = "SELECT * FROM agro_meteorological_data WHERE id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                $date = $row['date'];
                                $min_t = $row['min_temperature'];
                                $max_t = $row['max_temperature'];
                                $rainfall = $row['rainfall'];
                                $soil_temp = $row['soil_temperature'];
                                ?>

                                <form class="new-added-form" method="POST" action="editagro.php?id=<?php echo $id; ?>">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Date</label>
                                            <input type="text" placeholder="dd/mm/yyyy" name="YY" class="form-control air-datepicker" data-position='bottom right' value="<?php echo $date; ?>" required>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Maximum Temperature (°C):</label>
                                            <input type="number" name="MT" class="form-control" value="<?php echo $max_t; ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Minimum Temperature (°C):</label>
                                            <input type="number" name="mt" class="form-control" value="<?php echo $min_t; ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Rainfall (mm):</label>
                                            <input type="number" name="r" class="form-control" value="<?php echo $rainfall; ?>" step="any">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Soil Temperature (°C):</label>
                                            <input type="number" name="st" class="form-control" value="<?php echo $soil_temp; ?>" step="any">
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

            <!-- jQuery -->
            <script src="js/jquery-3.3.1.min.js"></script>
            <!-- Plugins js -->
            <script src="js/plugins.js"></script>
            <!-- Popper js -->
            <script src="js/popper.min.js"></script>
            <!-- Bootstrap js -->
            <script src="js/bootstrap.min.js"></script>
            <!-- Scroll Up Js -->
            <script src="js/jquery.scrollUp.min.js"></script>
            <!-- Select 2 Js -->
            <script src="js/select2.min.js"></script>
            <!-- Date Picker Js -->
            <script src="js/datepicker.min.js"></script>
            <!-- Custom Js -->
            <script src="js/main.js"></script>
        </div>
    </div>
</body>

</html>
