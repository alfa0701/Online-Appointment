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
      <style>
            @media print{
                  .hide-print{
                        display: none!important;
                  }
            }
      </style>
</head>
<body>

      <main class="wrapper">
            <?php
                  $appointmentID = $_GET['appointmentID'];
                  $firstname = $_GET['firstname'];
                  $lastname = $_GET['lastname'];
            ?>
            <a href="dashboard.php" class="waves-effect waves-light btn red darken-2 hide-print" >Back</a>
            <button class="waves-effect waves-light btn blue hide-print" onclick="javascript:window.print()"><i class="fa fa-file-text"></I> Print</button>
            <a href="<?php echo"include/appointmentdone2.php?appointmentID=$appointmentID&fname=$firstname&lname=$lastname";?>" class="waves-effect waves-light btn green hide-print" >Done</a>
            <div class="row center-align">
                  <img class="responsive-img margin-bottom" src="img/logo.png" height="200px" width="200px">
                  <p class="margin-top-remove">Anesthesiology, Mother And Child Family Hospital, Gordon Avenue, <br>Barangay New Asinan, Olongapo City, 2200</p>
                  <p class="margin-top-remove">Contact No: (989) 8576 4827 | 224 - 3982</p>
                  <p class="margin-top-remove"><i class="fa fa-calendar"></i> <?php echo (new \DateTime())->format('M d, Y | h:i:s a'); ?></p>
            </div>

            <?php
                  include'include/connect.php';

                  $appointmentID = $_GET['appointmentID'];
                  $sql="SELECT * FROM appointment a, doctor_info di WHERE a.appointment_ID = $appointmentID AND a.doctor_ID = di.doctor_ID";
                  $result = $conn->query($sql);

                  if($result -> num_rows > 0){
                        while($rows = $result -> fetch_assoc()){
                              $pa_firstname = $rows['pa_firstname'];
                              $pa_lastname = $rows['pa_lastname'];
                              $phone_no = $rows['phone_no'];
                              $appointment_date = $rows['appointment_date'];
                              $gender = $rows['gender'];
                              $message = $rows['message'];
                              $doc_firstname = $rows['firstname'];
                              $doc_lastname = $rows['lastname'];
                              $specialized = $rows['specialization'];
                        }
                  }else{

                  }
                  $conn->close();
            ?>
            <div class="row">
                  <p><b>Appointment Information:</b></p>
                  <p><b>Patient:</b> <?php echo"$pa_firstname $pa_lastname"?></p>
                  <p><b>Symptoms:</b> <?php echo"$message";?></p>
            </div>

            <div class="row">
                  <p><b>Physical Characteristics:</b></p>
                  <div class="col s3 m3 l3 center-align">
                        <p style="border-top: solid 1px; width: 80%;">Height</p>
                  </div>
                  <div class="col s3 m3 l3 center-align">
                        <p style="border-top: solid 1px; width: 80%;">Weight</p>
                  </div>
                  <div class="col s3 m3 l3 center-align">
                        <p style="border-top: solid 1px; width: 80%;">Temperature</p>
                  </div>
                  <div class="col s3 m3 l3 center-align">
                        <p style="border-top: solid 1px; width: 80%;">Blood Pressure</p>
                  </div>
            </div>
            <div class="row">
                  <p><b>Findings:</b></p>

            </div>
            <div class="row margin-xxxlarge-top">
                  <p><b>Remarks:</b></p>

            </div>

            <div class="row margin-xxxlarge-top">
                  <p class="right center-align"><b>Dr. <?php echo"$doc_firstname $doc_lastname</b><br>$specialized"?></p>
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
                        }
                  });
            }
      </script>
</body>
</html>
