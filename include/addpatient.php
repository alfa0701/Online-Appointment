<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
require_once"connect.php";

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$middlename = $_POST['middlename'];
$home_address = $_POST['home_address'];
$dateofbirth = $_POST['dateofbirth'];

$sql="INSERT INTO patient_info(firstname, lastname, middlename, home_address, dateofbirth) VALUES('$firstname', '$lastname', '$middlename', '$home_address', '$dateofbirth')";

if($conn->query($sql) === TRUE){
      ?>
      <script>
          swal({
            title: "New Patient",
            text: "You've added <?php echo"$firstname $lastname"; ?> as a Patient",
            type: "success",
            timer: 4000,
            showConfirmButton: true
          },
              function(){
              location="../addpatient.php";
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
              location="../addpatient.php";
          });
      </script>
      <?php
}
?>
