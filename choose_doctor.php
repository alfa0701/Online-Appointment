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

      <main class="container">
            <?php
            $firstname = $_GET['firstname'];
            $lastname = $_GET['lastname'];
            $contact_no = $_GET['contact_no'];
            $gender = $_GET['gender'];
            $date = $_GET['date'];
            $message = $_GET['message'];
            $age = $_GET['age'];
            ?>
            <form method="POST" action="<?php echo"include/user_searchDoctor.php?firstname=$firstname&lastname=$lastname&age=$age&contact_no=$contact_no&gender=$gender&date=$date&message=$message"?>">
            <div class="row valign-wrapper">
                  <div class="input-field col s3">
                        <input type="text" name="search" id="search">
                        <label for="search">Search Doctor</label>
                  </div>
                  <div class="center-align">
                        <button class="waves-effect waves-light btn blue">Search</button>
                  </div>
            </div>
      </form>
            <table class="bordered margin-large-top">
                  <thead>
                        <tr>
                              <th>#</th>
                              <th>Full Name</th>
                              <th>Specialization</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                              include 'include/connect.php';

                              if(isset($_GET['search'])){
                                    $search = $_GET['search'];
                                    $sql="SELECT * FROM doctor_info WHERE firstname LIKE '%$search%'";
                              }else{
                                    $sql="SELECT * FROM doctor_info WHERE status = 'Active'";
                              }
                              $result = $conn->query($sql);

                              if($result -> num_rows > 0){
                                    while($rows = $result -> fetch_assoc()){
                                          $doctor_ID = $rows['doctor_ID'];
                                          $doc_fname = $rows['firstname'];
                                          $doc_lname = $rows['lastname'];
                                          $specialization = $rows['specialization'];

                                          echo"<tr>";
                                                echo"<td>$doctor_ID</td>";
                                                echo"<td>$doc_fname $doc_lname</td>";
                                                echo"<td>$specialization</td>";
                                                echo"<td><a href='include/add_appointment.php?firstname=$firstname&lastname=$lastname&age=$age&phone=$contact_no&gender=$gender&date=$date&message=$message&doctorID=$doctor_ID' class='waves-effect waves-light btn blue'>Select</a></td>";
                                          echo"</tr>";
                                    }
                              }else{
                                    echo"0";
                              }
                              $conn->close();
                        ?>
                  </tbody>
            </table>

      </main>

      <!-- JS External -->
      <script type="text/javascript" src="lib/materialize/js/jquery.min.js"></script>
      <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="js/initialize.js"></script>
</body>
</html>
