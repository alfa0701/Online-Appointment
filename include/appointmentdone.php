<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
require_once"connect.php";

$getid = $_GET['appointmentID'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];

$sql="UPDATE appointment SET status = 'accepted' WHERE appointment_ID = $getid";

if($conn->query($sql) === TRUE){
      ?>
      <script>
          swal({
            title: "Appointment Updated",
            text: "Appointment of <?php echo"$fname $lname"; ?> was done",
            type: "success",
            timer: 4000,
            showConfirmButton: true
          },
              function(){
              location="../appointment.php";
          });
      </script>
      <?php
}else{
      ?>
      <script>
          swal({
            title: "Ooppss!",
            text: "Your appointment was not updated, Please contact your developer",
            type: "error",
            timer: 4000,
            showConfirmButton: true
          },
              function(){
              location="../dashboard.php";
          });
      </script>
      <?php
}
$conn->close();
?>
