<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $getid = $_GET['transactionID'];
      $patientID = $_GET['patientID'];
      $sql="DELETE FROM transaction WHERE transaction_ID = $getid";

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
                    location="<?php echo"../view_patient.php?patientID=$patientID";?>";
                });
            </script>
            <?php
      }else{
            echo"error";
      }
      $conn->close();
?>
