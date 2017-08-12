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
                              <a href="#!email"><span class="white-text email margin-bottom-remove"><?php echo"$role";?></span></a>

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
                  <li class="active"><a class="waves-effect" href="dashboard.php"><span class="fa fa-line-chart black-text fa-lg"></span> Dashboard</a></li>
                  <li><a class="waves-effect" href="appointment.php"><span class="fa fa-bell black-text fa-lg"></span> Appointment <span class="new badge">
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
                  <li><a class="waves-effect" href="addpatient.php"><span class="fa fa-user-plus black-text fa-lg"></span> Add Patient</a></li>
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
            <div class="row">
                  <div class="col s12 m12 l4">
                        <div class="card">
                              <div class="card-content center-align">
                                    <h3><strong>
                                          <?php
                                                require_once"include/connect.php";

                                                $sql="SELECT COUNT(patient_ID) as count FROM patient_info";
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
                                    </strong></h3>
                                    <p class="margin-top-remove">Patients</p>
                              </div>
                              <div class="card-action center-align">
                                    <a href="patient_list.php">View</a>
                              </div>
                        </div><!--End of card-->
                  </div><!--End of col-->

                  <div class="col s12 m12 l4">
                        <div class="card">
                              <div class="card-content center-align">
                                    <h3><strong>
                                          <?php

                                                $sql="SELECT COUNT(*) as count FROM doctor_info";
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
                                    </strong></h3>
                                    <p class="margin-top-remove">Doctors</p>
                              </div>
                              <div class="card-action center-align">
                                    <a href="doctor_list.php">View</a>
                              </div>
                        </div><!--End of card-->
                  </div><!--End of col-->

                  <div class="col s12 m12 l4">
                        <div class="card">
                              <div class="card-content center-align">
                                    <h3><strong>
                                          <?php
                                                $sql="SELECT COUNT(*) as appointment_today, (SELECT COUNT(*) FROM transaction t WHERE DATE_FORMAT(t.date_transaction, '%Y-%m-%e') = DATE_FORMAT(NOW(), '%Y-%m-%e')) as transaction_today, (SELECT limit_app FROM appointment_today) as limit_app FROM appointment a WHERE a.appointment_date = DATE_FORMAT(NOW(), '%Y-%m-%e')";
                                                $result = $conn->query($sql);

                                                if($result -> num_rows > 0){
                                                      $sql2="SELECT limit_app FROM appointment_today";
                                                      $result2 = $conn->query($sql2);

                                                      while($row = $result2 -> fetch_assoc()){
                                                            $limit = $row['limit_app'];
                                                      }
                                                      while($rows = $result -> fetch_assoc()){
                                                            $appointment_today = $rows['appointment_today'];
                                                            $transaction_today = $rows['transaction_today'];

                                                            $count = ($appointment_today + $transaction_today);
                                                            echo"$count / $limit";
                                                      }

                                                }else{
                                                      echo"0";
                                                }
                                          ?>
                                    </strong></h3>
                                    <p class="margin-top-remove">Appointments</p>
                              </div>
                              <div class="card-action center-align">
                                    <a href="#modal1">Set Limit</a>
                              </div>
                        </div><!--End of card-->
                  </div><!--End of col-->
            </div><!--End of row-->

            <div class="row">
                  <form method="POST" action="include/search_appointment.php">
                        <div class="input-field col s3">
                              <input type="text" id="search" name="search">
                              <label for="search">Search Patient</label>
                        </div>
                        <button class="waves-effect waves-light btn blue margin-small-top"><span class="fa fa-search"></span> Search</button>
                  </form>
                  <div class="col s12 m12 l12">
                        <table class="bordered highlight">
                              <thead class="thead">
                                    <tr>
                                          <th class="white-text">#</th>
                                          <th class="white-text">Lastname</th>
                                          <th class="white-text">Firstname</th>
                                          <th class="white-text">Action</th>
                                    </tr>
                              </thead>

                              <tbody>
                                    <?php
                                          if(isset($_GET['name'])){
                                                $sql="SELECT * FROM appointment WHERE status = 'accepted' AND firstname=".$_GET['name']."OR middlename=".$_GET['name']."OR lastname=".$_GET['name'];
                                          }else{
                                                $sql="SELECT * FROM appointment WHERE status='accepted'";
                                          }

                                          $result = $conn->query($sql);

                                          if($result -> num_rows > 0){
                                                while($rows = $result -> fetch_assoc()){
                                                      $appointment_ID = $rows['appointment_ID'];
                                                      $firstname = $rows['pa_firstname'];
                                                      $lastname = $rows['pa_lastname'];

                                                      echo"<tr>";
                                                            echo"<td>$appointment_ID</td>";
                                                            echo"<td>$lastname</td>";
                                                            echo"<td>$firstname</td>";
                                                            echo"<td><a href='print_docs.php?appointmentID=$appointment_ID&firstname=$firstname&lastname=$lastname' class='waves-effect waves-light btn blue'>Print</a></td>";
                                                      echo"</tr>";
                                                }
                                          }else{
                                                echo"0";
                                          }
                                    ?>

                              </tbody>
                        </table>
                  </div>
            </div>

            <div id="modal1" class="modal" style="width: 280px;">
                <div class="modal-content center-align">
                  <h4>Add Limit</h4>

                  <form method="POST" action="include/addlimit.php">
                  <div class="input-field col s12">
                        <input type="number" id="limit" name="limit">
                        <label for="limit">Add Limitation</label>
                  </div>

                </div>
                <div class="modal-footer">
                      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                  <button type="submit" class="modal-action waves-effect waves-green btn-flat">Submit</button>
            </form>
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
