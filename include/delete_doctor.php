<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $doctorID = $_GET['doctorID'];

      $sql="DELETE FROM doctor_info WHERE doctor_ID = $doctorID";

      if($conn->query($sql) === TRUE){
            ?>
            <script>
                swal({
                  title: "Delete Success",
                  text: "You Deleted the record ",
                  type: "success",
                  timer: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="<?php echo"../doctor_list.php";?>";
                });
            </script>
            <?php
      }else{

      }
      $conn->close();
?>
