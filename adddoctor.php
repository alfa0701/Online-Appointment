<?php
    session_start();
    include'include/connect.php';
    $_SESSION['admin_ID'];
    $role = $_SESSION['role'];
    if(!isset($_SESSION['admin_ID']))
    {
        header("Location: index.php");
    }
    $admin_ID = $_SESSION['admin_ID'];
    $admin_fname = $_SESSION['firstname'];
    $admin_lname = $_SESSION['lastname'];
    $role = $_SESSION['role'];
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
      <header>
            <ul id="slide-out" class="side-nav fixed z-depth-2">
                  <li>
                        <div class="userView">
                              <div class="background">
                                    <img src="img/bg.jpg">
                              </div>
                              <a href="#!user"><img class="circle" src="img/dummy.png"></a>
                              <a href="#!name"><span class="white-text name"><?php echo"$admin_fname $admin_lname";?></span></a>
                              <a href="#!email"><span class="white-text email"><?php echo"$role";?></span></a>
                              <?php
                                   include 'include/connect.php';
                                   $sql="SELECT * FROM appointment_today";
                                   $result = $conn->query($sql);

                                   while($rows = $result -> fetch_assoc()){
                                         $status = $rows['status'];
                                   }
                             ?>
                              <span class="margin-bottom-remove margin-top-remove">Appointment Button</span>
                              <div class="switch margin-top-remove">
                                    <form method="POST">
                                    <label class="white-text"  style="background-color: rgba(0,0,0,0.3); padding: 5px; border-radius: 50px">
                                          Off
                                          <input type="checkbox" name="lever" onchange="autosubmit()" <?php echo"$status";?>>
                                          <span class="lever"></span>
                                          On
                                   </label>
                                    </form>
                             </div>
                        </div>
                  </li>
                  <li><a class="waves-effect" href="dashboard.php"><span class="fa fa-line-chart black-text fa-lg"></span> Dashboard</a></li>
                  <li><a class="waves-effect" href="appointment.php"><span class="fa fa-bell black-text fa-lg"></span> Appointment <span class="new badge" data-badge-caption="">
                        <?php
                              require_once"include/connect.php";
                              $sql="SELECT COUNT(*) as count FROM appointment WHERE status = 'waiting'";
                              $result = $conn->query($sql);

                              if($result -> num_rows > 0){
                                    while($rows = $result -> fetch_assoc()){
                                          $count = $rows['count'];

                                          echo"$count";
                                    }
                              }else{
                                    echo"0";
                              }
                        ?>
                  </span></a></li>
                  <li>
                        <div class="divider"></div>
                  </li>
                  <li><a class="subheader">Patient</a></li>
                  <li class="active"><a class="waves-effect" href="addpatient.php"><span class="fa fa-user-plus black-text fa-lg"></span> Add Patient</a></li>
                  <li><a class="waves-effect" href="patient_list.php"><span class="fa fa-vcard black-text fa-lg"></span> Patient List</a></li>
                  <li>
                        <div class="divider"></div>
                  </li>
                  <li><a class="subheader">Doctor</a></li>
                  <li><a class="waves-effect" href="adddoctor.php"><span class="fa fa-user-md black-text fa-lg"></span> Add Doctor</a></li>
                  <li><a class="waves-effect" href="doctor_list.php"><span class="fa fa-vcard black-text fa-lg"></span> Doctor List</a></li>
                  <li>
                        <div class="divider"></div>
                  </li>
                  <li><a class="waves-effect waves-light btn red darken-2" href="include/signoutfunc.php">Sign Out</a></li>
            </ul>
      </header>

      <main class="main-content">
            <div class="container">
                  <div class="row margin-xlarge-top">
                        <div class="col s12 m12 l12">
                              <form method="POST" action="include/adddoctor_func.php">
                                    <div class="card card-center z-depth-2">
                                          <div class="card-header center-align">
                                                  <h5 class="white-text">Add Doctor</h5>
                                          </div>
                                          <div class="card-content">
                                                <div class="input-field col s6">
                                                      <input type="text" id="firstname" name="firstname" required>
                                                      <label for="firstname">Firstname</label>
                                                </div>
                                                <div class="input-field col s6">
                                                      <input type="text" id="lastname" name="lastname" required>
                                                      <label for="lastname">Lastname</label>
                                                </div>
                                                <div class="input-field col s12">
                                                      <input type="text" id="Specialization" name="specialization" required>
                                                      <label for="Specialization">Specialization</label>
                                                </div>
                                                <div class="input-field col s6">
                                                      <input type="text" id="username" name="username" required>
                                                      <label for="username">Username</label>
                                                </div>
                                                <div class="input-field col s6">
                                                      <input type="password" id="password" name="password" required>
                                                      <label for="password">Password</label>
                                                </div>
                                                <button class="waves-effect waves-light btn blue btn btn-max-width">Add Doctor</button>
                                          </div><!--End of card-content-->
                                    </div><!--End of card-->
                              </form>
                        </div>
                  </div>
            </div>
      </main>
      <!-- JS External -->
      <script type="text/javascript" src="lib/materialize/js/jquery.min.js"></script>
      <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="js/initialize.js"></script>
      <script>
            function autosubmit(){
                  $.ajax({
                        url: 'http://localhost/patientsystem/include/change_lever.php',
                        success: function(data){
                              console.log("Status Change!");
                              alert('Update Success');
                        }
                  });
            }
      </script>
</body>
</html>
