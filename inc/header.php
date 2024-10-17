<?php 
include "inc/session.php";
include "inc/function.php";
require_once "inc/db.php";
?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); ?>
 
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
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/modernizr-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/delete.css">
    <link rel="stylesheet" href="css/datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar-main {
            width: 250px;
            background: #333;
            color: #fff;
        }
        .nav-link {
            color: #fff;
        }
        .nav-link i {
            margin-right: 8px;
        }
        .nav-item {
            list-style: none;
        }
        .sidebar-menu-content ul {
            padding: 0;
        }
        .sidebar-menu-content ul .nav {
            padding-left: 0;
        }
        .sub-group-menu {
            display: none;
            padding-left: 20px;
        }
        .nav-item:hover .sub-group-menu {
            display: block;
        }
.header-menu-one {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}
.clock-container {
    flex: 1;
    text-align: right;
    animation: fadeIn 2s ease-in-out;
}

.title-container {
    flex: 2;
    text-align: center;
    animation: fadeIn 2s ease-in-out;
}
.header-admin {
    position: relative;
}
.admin-title {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.modal{
    display:none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}
.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
    animation: slideDown 0.5s ease;
}
@keyframes slideDown {
    from{
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
.modal-buttons button{
    margin: 0 10px;
    padding: 10px 20px;
    cursor: pointer;
}
    </style>
</head>
<body>

   