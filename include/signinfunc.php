<!DOCTYPE html>
<html>
    <link type="text/css" rel="stylesheet" href="../lib/sweetalert-master/dist/sweetalert.css">
    <script type="text/javascript" src="../lib/mdb/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
</html>
<?php

session_start();
require_once'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

if(isset($_POST['btn-signin'])){
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' AND role = 'Administrator' ";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($rows = $result->fetch_assoc()){
            $_SESSION['admin_ID'] = $rows['admin_ID'];
            $_SESSION['firstname'] = $rows['firstname'];
            $_SESSION['lastname'] = $rows['lastname'];
            $_SESSION['role'] = $rows['role'];

            $roles = $rows['role'];
        }
        ?>
        <script>
            swal({
              title: "Sign in Success",
              text: "Have a nice day <?php echo"$roles"; ?>",
              type: "success",
              timer: 2000,
              showConfirmButton: false
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
              title: "Wrong Details!",
              text: "Invalid Username or Password",
              type: "warning",
              timer: 2000,
              showConfirmButton: false
                },
                function(){
                location="../index.php";
            });
        </script>
        <?php
    }
}//Closing of if stat
?>
