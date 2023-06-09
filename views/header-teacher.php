<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TrueAttend</title>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >


    <style type="text/css">
    .status {
      font-size: 10px;
    }
  </style>


</head>

<body>
    <!-- partial:index.partial.html -->
    <nav class="navbar navbar-expand-custom navbar-mainbg" style="display:flex">
        <a  class="navbar-brand navbar-logo" href="#">TrueAttend</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div style="flex:3" class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li class="nav-item" id="dashboard">
                    <a class="nav-link" href="../teacher/index.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="nav-item" id="students">
                    <a class="nav-link" href="../teacher/students.php"><i class="far fa-address-book"></i>Students</a>
                </li>
                <li class="nav-item" id="faculty">
                    <a class="nav-link" href="../teacher/teachers.php"><i class="far fa-clone"></i>Teachers</a>
                </li>
                <li class="nav-item" id="mark">
                    <a class="nav-link" href="../teacher/markAttendance.php"><i class="far fa-calendar-alt"></i>Mark
                        Attendance</a>
                </li>
                <li class="nav-item" id="attendance">
                    <a class="nav-link" href="../teacher/attendance.php"><i class="far fa-chart-bar"></i>Attendance</a>
                </li>
                <li class="nav-item" id="report" style="margin-right:30px">
                    <a class="nav-link" href="../teacher/report.php"><i class="far fa-copy"></i>Report</a>
                </li>
                <!-- <li class="nav-item">

                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>


                </li> -->
            </ul>
        </div>
        <div style="flex:1;display:flex;
  justify-content: flex-end;" class="navbar-brand navbar-logo flex" >

            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="padding:2px 10px; background-color:#333;border:none">
                <?php
                    echo $_SESSION['username'];
                ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="right:0;
  align-items: end;left: auto;">
                <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <!-- partial -->
    <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script>
    <script src="../script/header.js"></script>
