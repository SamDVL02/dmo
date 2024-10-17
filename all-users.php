<?php include "inc/header.php"  ?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITAL METEOROLOGICAL OBSERVATORY</title>
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
<div id="wrapper" class="wrapper bg-ash">
    <?php include "inc/navbar.php"  ?>
    <div class="dashboard-page-one">
        <?php include "inc/sidebar.php"  ?>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>All Library Users</li>
                </ul>
            </div>
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Users</h3>
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
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Designation</th>
                                    <th>Role</th>
                                    <th>Station</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql="SELECT * FROM users WHERE 1";
                                if(@$username!= '') {
                                    $sql.=" and username like '%".$username."%'";
                                }
                                $iduser=0;
                                $stmt = $conn->query($sql);
                                while ($rows = $stmt->fetch()) {
                                    $id=$rows["id"];
                                    $station_id = $rows['station_id'];
                                    $sql1 = "SELECT name FROM station WHERE id = $station_id";
                                    $stmt1 = $conn->query($sql1);
                                    $rows1 = $stmt1->fetch();
                                    $station_name = $rows1['name'];
                                    $iduser++;
                                ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label"><?php echo($iduser) ?></label>
                                        </div>
                                    </td>
                                    <td><?php echo $rows['first_name'] ?></td>
                                    <td><?php echo $rows['middle_name'] ?> </td>
                                    <td><?php echo $rows['lat_name'] ?></td>
                                    <td><?php echo $rows['email'] ?></td>
                                    <td><?php echo $rows['phone']?></td>
                                    <td><?php echo $rows['designation']?></td>
                                    <td><?php echo $rows['role'] ?></td>
                                    <td><?php echo $station_name ?></td>
                                    <td>
                                        <a href="edituser.php?id=<?php echo $id; ?>"><span class="btn btn-warning">Edit</span></a>
                                        <?php if($_SESSION["role"] == "admin"){ ?>
                                        <a href="#" onclick='openModal(<?php echo $id; ?>); return false;'><span class="btn btn-danger">Delete</span></a>
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

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete this user?</p>
        <div class="modal-buttons">
            <button id="confirmDelete" onclick="confirmDelete()">Yes</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<!-- Modal Styles -->
<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transform: translateY(-30px);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .modal-content p {
        font-size: 18px;
        color: #333;
        margin-bottom: 20px;
    }

    .modal-buttons {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .modal-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .modal-buttons #confirmDelete {
        background-color: #d9534f;
        color: white;
    }

    .modal-buttons #confirmDelete:hover {
        background-color: #c9302c;
    }

    .modal-buttons button:last-child {
        background-color: #5bc0de;
        color: white;
    }

    .modal-buttons button:last-child:hover {
        background-color: #31b0d5;
    }

    /* Smooth modal opening */
    .modal.active .modal-content {
        transform: translateY(0);
        opacity: 1;
    }
</style>

<!-- Scripts -->
<script>
    let deleteId = null;

    function openModal(id) {
        deleteId = id;
        const modal = document.getElementById('deleteModal');
        modal.style.display = "flex";
        setTimeout(() => {
            modal.classList.add("active");
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove("active");
        setTimeout(() => {
            modal.style.display = "none";
        }, 300);
    }

    function confirmDelete() {
        window.location.href = "deleteuser.php?id=" + deleteId;
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
