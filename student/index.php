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

<?php
include('../views/header-student.php');
?>
<script>
  var element = document.getElementById("dashboard");
  element.classList.add("active");
</script>

  <center>

    <!-- Content, Tables, Forms, Texts, Images started -->
    <div class="row">
      <div class="content">
        <p>Welcome Student :)</p>
        <img src="../img/tcr.png" height="200px" width="300px" />

      </div>

    </div>
    <!-- Contents, Tables, Forms, Images ended -->

  </center>

<?php
include('../views/footer.php');
?>