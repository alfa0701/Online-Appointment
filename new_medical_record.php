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
                        </div>
                  </li>
                  <li class="active"><a class="waves-effect" href="dashboard.php"><span class="fa fa-line-chart black-text fa-lg"></span> Dashboard</a></li>
                  <li><a class="waves-effect" href="appointment.php"><span class="fa fa-bell black-text fa-lg"></span> Appointment <span class="new badge" data-badge-caption="">
                        <?php
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
                  <li><a class="waves-effect" href="addpatient.php"><span class="fa fa-user-plus black-text fa-lg"></span> Add Patient</a></li>
                  <li><a class="waves-effect" href="#!"><span class="fa fa-vcard black-text fa-lg"></span> Patient List</a></li>
                  <li>
                        <div class="divider"></div>
                  </li>
                  <li><a class="subheader">Doctor</a></li>
                  <li><a class="waves-effect" href="#!"><span class="fa fa-user-md black-text fa-lg"></span> Add Doctor</a></li>
                  <li><a class="waves-effect" href="#!"><span class="fa fa-vcard black-text fa-lg"></span> Doctor List</a></li>
                  <li>
                        <div class="divider"></div>
                  </li>
                  <li><a class="waves-effect waves-light btn red darken-2" href="include/signoutfunc.php">Sign Out</a></li>
            </ul>
      </header>

      <main class="main-content">
            <div class="row">
                  <a href="<?php $getid = $_GET['patientID']; echo"view_patient.php?patientID=$getid";?>" class="waves-effect waves-light btn blue margin-small-top margin-small-left margin-small-bottom"><i class="fa fa-caret-left"></i> Back</a>
                  <div class="col s12 m12 l12">
                        <div class="card">
                              <div class="card-content">
                                    Patient Information:
                                    <?php
                                          $getid = $_GET['patientID'];

                                          $sql="SELECT  patient_ID, firstname, lastname, middlename, home_address, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dateofbirth)), '%Y')+0 AS age, dateofbirth FROM patient_info WHERE patient_ID = $getid";

                                          $result = $conn->query($sql);

                                          if($result -> num_rows > 0){
                                                while($rows = $result -> fetch_assoc()){
                                                      $patientID = $rows['patient_ID'];
                                                      $firstname = $rows['firstname'];
                                                      $lastname = $rows['lastname'];
                                                      $middlename = $rows['middlename'];
                                                      $home_address = $rows['home_address'];
                                                      $age = $rows['age'];
                                                      $dateofbirth = $rows['dateofbirth'];

                                                      echo"<span class='card-title'>$firstname $middlename, $lastname</span>";
                                                      echo"<p><strong>Age: </strong> $age</p>";
                                                      echo"<p><strong>Birth Day: </strong> $dateofbirth</p>";
                                                      echo"<p><strong>Home Address: </strong> $home_address</p>";
                                                }
                                          }else{
                                                echo"0";
                                          }
                                    ?>
                              </div><!--End of card-content-->
                        </div><!--End of card-->
                  </div><!--End of col-->
            </div><!--End of row-->

            <div class="row margin-xxxlarge-bottom">
                  <div class="col s12 m12 l12">
                        <form method="POST" action="<?php $getid = $_GET['patientID']; echo"include/add_new_medical_record.php?patientID=$getid";?>">
                        <div class="card medical-record z-depth-2">
                              <div class="card-header center-align">
                                    <h5 class="white-text">Medical Record</h5>
                              </div>
                              <div class="card-content">
                                    <p>Physical Characteristics:</p>

                                    <div class="input-field col s6">
                                          <input type="number" id="height" name="height">
                                          <label for="height">Height (cm)</label>
                                    </div>

                                    <div class="input-field col s6">
                                          <input type="number" id="weight" name="weight">
                                          <label for="weight">Weight (lbs)</label>
                                    </div>

                                    <div class="input-field col s6">
                                          <input type="number" id="temp" name="temp">
                                          <label for="temp">Temperature (°C)</label>
                                    </div>

                                    <div class="input-field col s6">
                                          <input type="text" id="bp" name="bp">
                                          <label for="bp">Blood Pressure</label>
                                    </div>

                                    <span>Findings: </span>
                                    <div class="input-field col s12">
                                          <textarea id="findings" class="materialize-textarea" name="disease"></textarea>
                                          <label for="findings">Disease</label>
                                    </div>

                                    <div class="input-field col s12">
                                          <select name="doctorID">
                                                <option value="" disabled selected>Choose Doctor</option>
                                                <?php
                                                      include 'include/connect.php';

                                                      $sql="SELECT * FROM doctor_info";
                                                      $result = $conn->query($sql);

                                                      if($result -> num_rows > 0){
                                                            while($rows = $result -> fetch_assoc()){
                                                                  $doctorID = $rows['doctor_ID'];
                                                                  $fname = $rows['firstname'];
                                                                  $lname = $rows['lastname'];
                                                                  $specialization = $rows['specialization'];

                                                                  echo"<option value='$doctorID'>$fname $lname - $specialization</option>";
                                                            }
                                                      }else{

                                                      }
                                                      $conn->close();
                                                ?>
                                          </select>
                                          <label>Doctor List</label>
                                    </div>

                                    <div class="center-align">
                                          <button class="waves-effect waves-light btn blue">Add Record</button>
                                    </div>
                              </div><!--End of card-content-->
                        </div><!--End of card-->
                  </form>
                  </div><!--End of col-->
            </div><!--End of row-->
      </main>
      <!-- JS External -->
      <script type="text/javascript" src="lib/materialize/js/jquery.min.js"></script>
      <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="js/initialize.js"></script>
</body>
</html>
