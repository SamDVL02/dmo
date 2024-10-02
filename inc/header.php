<?php 
include "inc/session.php";
include "inc/function.php";
require_once "inc/db.php";

   ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); ?>

<!doctype html>
<html class="no-js" lang="">


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:31:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DMO</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> -->
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/select2.min.css">

    <link rel="stylesheet" href="css/delete.css">
    <!-- Date Picker CSS -->
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

        /* General navbar styling */
.header-menu-one {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

/* Styling for clock and title containers */
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

/* Admin dropdown styling */
.header-admin {
    position: relative;
}

.admin-title {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

/* Animation */
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

       <!-- Header Menu Area Start Here -->
   