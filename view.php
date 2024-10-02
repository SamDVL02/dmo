<?php include "inc/header.php"; ?>
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
</head>
<body>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include "inc/navbar.php"; ?>
        <div class="dashboard-page-one">
            <?php include "inc/sidebar.php"; ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area"></div>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3><b>Stations</b></h3>
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
                                        <th>Location</th>
                                        <th>Region</th>
                                        <th>District</th>
                                        <th>ICAO</th>
                                        <th>IATA</th>
                                        <th>Station ID</th>
                                        <th>Type</th>
                                        <th>Region Block Number</th>
                                        <th>Station Number</th>
                                        <th>Longitude</th>
                                        <th>Latitude</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $sql = "SELECT * FROM station";
                                $iduser = 0;
                                $stmt = $conn->query($sql);
                                while ($rows = $stmt->fetch()) {
                                    $id = $rows["id"];
                                    $iduser++;
                                ?>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input">
                                                <label class="form-check-label"><?php echo($iduser); ?></label>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['name'])); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['country'])); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['region'])); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['district'])); ?></td>
                                        <td><?php echo htmlspecialchars(strtoupper($rows['icao'])); ?></td>
                                        <td><?php echo htmlspecialchars(strtoupper($rows['iata'])); ?></td>
                                        <td><?php echo htmlspecialchars(strtoupper($rows['station_id'])); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['type'])); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['region_block_number'])); ?></td>
                                        <td><?php echo htmlspecialchars(ucfirst($rows['station_number'])); ?></td>
                                        <td><?php echo htmlspecialchars($rows['longitude']); ?></td>
                                        <td><?php echo htmlspecialchars($rows['latitude']); ?></td>
                                        <td>
                                            <a href="editstation.php?id=<?php echo $id; ?>"><span
                                                    class="btn btn-warning">Edit</span></a>
                                            <?php if ($_SESSION["role"] == "admin") { ?>
                                            <a href="#" onclick='openModal(<?php echo $id; ?>); return false;'><span
                                                    class="btn btn-danger">Delete</span></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal">
        <div class="model-content">
            <p>Are you sure you want to delete this Station?</p>
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
        modal.style.display = "flex";
        modal.querySelector('.model-content').style.transform = "translateY(0)";
        modal.querySelector('.model-content').style.opacity = "1";
    }
    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.querySelector('.model-content').style.transform = "translateY(-30px)";
        modal.querySelector('.model-content').style.opacity = "0";
        setTimeout(() => {
            modal.style.display = "none";
        }, 300);
    }
    function confirmDelete() {
        window.location.href = "deletestation.php?id=" + deleteId;
    }
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