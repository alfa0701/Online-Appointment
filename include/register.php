<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php

      include'connect.php';
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      // $age = $_POST['age'];
      // $dateofbirth = $_POST['dateofbirth'];
      $role = "patient";

      $sql="INSERT INTO admin(firstname, lastname, username, password, role) VALUES('$firstname', '$lastname', '$username', '$password', '$role')";

      if($conn->query($sql) === TRUE){
            ?>
            <script>
                swal({
                  title: "Register Success",
                  text: "Have a nice day <?php echo"$firstname"; ?>",
                  type: "success",
                  timeyyyyur: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="../index.php";
                });
            </script>
            <?php
      }else{
            ?>
            <script>
                swal({
                  title: "Register Error",
                  text: "Please try again later",
                  type: "warning",
                  timer: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="../index.php";
                });
            </script>
            <?php
      }
      $conn->close()
?>
