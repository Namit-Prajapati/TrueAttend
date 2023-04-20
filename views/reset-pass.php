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
  <div class="form">
    <div class="form-toggle"></div>
    <div class="form-panel one">
      <div class="form-header">
        <h1>Reset Password</h1>
      </div>
      <center>
        <?php
        //printing error message
        if (isset($error_msg)) {
          echo '<div style="margin-top:-20px">' . 'Email is not associated with any account. Contact Admin' . '</div>';
        }
        ?>
      </center>
      <div class="form-content">
        <form method="post">
          <div class="form-group">
            <label for="username-login">Email</label>
            <input type="email" id="email" name="email" required="required" />
          </div>

          <div class="form-group">
            <button type="submit" value="Go" name="reset">Reset</button>
          </div>
          <center>
            <div class="form-group" style="">
              Go back to, <a class="form-recovery form-link" style="font-size:15px;"
                href="./index.php">Login</a>
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