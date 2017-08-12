<?php
      session_start();

      $doctorID = $_SESSION['doctor_ID'];
      $firstname = $_SESSION['firstname'];
      $lastname = $_SESSION['lastname'];
      $specialization = $_SESSION['specialization'];
      $username = $_SESSION['username'];
      $status = $_SESSION['status'];
?>
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
<body>
      <header class="navbar-fixed">
            <nav class="white nav-style">
                  <div class="nav-wrapper">
                        <div class="wrapper">
                              <a href="#" class="brand-logo"><img class="responsive-img margin-top" src="img/logo.png" height="200px" width="200px"></a>
                              <ul id="nav-mobile" class="right hide-on-med-and-down">
                                    <!-- <li><a class="waves-effect waves-light btn blue" href="include/signoutfunc.php">Sign Out</a></li> -->
                                     <li><a class="dropdown-button black-text" href="#!" data-activates="dropdown1"><?php echo"$firstname $lastname";?> <i class="fa fa-angle-down"></i></a></li>
                              </ul>
                              <ul id="dropdown1" class="dropdown-content">
                                <li><a class="" href="include/doctor_signoutfunc.php">Sign Out</a></li>
                              </ul>
                        </div>
                  </div>
            </nav>
      </header>

      <main>
        <div class="container">
          <div class="row margin-top">
            <div class="col s12 m12 l12">
              <table class="bordered highlight">
                <thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Phone No</th>
                    <th>Appointment Date</th>
                    <th>Gender</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include 'include/connect.php';

                    $sql = "SELECT * FROM appointment WHERE doctor_ID = $doctorID";
                    $result = $conn->query($sql);

                    if($result -> num_rows > 0){
                      while($rows = $result -> fetch_assoc()){
                        $firstname = $rows['pa_firstname'];
                        $lastname = $rows['pa_lastname'];
                        $phone_no = $rows['phone_no'];
                        $appointment_date = $rows['appointment_date'];
                        $gender = $rows['gender'];
                        $message = $rows['message'];

                        echo"<tr>";
                          echo"<td>$firstname</td>";
                          echo"<td>$lastname</td>";
                          echo"<td>$phone_no</td>";
                          echo"<td>$appointment_date</td>";
                          echo"<td>$gender</td>";
                          echo"<td>$message</td>";
                        echo"</tr>";
                      }
                    }else{

                    }
                    $conn->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>

      <!-- JS External -->
      <script type="text/javascript" src="lib/materialize/js/jquery.min.js"></script>
      <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="js/initialize.js"></script>
</body>
</html>
