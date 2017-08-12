<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $specialization = $_POST['specialization'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $status = "Idle";

      $sql="INSERT INTO doctor_info(firstname, lastname, specialization, username, password, status) VALUES('$firstname', '$lastname', '$specialization', '$username', '$password', '$status')";

      if($conn->query($sql) === TRUE){
            ?>
            <script>
                swal({
                  title: "New Doctor was Added",
                  text: "You Added <?php echo"$firstname $lastname as a Doctor"; ?>",
                  type: "success",
                  timer: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="../adddoctor.php";
                });
            </script>
            <?php
      }else{

      }
      $conn->close();
?>
