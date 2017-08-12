<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';

      $patientID = $_GET['patientID'];
      $height = $_POST['height'];
      $weight = $_POST['weight'];
      $temp = $_POST['temp'];
      $blood_pressure = $_POST['bp'];
      $disease = $_POST['disease'];
      $doctorID = $_POST['doctorID'];
      $today = date("Y-m-d");
      date_default_timezone_set('Asia/Manila');
      $script_tz = date_default_timezone_get();

      $sql="INSERT INTO transaction(patient_ID, disease, temp, height, weight, blood_pressure, doctor_ID) VALUES('$patientID', '$disease', '$temp', '$height',  '$weight', '$blood_pressure', '$doctorID')";

      if($conn->query($sql) === TRUE){
            $sql2="SELECT COUNT(*) as appointment_today, (SELECT COUNT(*) FROM transaction t WHERE DATE_FORMAT(t.date_transaction, '%Y-%m-%e') = DATE_FORMAT(NOW(), '%Y-%m-%e')) as transaction_today, (SELECT limit_app FROM appointment_today) as limit_app FROM appointment a WHERE a.appointment_date = DATE_FORMAT(NOW(), '%Y-%m-%e')";
            $result2 = $conn->query($sql2);

            if($result2 -> num_rows > 0){
                  while($rows = $result2 -> fetch_assoc()){
                        $appointment_today = $rows['appointment_today'];
                        $transaction_today = $rows['transaction_today'];
                        $count = ($appointment_today + $transaction_today);
                        $limit_app = $rows['limit_app'];

                        if($count == $limit_app){
                              $sql3 = "UPDATE appointment_today SET status = 'uncheck'";

                              if($conn->query($sql3) === TRUE){
                                    ?>
                                    <script>
                                        swal({
                                          title: "New Medical Record",
                                          text: "You Added New record ",
                                          type: "success",
                                          timer: 4000,
                                          showConfirmButton: true
                                        },
                                            function(){
                                            location="<?php echo"../view_patient.php?patientID=$patientID";?>";
                                        });
                                    </script>
                                    <?php
                              }
                        }else{
                              ?>
                                    <script>
                                        swal({
                                          title: "New Medical Record",
                                          text: "You Added New record ",
                                          type: "success",
                                          timer: 4000,
                                          showConfirmButton: true
                                        },
                                            function(){
                                            location="<?php echo"../view_patient.php?patientID=$patientID";?>";
                                        });
                                    </script>
                                    <?php
                        }
                  }

            }else{
                  echo"Error in sql 2";
            }
      }else{

      }
?>
