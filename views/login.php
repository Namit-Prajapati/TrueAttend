<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>TrueAttend</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" />
  <link rel="stylesheet" href="./css/login.css" />
  
</head>

<body>
  <!-- partial:index.partial.html -->
  <!-- Form-->
  <div style="height:50px;background-color:#333;font-size:30px;display:flex;align-items:center"> <span style="margin:20px;color:white"> TrueAttend</span></div>
  <div class="form">
    <div class="form-toggle"></div>
    <div class="form-panel one">
      <div class="form-header">
        <h1>Account Login</h1>
      </div>
      <center>
        <?php
        //printing error message
        if (isset($error_msg)) {
          echo '<div style="margin-top:-20px">' . $error_msg . '</div>';
        }
        ?>
      </center>
      <div class="form-content">
        <form method="post">
          <div class="form-group">
            <label for="username-login">Username</label>
            <input type="text" id="username-login" name="username" required="required" />
          </div>
          <div class="form-group">
            <label for="password-login">Password</label>
            <input type="password" id="password-login" name="password" required="required" />
          </div>

          <div style="width: 100%; padding: 10px;">
            <div class="col-sm-7" style="display: flex;font-size:18px;font-weight:400">
              <label style="flex: 1">
                <input class="login-radio" type="radio" name="type" id="optionsRadios1" value="student" checked />
                Student
              </label>
              <label style="flex: 1">
                <input class="login-radio" type="radio" name="type" id="optionsRadios1" value="teacher" />
                Teacher
              </label>
              <label style="flex: 1">
                <input class="login-radio" type="radio" name="type" id="optionsRadios1" value="admin" />
                Admin
              </label>
            </div>
          </div>

          <div class="form-group" style="display:flex;">
            <a class="form-recovery form-link" style="font-size:15px;" href="./reset.php">Forgot Password?</a>
          </div>
          <div class="form-group">
            <button type="submit" value="Login" name="login">Log In</button>
          </div>
          <center>
            <div class="form-group" style="">
              Don't have an account, <a class="form-recovery form-link" style="font-size:15px;"
                href="./signup.php">Signup</a>
            </div>
          </center>
        </form>
      </div>
    </div>

  </div>

  <!-- partial -->
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://codepen.io/andytran/pen/vLmRVp.js"></script>
    <script src="./script.js"></script> -->