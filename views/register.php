<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TrueAttend</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" />
  <link rel="stylesheet" href="./css/login.css" />
  <title>Document</title>
</head>

<body>
<div style="height:50px;background-color:#333;font-size:30px;display:flex;align-items:center"> <span style="margin:20px;color:white"> TrueAttend</span></div>
  <div class="form-panel two" style="margin:5% 25%">
    <div class="form-header">
      <h1>Register Account</h1>
    </div>
    <center>
      <?php
      if (isset($success_msg))
        echo '<div style="margin-top:-20px;color:white">' . $success_msg . '</div>';
      if (isset($error_msg))
        echo '<div style="margin-top:-20px;color:white">' . $error_msg . '</div>';
      ?>
    </center>
    <div class="form-content">
      <form method="post">
        <div class="form-group">
          <label for="username">Email</label>
          <input type="email" id="email" name="email" required="required" />
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="uname" required="required" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="pass" required="required" />
        </div>
        <div class="form-group">
          <label for="full name">Full Name</label>
          <input type="text" id="full Name" name="fname" required="required" />
        </div>
        <div class="form-group">
          <label for="phone Number">Phone Number</label>
          <input type="tel" id="phone Number" name="phone" required="required" />
        </div>

        <div style="width: 100%; padding: 10px;color:white">
          <div class="col-sm-7" style="display: flex">
            <label style="flex: 1">
              <input type="radio" name="type" id="optionsRadios1" value="student" checked />
              Student
            </label>
            <label style="flex: 1">
              <input type="radio" name="type" id="optionsRadios1" value="teacher" />
              Teacher
            </label>
          </div>
        </div>


        <div class="form-group">
          <button type="submit" value="Signup" name="signup">Register</button>
        </div>
        <center>
          <div class="form-group" style="color:white">
            Already have an account, <a class="form-recovery form-link" style="font-size:15px;font-weight:500;"
              href="./index.php"> <span style="color:#0d6efd"> Login</span></a>
          </div>
        </center>
      </form>
    </div>
  </div>
  <div style="height:100px;margin-top:47%" ></div>