<?php
      $firstname = $_GET['firstname'];
      $lastname = $_GET['lastname'];
      $contact_no = $_GET['phone'];
      $gender = $_GET['gender'];
      $date = $_GET['date'];
      $message = $_GET['message'];

      $search = $_POST['search'];

      header("location: ../choose_doctor.php?firstname=$firstname&lastname=$lastname&contact_no=$contact_no&gender=$gender&date=$date&message=$message.php&search=$search");
?>
