<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $limit = $_POST['limit'];

      $sql="UPDATE appointment_today SET limit_app = $limit";

      if($conn->query($sql) === TRUE){
            ?>
            <script>
                swal({
                  title: "Limit Update",
                  text: "into <?php echo"$limit"?>",
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
