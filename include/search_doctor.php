<?php
      include 'connect.php';

      $search = $_POST['search'];

      header("location: ../doctor_list.php?name='$search'");
?>
