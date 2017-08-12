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
                  <li><a class="waves-effect" href="dashboard.php"><span class="fa fa-line-chart black-text fa-lg"></span> Dashboard</a></li>
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
                  <li class="active"><a class="waves-effect" href="#!"><span class="fa fa-vcard black-text fa-lg"></span> Patient List</a></li>
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
                  <a href="patient_list.php" class="waves-effect waves-light btn blue margin-small-top margin-small-left margin-small-bottom"><i class="fa fa-caret-left"></i> Back</a>
                  <div class="col s12 m12 l12">
                        <div class="card">
                              <div class="card-content">
                                    Patient Information:
                                    <?php
                                          $getid = $_GET['patientID'];

                                          $sql="SELECT patient_ID, firstname, lastname, middlename, home_address, DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dateofbirth)), '%Y')+0 AS age, dateofbirth FROM patient_info WHERE patient_ID = $getid";



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

            <div class="row">
                  <form method="POST" action="<?php
                  $getid = $_GET['patientID'];
                   echo"include/search_daterecord.php?patientID=$getid";?>">
                        <div class="input-field col s3">
                              <input type="date" class="datepicker2" id="search" name="search_date">
                              <label for="search">Search Record</label>
                        </div>
                        <button class="waves-effect waves-light btn blue margin-small-top"><span class="fa fa-search"></span> Search</button>

                        <a href="<?php echo"new_medical_record.php?patientID=$getid";?>" class="waves-effect waves-light btn blue margin-small-top right margin-right">New Medical Record</a>
                  </form>
                  <div class="col s12 m12 l12">
                         <ul class="collapsible popout" data-collapsible="accordion">
                        <?php
                              $getid = $_GET['patientID'];

                              if(isset($_GET["date"])){
                                    $sql="SELECT t.transaction_ID, t.patient_ID, t.disease, t.temp, t.height, t.weight, t.blood_pressure, t.doctor_ID, d.firstname, d.lastname, d.specialization, DATE_FORMAT(t.date_transaction, '%e %M, %Y') as date_transaction FROM patient_info pin, transaction t, doctor_info d WHERE t.patient_ID = $getid AND pin.patient_ID = t.patient_ID AND t.doctor_ID = d.doctor_ID AND t.date_transaction=".$_GET['date'];
                              }else{
                                    $sql="SELECT t.transaction_ID, t.patient_ID, t.disease, t.temp, t.height, t.weight, t.blood_pressure, t.doctor_ID, d.firstname, d.lastname, d.specialization, DATE_FORMAT(t.date_transaction, '%e %M, %Y') as date_transaction FROM patient_info pin, transaction t, doctor_info d WHERE t.patient_ID = $getid AND pin.patient_ID = t.patient_ID AND t.doctor_ID = d.doctor_ID ORDER BY t.transaction_ID DESC";
                              }

                              $result = $conn->query($sql);

                              if($result -> num_rows > 0){
                                    while($rows = $result -> fetch_assoc()){
                                          $transactionID = $rows['transaction_ID'];
                                          $patientID = $rows['patient_ID'];
                                          $disease = $rows['disease'];
                                          $temp = $rows['temp'];
                                          $height = $rows['height'];
                                          $weight = $rows['weight'];
                                          $bp = $rows['blood_pressure'];
                                          $date = $rows['date_transaction'];
                                          $doctorID = $rows['doctor_ID'];
                                          $fname = $rows['firstname'];
                                          $lname = $rows['lastname'];
                                          $spec = $rows['specialization'];

                                          echo"<li>";
                                                echo"<div class='collapsible-header'><i class='fa fa-thermometer-3 fa-lg'></i> $date <span class='right'> <a href='print_record.php?transactionID=$transactionID&patientID=$patientID'><i class='fa fa-file-text green-text'></i></a> <a href='include/delete_medical_record.php?transactionID=$transactionID&patientID=$patientID'><i class='fa fa-trash red-text'></i></a></span></div>";
                                                echo"<div class='collapsible-body'>
                                                      <span>Physical Characteristics:</span>
                                                      <p><strong>Height: </strong> $height cm</p>
                                                      <p><strong>Weight: </strong> $weight lbs</p>
                                                      <p><strong>Temperature: </strong> $temp °C</p>
                                                      <p><strong>Blood Pressure: </strong> $bp</p>
                                                            <br><br>
                                                      <span class='margin-medium-top'>Findings:</span>
                                                      <p><strong>Disease: </strong> $disease</p>
                                                            <br><br>
                                                      <span class='margin-medium-top'>Doctor:</span>
                                                      <p><strong>Fullname: </strong> $fname $lname</p>
                                                      <p><strong>Disease: </strong> $spec</p>
                                                </div>";
                                          echo"</li>";
                                    }
                              }else{
                                    echo"0";
                              }
                              $conn->close();
                        ?>
                        </ul>
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
