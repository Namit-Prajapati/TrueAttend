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

    $course = $_POST['whichcourse'];

    foreach ($_POST['st_status'] as $i => $st_status) {

      $stat_id = $_POST['stat_id'][$i];
      $dp = date('Y-m-d');
      $course = $_POST['whichcourse'];

      $stat = mysqli_query($link, "update attendance set st_status = '".$st_status."' where stat_id = '".$stat_id."' and course = '".$course."' and stat_date = '".$dp."'");

      $att_msg = "Attendance Updated.";

    }



  }
} catch (Execption $e) {
  $error_msg = $e->$getMessage();
}
?>

<?php
include('../views/header-teacher.php');
?>
<script>
  var element = document.getElementById("attendance");
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

          <div class="form-group">

            <!-- <label>Select Batch</label>
                
                <select name="whichbatch" id="input1">
                      <option name="eight" value="38">38</option>
                      <option name="seven" value="37">37</option>
                </select>-->


            <label>Enter Batch</label>
            <input type="text" name="whichbatch" id="input2" placeholder="Only 2020">
          </div>

          <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Show!" name="batch" />

        </form>

        <div class="content"></div>
        <form action="" method="post">

          <div class="form-group">

            <label>Select Subject</label>
            <select name="whichcourse" id="input1">
              <!-- <option value="da">Data Analytics</option> -->
              <option value="ml">Machine Learning</option>
              <!-- <option value="cg">Computer Graphics</option>
              <option value="cn">Computer Network and Internet Protocol</option>
              <option value="cd">Compiler Design</option>
              <option value="pm">Project Management</option>
              <option value="sd">Skill Development</option> -->
              <option value="aws">Amazon Web Services</option>
              <option value="algo">Algorithms</option>
            </select>

          </div>
          <center>
            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Go!" name="go" />
          </center>
        </form>
        <form action="" method="post">
          <table class="table table-stripped">
            <thead>
              <tr>
                <th scope="col">Reg. No.</th>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col">Batch</th>
                <th scope="col">Semester</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <?php

            if (isset($_POST['go'])) {

              $i = 0;
              $radio = 0;
              $batch = 2020;
              $all_query = mysqli_query($link, "select * from students where st_batch='$batch' order by st_id asc");

              while ($data = mysqli_fetch_array($all_query)) {
                $i++;
                ?>

                <body>
                  <tr>
                    <td>
                      <?php echo $data['st_id']; ?> <input type="hidden" name="stat_id[]"
                        value="<?php echo $data['st_id']; ?>">
                    </td>
                    <td>
                      <?php echo $data['st_name']; ?>
                    </td>
                    <td>
                      <?php echo $data['st_dept']; ?>
                    </td>
                    <td>
                      <?php echo $data['st_batch']; ?>
                    </td>
                    <td>
                      <?php echo $data['st_sem']; ?>
                    </td>
                    <td>
                      <?php echo $data['st_email']; ?>
                    </td>
                    <td>
                      <?php
                        $status = mysqli_query($link, "SELECT `st_status` FROM `attendance` WHERE stat_date = CURDATE() and course = '".$_POST['whichcourse']."' and stat_id = '".$data['st_id']."' ");
                        $stat_pre = -1;
                        while ($status_data = mysqli_fetch_array($status)) {
                          $stat_pre = $status_data['st_status'];
                        }
                        $flag = 0;
                      ?>
                      <label>Present</label>
                      <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present" <?php if($stat_pre == "Present"){echo "checked"; $flag = 1;} ?> >
                      <label>Absent </label>
                      <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent" <?php if($stat_pre == "Absent" or $flag == 0){echo "checked";} ?> >
                    </td>
                  </tr>
                </body>

                <?php

                $radio++;
              }
            }
            ?>
          </table>
            <input type="hidden" value="<?php echo $_POST['whichcourse']; ?>" name="whichcourse" />
          <center><br>
            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-10" value="Save!" name="att" />
          </center>

        </form>
      </div>

    </div>

  </center>
<?php
include('../views/footer.php');
?>