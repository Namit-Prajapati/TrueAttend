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
include('../views/header-teacher.php');
?>
<script>
  var element = document.getElementById("dashboard");
  element.classList.add("active");
</script>

<center>

<div class="row">
    <div class="content">
      <p>One step solution for your class room :)</p>
    <img src="../img/tcr.png" height="200px" width="300px" />

  </div>

</div>

</center>

<?php
include('../views/footer.php');
?>
