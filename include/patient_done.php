<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $getid = $_GET['patientID'];
      $firstname = $_GET['firstname'];
      $lastname = $_GET['lastname'];
      $done = "done";
      $sql="UPDATE appointment SET status = '$done' WHERE appointment_ID = $getid";

      if($conn->query($sql) === TRUE){
            ?>
            <script>
                swal({
                  title: "Update Success",
                  text: "Patient <?php echo"$firstname $lastname"; ?> was arrived",
                  type: "success",
                  timer: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="../dashboard.php";
                });
            </script>
            <?php
      }else{

      }
      $conn->close();
?>
