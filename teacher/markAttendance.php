<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'oasis') {
  header('location: login.php');
}
?>
<?php
include('connect.php');
?>

<?php
try {

    if (isset($_POST['att'])) {
        $total_arr = array();
        $final_arr = array();
        for($i = 0; $i<3; $i++){
            $jsonString = file_get_contents("http://127.0.0.1:5000/recognize");
            // $path = '../ml model/Student_Attendence.json';
            // $jsonString = file_get_contents($path);
            $present_st = json_decode($jsonString, true);
            $total_arr = array_merge($total_arr,$present_st);
            sleep(5);       //here '5' means 5 seconds...
        }
        $cnt_total = array_count_values($total_arr);
        foreach ($cnt_total as $key => $value) {
            if($value>1){
                array_push($final_arr,$key);
            }
        }
        $batch = 2020;
        $all_query = mysqli_query($link, "select * from students where st_batch='$batch' order by st_id asc");
        while ($data = mysqli_fetch_array($all_query)) {
            $dp = date('Y-m-d');
            $course = 'algo';
            $st_present = 'Absent';
            if(in_array($data['st_id'], $final_arr)){
                $st_present = 'Present';
            }
            $qry = mysqli_query($link, "insert into attendance(stat_id,course,st_status,stat_date) values('".$data['st_id']."','$course','$st_present','$dp')");
        }
        $att_msg = "Attendance Marked.";
    }
  } catch (Execption $e) {
    $error_msg = $e->$getMessage();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>TrueAttend</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

  <link rel="stylesheet" href="styles.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <style type="text/css">
    .status {
      font-size: 10px;
    }
  </style>

</head>

<body>

  <header>

    <h1>TrueAttend</h1>
    <div class="navbar">
      <a href="index.php">Home</a>
      <a href="students.php">Students</a>
      <a href="teachers.php">Faculties</a>
      <a href="markAttendance.php">Mark Attendance</a>
      <a href="attendance.php">Attendance</a>
      <a href="report.php">Report</a>
      <a href="../logout.php">Logout</a>

    </div>

  </header>

  <center>

    <div class="row">

      <div class="content">
        <h3>Attendance of
          <?php echo date('Y-m-d'); ?>
        </h3>
        <br>

        <center>
          <p>
            <?php if (isset($att_msg))
              echo $att_msg;
            if (isset($error_msg))
              echo $error_msg; ?>
          </p>
        </center>

        <form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">

          <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Mark!!" name="att" />

        </form>

        

          
      </div>

    </div>

  </center>

</body>

</html>