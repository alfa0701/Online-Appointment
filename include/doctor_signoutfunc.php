<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
  include 'connect.php';
    session_start();
    $doctorID = $_SESSION['doctor_ID'];
    $_SESSION['doctor_ID'];
    if(!isset($_SESSION['doctor_ID']))
    {
        header("Location: ../doctor.php");
    }
    session_destroy();
    unset($_SESSION['doctor_ID']);

    $sql="UPDATE doctor_info SET status = 'Idle' WHERE doctor_ID = $doctorID";

    if($conn->query($sql) === TRUE){
      ?>
      <script>
          swal({
            title: "Sign Out Success",
            text: "Thankyou, have a nice day",
            type: "success",
            timer: 2000,
            showConfirmButton: false
              },
              function(){
              location="../index.php";
          });
      </script>
      <?php
    }
