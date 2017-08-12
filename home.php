<?php
      session_start();

      $adminID = $_SESSION['admin_ID'];
      $firstname = $_SESSION['firstname'];
      $lastname = $_SESSION['lastname'];
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
                                <li><a class="" href="include/signoutfunc.php">Sign Out</a></li>
                              </ul>
                        </div>
                  </div>
            </nav>
      </header>

      <main>

            <div class="appointment margin-large-top margin-large-bottom container">
                  <div class="row">
                        <div class="col s12 m12 l6 center-align">
                              <h5>Make an Appointment</h5>
                              <p>Appointment First,A schedule time with the doctor where they will try to help you with your problem.</p>

                              <br><br>
                              <?php
                                    include 'include/connect.php';
                                    $sql="SELECT COUNT(*) as appointment_today, (SELECT COUNT(*) FROM transaction t WHERE t.date_transaction = DATE_FORMAT(NOW(), '%Y-%m-%e')) as transaction_today FROM appointment a WHERE a.appointment_date = DATE_FORMAT(NOW(), '%Y-%m-%e')";
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
                                          }

                                    }else{
                                          echo"0";
                                    }
                              ?>

                              <h5>Apointment Left: <br>
                                    <?php echo"$count";?>/<?php echo"$limit";?></h5>
                        </div>
                        <div class="col s12 m12 l6">
                              <div class="card">
                                    <div class="card-content">
                                          <form method="POST" action="<?php echo"include/user_doctor.php?adminID=$adminID";?>">
                                                <div class="input-field col s12 m6 l5">
                                                      <input type="text" id="firstname" name="firstname" value="<?php echo"$firstname";?>">
                                                      <label for="firstname">Firstname</label>
                                                </div>
                                                <div class="input-field col s12 m6 l5">
                                                      <input type="text" id="lastname" name="lastname" value="<?php echo"$lastname";?>">
                                                      <label for="lastname">Lastname</label>
                                                </div>

                                                <div class="input-field col s12 m6 l2">
                                                      <input type="number" id="age" name="age">
                                                      <label for="age">Age</label>
                                                </div>

                                                <div class="input-field col s12 m6 l4">
                                                      <input type="number" id="phone" name="phone">
                                                      <label for="phone">Phone Number</label>
                                                </div>
                                                <div class="input-field col s12 m6 l4">
                                                      <select name="gender">
                                                            <option value="" disabled selected>Choose Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                          </select>
                                                      <label>Select Gender</label>
                                                </div>
                                                <div class="input-field col s12 m6 l4">
                                                      <input type="date" class="datepicker" name="date" placeholder="Date of Appointment">
                                                </div>




                                                <div class="input-field col s12">
                                                      <textarea id="message" class="materialize-textarea" name="message"></textarea>
                                                      <label for="message">Symptoms & Sick</label>
                                                </div>

                                                <div class="center-align">
                                                      <?php
                                                            include 'include/connect.php';
                                                            $sql = "SELECT status FROM appointment_today";
                                                            $result = $conn->query($sql);

                                                            if($result -> num_rows > 0){
                                                                  while($rows = $result -> fetch_assoc()){
                                                                        $status = $rows['status'];

                                                                        if($status == 'checked'){
                                                                              echo"<button class='waves-effect waves-light btn blue white-text'><span class='fa fa-send white-text'></span> Next</button>";
                                                                        }else{
                                                                              echo"<button class='waves-effect waves-light btn blue white-text disabled'><span class='fa fa-send white-text'></span> Next</button>";
                                                                              echo"<p class='center-align margin-top red-text'><i>\"The Reservation of appointment was closed <i class='fa fa-exclamation-circle'></i>\"</i></p>";
                                                                        }
                                                                  }
                                                            }else{

                                                            }
                                                            $conn->close();
                                                      ?>

                                                </div>
                                          </form>
                                    </div><!--End of card-content-->
                              </div><!--End of card-->
                        </div>
                  </div><!--End of row-->
            </div><!--End of appointment-->

            <div class="container">
                  <div class="row">
                        <div class="col s12 m12 l12">
                              <table class="bordered">
                                    <thead class="grey darken-4 white-text">
                                          <tr>
                                                <th>Appointment Date</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                                include 'include/connect.php';

                                                $sql="SELECT * FROM appointment WHERE admin_ID = $adminID ORDER BY appointment_date DESC";
                                                $result = $conn->query($sql);

                                                if($result -> num_rows > 0){
                                                      while($rows = $result -> fetch_assoc()){
                                                            $appointment = $rows['appointment_date'];
                                                            $message = $rows['message'];
                                                            $status = $rows['status'];

                                                            if($status == 'waiting'){
                                                                  echo"<tr class='red lighten-4'>";
                                                                        echo"<td>$appointment</td>";
                                                                        echo"<td>$message</td>";
                                                                        echo"<td>$status</td>";
                                                                  echo"</tr>";
                                                            }else if($status == 'accepted'){
                                                                  echo"<tr class='green lighten-4'>";
                                                                        echo"<td>$appointment</td>";
                                                                        echo"<td>$message</td>";
                                                                        echo"<td>$status</td>";
                                                                  echo"</tr>";
                                                            }else{
                                                                  echo"<tr'>";
                                                                        echo"<td>$appointment</td>";
                                                                        echo"<td>$message</td>";
                                                                        echo"<td>$status</td>";
                                                                  echo"</tr>";
                                                            }
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
