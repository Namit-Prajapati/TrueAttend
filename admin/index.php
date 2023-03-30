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
elseif ($_SESSION['role']=='student') {
  header('location: ../student/index.php');
}
?>

<?php

include('connect.php');
?>

<?php
include('../views/header-admin.php');
?>
<script>
  var element = document.getElementById("dashboard");
  element.classList.add("active");
</script>
<center>


</center>
<?php
include('../views/footer.php');
?>