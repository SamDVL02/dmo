<?php

require_once "inc/session.php";
require_once "inc/db.php";
require_once "inc/function.php";
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
if (isset($_POST["submit"])) {
    $first_name = trim($_POST["first_name"]);
    $middle_name = trim($_POST["middle_name"]);
    $last_name = trim($_POST["last_name"]);
    $station_id = trim($_POST["station_id"]);
    $role = trim($_POST["role"]);
    $designation = trim($_POST["designation"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST["phone"]);
    $password = random_int(1000, 99999);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $datetime = date('Y-m-d H:i:s');
    $message = "Hello, ".$first_name." "."<br> Password is ".$password;
    $phoneNumber = '255' . substr($phone, 1);
    if (!$email) {
        echo "<script>alert('Invalid email format'); window.location.href='register.php';</script>";
        exit;
    }
    $stmtPhone = $conn->prepare("SELECT COUNT(*) FROM users WHERE phone = :phone");
    $stmtPhone->execute(['phone' => $phone]);
    $exists = $stmtPhone->fetchColumn();
    $sqlEmail = "SELECT COUNT(*) FROM users WHERE email = :email";
    $stmtEmail = $conn->prepare($sqlEmail);
    $stmtEmail->execute(['email' => $email]);
    $existEmail = $stmtEmail->fetchColumn();
    if ($existEmail) {
        echo "<script>alert('Email already exists'); window.location.href='users.php';</script>";
        exit;
    }
    if ($exists) {
        echo "<script>alert('Phone number already exists'); window.location.href='users.php';</script>";
        exit;
    }
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = "profile_pictures/"; 
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDirectory . uniqid() . '_' . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath; 
        } else {
            echo "<script>alert('Failed to upload image'); window.location.href='register.php';</script>";
            exit;
        }
    }
    $sql = "INSERT INTO users (first_name, middle_name, lat_name, email, phone, designation, role, password_hash, station_id, last_active_at, picture_path, first_login) 
            VALUES (:first_name, :middle_name, :last_name, :email, :phone, :designation, :role, :password_hash, :station_id, :last_active_at, :picture_path, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':first_name', $first_name);
    $stmt->bindValue(':middle_name', $middle_name);
    $stmt->bindValue(':last_name', $last_name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':designation', $designation);
    $stmt->bindValue(':role', $role);
    $stmt->bindValue(':password_hash', $password_hash);
    $stmt->bindValue(':station_id', $station_id);
    $stmt->bindValue(':last_active_at', $datetime);
    $stmt->bindValue(':picture_path', $imagePath);
    $result = $stmt->execute();

    if ($result) {
        $mail = new PHPMailer(true);
        try {
          
            $mail->isSMTP();                                          
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                
            $mail->Username   = 'massamugeorge@gmail.com';           
            $mail->Password   = 'fudf nvcl ovsr qhpa';              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     
            $mail->Port       = 587;                                
            $mail->setFrom('massamugeorge@gmail.com', 'George Massamu');
            $mail->addAddress($email, $first_name); 
            $mail->isHTML(true); 
            $mail->Subject = 'Welcome to DMO';
            $mail->Body    = "Hello $first_name,<br><br>Your randomly generated password is: <strong>$password</strong><br><br>Thank you for registering!";
            $mail->AltBody = "Hello $first_name,\n\nYour randomly generated password is: $password\n\nThank you for registering!";
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $_SESSION["SuccessMessage"] = "User added successfully";
        Redirect_to("all-users.php");
    } else {
        echo "<div class='alert alert-danger'>Oops! Something went wrong.</div>";
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
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DMO</title>
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
    #drop-area {
        border: 2px dashed #0088cc;
        border-radius: 20px;
        width: 300px;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s;
        margin-bottom: 20px;
    }

    #drop-area.highlight {
        background-color: #e0f7fa;
    }

    #file-upload-status {
        margin-top: 10px;
    }
    </style>
</head>
<body>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include "inc/navbar.php"; ?>
        <div class="dashboard-page-one">
            <?php include "inc/sidebar.php"; ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3><b><?php echo $name ?> Station</b></h3>
                </div>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3><b>User Registration</b></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="new-added-form" method="POST" action="users.php"
                                            enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name" class="form-control" required>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" name="middle_name" class="form-control">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" class="form-control" required>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" id="phone" name="phone" class="form-control"
                                                        pattern="^0\d{9}$" placeholder="0690349378" required>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Designation</label>
                                                    <select name="designation" class="form-control">
                                                        <option value=""></option>
                                                        <option value="met assistant">Met Assistant</option>
                                                        <option value="meterologist">Meterologist</option>
                                                        <option value="incharge">Incharge</option>
                                                        <option value="manager">Manager</option>
                                                        <option value="dg">DG</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Role</label>
                                                    <select name="role" class="form-control" required>
                                                        <option value=""></option>
                                                        <option value="admin">Admin</option>
                                                        <option value="super-user">Super User</option>
                                                        <option value="user">User</option>
                                                        <option value="mcc">MCC</option>
                                                        <option value="mcto">MCTO</option>
                                                        <option value="dg">DG</option>
                                                        <option value="cfo">CFO</option>
                                                        <option value="data">DATA</option>
                                                        <option value="dra">DRA</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Station</label>
                                                    <select name="station_id" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                $sql = "SELECT id, name FROM station";
                                                $stmt = $conn->query($sql);
                                                $stations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($stations as $station) : ?>
                                                        <option value="<?php echo $station['id']; ?>">
                                                            <?php echo $station['name']; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Profile Picture</label>
                                                    <div id="drop-area">
                                                        <input type="file" name="image" id="fileElem" accept="image/*"
                                                            class="form-control" style="display:none;">
                                                        <label for="fileElem" id="fileLabel">Drag & Drop or Click to
                                                            Upload</label>
                                                        <p id="file-upload-status"></p>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group mg-t-8">
                                                    <button type="submit" name="submit"
                                                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                    <button type="reset"
                                                        class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                        <script>
                                        const dropArea = document.getElementById('drop-area');
                                        const fileElem = document.getElementById('fileElem');
                                        const fileLabel = document.getElementById('fileLabel');
                                        const fileUploadStatus = document.getElementById('file-upload-status');
                                        dropArea.addEventListener('dragover', (event) => {
                                            event.preventDefault();
                                            dropArea.classList.add('highlight');
                                        });
                                        dropArea.addEventListener('dragleave', () => {
                                            dropArea.classList.remove('highlight');
                                        });
                                        dropArea.addEventListener('drop', (event) => {
                                            event.preventDefault();
                                            dropArea.classList.remove('highlight');
                                            const files = event.dataTransfer.files;
                                            if (files.length) {
                                                fileElem.files = files;
                                                fileLabel.textContent = files[0].name;
                                                fileUploadStatus.textContent = "File ready to upload.";
                                            }
                                        });
                                        dropArea.addEventListener('click', () => {
                                            fileElem.click();
                                        });
                                        fileElem.addEventListener('change', (event) => {
                                            const files = event.target.files;
                                            if (files.length) {
                                                fileLabel.textContent = files[0].name;
                                                fileUploadStatus.textContent = "File ready to upload.";
                                            }
                                        });
                                        </script>
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