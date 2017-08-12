<?php
      include 'connect.php';

      $search = $_POST['search'];

      header("location: ../dashboard.php?name='$search'");
?>
