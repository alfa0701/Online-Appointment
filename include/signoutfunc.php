<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
    session_start();
    $_SESSION['admin_ID'];
    $roles =  $_SESSION['role'];
    if(!isset($_SESSION['admin_ID']))
    {
        header("Location: ../index.php");
    }
    session_destroy();
    unset($_SESSION['admin_ID']);


?>
<script>
    swal({
      title: "Sign Out Success",
      text: "Thankyou <?php echo"$roles"; ?>",
      type: "success",
      timer: 2000,
      showConfirmButton: false
        },
        function(){
        location="../index.php";
    });
</script>
