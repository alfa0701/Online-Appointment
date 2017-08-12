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

      <style type="text/css">
            #chart-container {
                width: 100%;
                height: auto;
            }
            html, body{
                background-color: white!important;
            }
            @media print
            {
                  .btn-print-hide
                {
                    display: none !important;
                }
            }
        </style>
</head>
<body>
      <?php
      $transactionID = $_GET['transactionID'];
      $patientID = $_GET['patientID'];
      ?>
      <a href="<?php echo"view_patient.php?transactionID=$transactionID&patientID=$patientID";?>" class="waves-effect waves-light btn blue btn-print-hide "><i class="fa fa-caret-left"></i> Back</a>
      <button onclick="myFunction()" class=" btn-print-hide waves-effect waves-light btn blue"><i class="fa fa-file-text"></i> Print</button>
      <main class="center-align">

            <img class="margin-top responsive-img margin-bottom" src="img/logo.png" height="240px" width="240px">
                    <p class="font-roboto-darkgray margin-bottom margin-top-remove">#76 Barreto, Kennon Road, Olongapo City, Zambales</p>
                    <p class="font-roboto-darkgray margin-top-remove"><i class="fa fa-phone"></i> 0999-8888-7777 & 222-4444</p>
                    <?php
                    date_default_timezone_set('Asia/Manila');

                    $script_tz = date_default_timezone_get();
                    ?>
                    <p class="font-roboto-darkgray margin-top-remove"><i class="fa fa-calendar"></i> <?php echo (new \DateTime())->format('M d, Y | h:i:s a'); ?></p>
                    <hr>

                    <div class="row">
                          <div class="col s12 m12 l12">
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

                                                 echo"<p><strong>Fullname:</strong> $firstname $middlename, $lastname</p>";
                                                 echo"<p><strong>Age: </strong> $age</p>";
                                                 echo"<p><strong>Birth Day: </strong> $dateofbirth</p>";
                                                 echo"<p><strong>Home Address: </strong> $home_address</p>";
                                            }
                                      }else{
                                            echo"0";
                                      }
                                ?>
                          </div>
                    </div>

                    <div class="row">
                          <div class="col s12 m12 l12">
                                <table class="bordered">
                                      <thead>
                                            <tr>
                                                  <th>#</th>
                                                  <th>Disease</th>
                                                  <th>Temperature</th>
                                                  <th>Height</th>
                                                  <th>Weight</th>
                                                  <th>Blood Pressure</th>
                                                  <th>Date</th>
                                                  <th>Doctor</th>
                                                  <th>Specialization</th>
                                            </tr>
                                <?php
                                    include 'include/connect.php';
                                    $transactionID = $_GET['transactionID'];

                                    $sql="SELECT t.transaction_ID, t.patient_ID, t.disease, t.temp, t.height, t.weight, t.blood_pressure, t.doctor_ID, d.firstname, d.lastname, d.specialization, DATE_FORMAT(t.date_transaction, '%e %M, %Y') as date_transaction FROM patient_info pin, transaction t, doctor_info d WHERE t.patient_ID = $getid AND pin.patient_ID = t.patient_ID AND t.doctor_ID = d.doctor_ID AND t.transaction_ID = $transactionID ORDER BY t.transaction_ID DESC ";
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

                                                echo"<tr>";
                                                      echo"<td>$transactionID</td>";
                                                      echo"<td>$disease</td>";
                                                      echo"<td>$temp</td>";
                                                      echo"<td>$height</td>";
                                                      echo"<td>$weight</td>";
                                                      echo"<td>$bp</td>";
                                                      echo"<td>$date</td>";
                                                      echo"<td>$fname $lname</td>";
                                                      echo"<td>$spec</td>";
                                                echo"</tr>";
                                          }
                                    }else{

                                    }
                                    $conn->close();
                                ?>
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
