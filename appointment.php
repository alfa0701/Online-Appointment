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
<style type = "text/css">
  Specialization{
    margin: 20px;
    text-align:left;
  }
  </style>
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
                  <li class="active"><a class="waves-effect" href="appointment.php"><span class="fa fa-bell black-text fa-lg"></span> Appointment <span class="new badge" data-badge-caption="">
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
                  <li><a class="waves-effect" href="#!"><span class="fa fa-user-md black-text fa-lg"></span> Add Doctor</a></li>
                  <li><a class="waves-effect" href="doctor_list.php"><span class="fa fa-vcard black-text fa-lg"></span> Doctor List</a></li>
                  <li>
                        <div class="divider"></div>
                  </li>
                  <li><a class="waves-effect waves-light btn red darken-2" href="include/signoutfunc.php">Sign Out</a></li>
            </ul>
      </header>

      <main class="main-content">
            <div class="row">
                  <div class="input-field col s3">
                        <input type="text" id="search">
                        <label for="search">Search Appointment</label>
                  </div>
                  <button class="waves-effect waves-light btn blue margin-small-top"><span class="fa fa-search"></span> Search</button>
                  <div class="col s12 m12 l12">
                        <table class="bordered highlight">
                              <thead class="thead">
                                    <tr>
                                          <th class="white-text">#</th>
                                          <th class="white-text">Lastname</th>
                                          <th class="white-text">Firstname</th>
                                          <th class="white-text">Phone No</th>
                                          <th class="white-text">Gender</th>
                                          <th class="white-text">Age</th>
                                          <th class="white-text">Doctor</th>
                                          <th class="white-text">Action</th>
                                    </tr>
                              </thead>
                              <div class="Specialization">
                                <label>specialization</label>
                                <select name="specialization">
                                  <option value="">1</option>
                                  <option value="">2</option>
                                  <option value="">3</option>
                                  <option value="">4</option>
                                </select>
                              </div>

                              <tbody>
                                    <?php
                                    $sql="SELECT * FROM appointment a, doctor_info di WHERE a.status = 'waiting' AND a.doctor_ID = di.doctor_ID";
                                    $result = $conn->query($sql);

                                    if($result -> num_rows > 0){
                                          while($rows = $result -> fetch_assoc()){
                                                $appointmentID = $rows['appointment_ID'];
                                                $firstname = $rows['pa_firstname'];
                                                $lastname = $rows['pa_lastname'];
                                                $phone = $rows['phone_no'];
                                                $gender = $rows['gender'];
                                                $age = $rows['age'];
                                                $docfirstname = $rows['firstname'];
                                                $doclastname = $rows['lastname'];

                                                echo"<tr>";
                                                      echo"<td>$appointmentID</td>";
                                                      echo"<td>$lastname</td>";
                                                      echo"<td>$firstname</td>";
                                                      echo"<td>$phone</td>";
                                                      echo"<td>$gender</td>";
                                                      echo"<td>$age</td>";
                                                      echo"<td>$docfirstname $doclastname</td>";
                                                      echo"<td><a href='include/appointmentdone.php?appointmentID=$appointmentID&fname=$firstname&lname=$lastname' class='waves-effect waves-light btn green'>Done</button></a>";
                                                echo"</tr>";
                                          }
                                    }else{
                                                echo"<td>No Appointment</td>";
                                                echo"<td>No Appointment</td>";
                                                echo"<td>No Appointment</td>";
                                                echo"<td>No Appointment</td>";
                                                echo"<td>No Appointment</td>";
                                                echo"<td>No Appointment</td>";
                                                echo"<td>No Appointment</td>";
                                          }
                                                $conn->close();
                                    ?>
                              </tbody>
                        </table>
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
