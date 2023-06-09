<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
elseif($_SESSION['role']=='teacher')
{
  header('location: ../teacher/index.php');
}
elseif ($_SESSION['role']=='admin') {
  header('location: ../admin/index.php');
}
?>
<?php include('connect.php'); ?>

<?php
include('../views/header-student.php');
?>
<script>
  var element = document.getElementById("report");
  element.classList.add("active");
</script>

  <center>

    <!-- Content, Tables, Forms, Texts, Images started -->
    <div class="row">

      <div class="content">
        <h3>Student Report</h3>
        <br>
        <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">

          <div class="form-group">

            <label for="input1" class="col-sm-3 control-label">Select Subject</label>
            <div class="col-sm-4">
              <select name="whichcourse" id="input1">
                <!-- <option value="da">Data Analytics</option>
                <option value="ml">Machine Learning</option>
                <option value="cg">Computer Graphics</option>
                <option value="cn">Computer Network and Internet Protocol</option>
                <option value="cd">Compiler Design</option>
                <option value="pm">Project Management</option>
                <option value="sd">Skill Development</option>
                <option value="aws">Amazon Web Services</option> -->
                <option value="algo">Algo</option>

              </select>
            </div>

          </div>

          <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Your Reg. No.</label>
            <div class="col-sm-7">
              <input type="text" name="sr_id" class="form-control" id="input1" placeholder="enter your reg. no." />
            </div>
          </div>
          <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
        </form>

        <div class="content"><br></div>

        <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
          <table class="table table-striped">

            <?php

            //checking the form for ID
            if (isset($_POST['sr_btn'])) {

              //initializing ID 
              $sr_id = $_POST['sr_id'];
              $course = $_POST['whichcourse'];

              $i = 0;
              $count_pre = 0;

              //query for searching respective ID
              //  $all_query = mysql_query("select * from reports where reports.st_id='$sr_id' and reports.course = '$course'");
              //  $count_tot = mysql_num_rows($all_query);
              $all_query = mysqli_query($link, "select stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course' and attendance.st_status='Present'");
              $singleT = mysqli_query($link, "select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course'");
              $count_tot;
              if ($row = mysqli_fetch_row($singleT)) {
                $count_tot = $row[0];
              }

              while ($data = mysqli_fetch_array($all_query)) {
                $i++;
                //  if($data['st_status'] == "Present"){
                //     $count_pre++;
                //  }
                if ($i <= 1) {
                  ?>


                  <tbody>
                    <tr>
                      <td>Registration No.: </td>
                      <td>
                        <?php echo $data['stat_id']; ?>
                      </td>
                    </tr>

                    <tr>
                      <td>Total Class (Days): </td>
                      <td>
                        <?php echo $count_tot; ?>
                      </td>
                    </tr>

                    <tr>
                      <td>Present (Days): </td>
                      <td>
                        <?php echo $data[1]; ?>
                      </td>
                    </tr>

                    <tr>
                      <td>Absent (Days): </td>
                      <td>
                        <?php echo $count_tot - $data[1]; ?>
                      </td>
                    </tr>

                  </tbody>

                  <?php

                }
              }
            }
            ?>
          </table>
        </form>
      </div>

    </div>
    <!-- Contents, Tables, Forms, Images ended -->

  </center>

<?php
include('../views/footer.php');
?>