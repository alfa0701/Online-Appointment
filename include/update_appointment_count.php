<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $count = $_POST['count'];

      $sql = "INSERT INTO appointment_today(AT_count) VALUES('$count')";

      if($conn->query($sql) === TRUE){
            ?>
            <script>
                swal({
                  title: "Update Success",
                  text: "You will accept <?php echo"$count"; ?> Appointments today",
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
            ?>
            <script>
                swal({
                  title: "Ooppss!",
                  text: "Error 404 pls contact your developer",
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
