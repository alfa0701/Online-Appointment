<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Patient System</title>

      <!-- CSS External -->
      <link rel="stylesheet" type="text/css" href="lib/materialize/css/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="lib/font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="lib/sweetalert-master/dist/sweetalert.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/margins.css">
</head>
<body class="signin-bg">

      <form method="POST" action="include/patient_signinfunc.php">
                <div class="card card-content-style">
                      <div class="card-header center-align">
                              <h5 class="white-text">Sign In</h5>
                      </div>
                      <div class="card-content">
                            <div class="input-field col s12">
                                  <input type="text" id="username" name="username" required>
                                  <label for="username">Username</label>
                            </div>
                            <div class="input-field col s12">
                                  <input type="password" id="password" name="password" required>
                                  <label for="password">Password</label>
                            </div>
                            <button name="btn-signin" class="waves-effect waves-light btn blue btn btn-max-width">Sign In</button>
                      </div><!--End of card-content-->
                </div><!--End of card-->
          </form>

      <!-- JS External -->
      <script type="text/javascript" src="lib/materialize/js/jquery.min.js"></script>
      <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="js/initialize.js"></script>
</body>
</html>
