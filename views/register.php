<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TrueAttend</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" />
  <link rel="stylesheet" href="../css/login.css" />
  <title>Document</title>
</head>

<body>

  <div class="form-panel two" style="margin:0 25%">
    <div class="form-header">
      <h1>Register Account</h1>
    </div>
    <div class="form-content">
      <form>
        <div class="form-group">
          <label for="username">Email</label>
          <input type="email" id="email" name="email" required="required" />
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required="required" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required="required" />
        </div>
        <div class="form-group">
          <label for="full name">Full Name</label>
          <input type="text" id="full Name" name="full Name" required="required" />
        </div>
        <div class="form-group">
          <label for="phone Number">Phone Number</label>
          <input type="tel" id="phone Number" name="phone Number" required="required" />
        </div>

        <div style="width: 100%; padding: 10px;color:white">
          <div class="col-sm-7" style="display: flex">
            <label style="flex: 1">
              <input type="radio" name="login-radio" id="optionsRadios1" value="student" checked />
              Student
            </label>
            <label style="flex: 1">
              <input type="radio" name="login-radio" id="optionsRadios1" value="teacher" />
              Teacher
            </label>
          </div>
        </div>


        <div class="form-group">
          <button type="submit">Register</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>