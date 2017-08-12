<?php
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $contact_no = $_POST['phone'];
      $gender = $_POST['gender'];
      $date = $_POST['date'];
      $message = $_POST['message'];
      $age = $_POST['age'];

      header("location: ../choose_doctor.php?firstname=$firstname&lastname=$lastname&age=$age&contact_no=$contact_no&gender=$gender&date=$date&message=$message");
?>
