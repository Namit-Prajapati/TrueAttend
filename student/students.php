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
  var element = document.getElementById("students");
  element.classList.add("active");
</script>

  <center>

    <div class="row">

      <div class="content">
        <h3>Student List</h3>
        <br>

        <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
          <div class="form-group">
            <label for="input1" class="col-sm-3 control-label">Batch</label>
            <div class="col-sm-7">
              <input type="text" name="sr_batch" class="form-control" id="input1" placeholder="Only 2020" />

            </div>

          </div>
          <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />

        </form>

        <div class="content"></div>
        <table class="table table-striped">

          <thead>
            <tr>
              <th scope="col">Registration No.</th>
              <th scope="col">Name</th>
              <th scope="col">Department</th>
              <th scope="col">Batch</th>
              <th scope="col">Semester</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <?php

          if (isset($_POST['sr_btn'])) {

            $srbatch = 2020;
            $i = 0;

            $all_query = mysqli_query($link, "select * from students where students.st_batch = '$srbatch' order by st_id asc");

            while ($data = mysqli_fetch_array($all_query)) {
              $i++;

              ?>

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
                  <?php echo $data['st_sem']; ?>
                </td>
                <td>
                  <?php echo $data['st_email']; ?>
                </td>
              </tr>

            <?php
            }
          }
          ?>
        </table>

      </div>

    </div>

  </center>

<?php
include('../views/footer.php');
?>