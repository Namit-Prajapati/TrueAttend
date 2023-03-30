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
<?php include('connect.php'); ?>

<?php
include('../views/header-teacher.php');
?>
<script>
  var element = document.getElementById("report");
  element.classList.add("active");
</script>


  <center>

    <div class="row">

      <div class="content">
        <h3>Individual Report</h3>

        <form method="post" action="">

          <label>Select Subject</label>
          <select name="whichcourse">
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

          <p> </p>
          <label>Student Reg. No.</label>
          <input type="text" name="sr_id">
          <input type="submit" name="sr_btn" value="Go!">

        </form>

        <h3>Mass Report</h3>

        <form method="post" action="">

          <label>Select Subject</label>
          <select name="course">
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
          <p> </p>
          <label>Date ( yyyy-mm-dd )</label>
          <input type="text" name="date">
          <input type="submit" name="sr_date" value="Go!">
        </form>

        <br>

        <br>

        <?php

        if (isset($_POST['sr_btn'])) {

          $sr_id = $_POST['sr_id'];
          $course = $_POST['whichcourse'];

          $single = mysqli_query($link, "select stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course' and attendance.st_status='Present'");
          $singleT = mysqli_query($link, "select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.course = '$course'");
          //  $count_tot = mysql_num_rows($singleT);
        }

        if (isset($_POST['sr_date'])) {

          $sdate = $_POST['date'];
          $course = $_POST['course'];

          $all_query = mysqli_query($link, "select * from attendance where reports.stat_date='$sdate' and reports.course = '$course'");

        }
        if (isset($_POST['sr_date'])) {

          ?>

          <table class="table table-stripped">
            <thead>
              <tr>
                <th scope="col">Reg. No.</th>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col">Batch</th>
                <th scope="col">Date</th>
                <th scope="col">Attendance Status</th>
              </tr>
            </thead>


            <?php

            $i = 0;
            while ($data = mysqli_fetch_array($all_query)) {

              $i++;

              ?>
              <tbody>
                <tr>
                  <td>
                    <?php echo $data['st_id']; ?>
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
                    <?php echo $data['stat_date']; ?>
                  </td>
                  <td>
                    <?php echo $data['st_status']; ?>
                  </td>
                </tr>
              </tbody>

              <?php
            }
        }
        ?>

        </table>


        <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
          <table class="table table-striped">

            <?php


            if (isset($_POST['sr_btn'])) {

              $count_pre = 0;
              $i = 0;
              $count_tot;
              if ($row = mysqli_fetch_row($singleT)) {
                $count_tot = $row[0];
              }
              while ($data = mysqli_fetch_array($single)) {
                $i++;

                if ($i <= 1) {
                  ?>


                  <tbody>
                    <tr>
                      <td>Student Reg. No: </td>
                      <td>
                        <?php echo $data['stat_id']; ?>
                      </td>
                    </tr>

                    <?php
                    //}
              
                    // }
              
                    ?>

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

  </center>

  <?php
include('../views/footer.php');
?>