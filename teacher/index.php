<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
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

</body>
</html>
