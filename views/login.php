<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>TrueAttend</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons"
    />
    <link rel="stylesheet" href="../css/login.css" />
  </head>
  <body>
    <!-- partial:index.partial.html -->
    <!-- Form-->
    <div class="form">
      <div class="form-toggle"></div>
      <div class="form-panel one">
        <div class="form-header">
          <h1>Account Login</h1>
        </div>
        <div class="form-content">
          <form>
            <div class="form-group">
              <label for="username-login">Username</label>
              <input
                type="text"
                id="username-login"
                name="username-login"
                required="required"
              />
            </div>
            <div class="form-group">
              <label for="password-login">Password</label>
              <input
                type="password"
                id="password-login"
                name="password-login"
                required="required"
              />
            </div>

            <div  style="width: 100%; padding: 10px;">
              <div class="col-sm-7" style="display: flex">
                <label style="flex: 1">
                  <input
                    class="login-radio"
                    type="radio"
                    name="login-radio"
                    id="optionsRadios1"
                    value="student"
                    checked
                  />
                  Student
                </label>
                <label style="flex: 1">
                  <input
                    class="login-radio"
                    type="radio"
                    name="login-radio"
                    id="optionsRadios1"
                    value="teacher"
                  />
                  Teacher
                </label>
                <label style="flex: 1">
                  <input
                    class="login-radio"
                    type="radio"
                    name="login-radio"
                    id="optionsRadios1"
                    value="admin"
                  />
                  Admin
                </label>
              </div>
            </div>

            <div class="form-group" style="display:flex">
              <a class="form-recovery form-link" href="#">Forgot Password?</a>
              <a class="form-recovery form-link" href="#">Signup</a>
            </div>
            <div class="form-group">
              <button type="submit">Log In</button>
            </div>
          </form>
        </div>
      </div>
      
    </div>
    
    <!-- partial -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://codepen.io/andytran/pen/vLmRVp.js"></script>
    <script src="./script.js"></script> -->
  </body>
</html>
