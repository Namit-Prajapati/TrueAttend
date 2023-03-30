<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
elseif($_SESSION['role']=='admin')
{
  header('location: ../admin/index.php');
}
elseif ($_SESSION['role']=='student') {
  header('location: ../student/index.php');
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
        sleep(5);
        for($i = 0; $i<3; $i++){
            $jsonString = file_get_contents("http://127.0.0.1:5000/recognize");
            // $path = '../ml model/Student_Attendence.json';
            // $jsonString = file_get_contents($path);
            $present_st = json_decode($jsonString, true);
            $total_arr = array_merge($total_arr,$present_st);
            if($i == 2){
              continue;
            }
            $random = rand(5,30);
            sleep($random);       //here '5' means 5 seconds...
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

<?php
include('../views/header-teacher.php');
?>
<script>
  var element = document.getElementById("mark");
  element.classList.add("active");
</script>

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