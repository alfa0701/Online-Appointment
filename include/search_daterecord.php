<?php
      $search_date = $_POST['search_date'];
      $getid = $_GET['patientID'];

      header("Location: ../view_patient.php?patientID=$getid&date='$search_date' ")
?>
