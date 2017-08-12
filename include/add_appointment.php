<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      require_once "connect.php";
      session_start();


      $adminID = $_SESSION['admin_ID'];
      $firstname = $_GET['firstname'];
      $lastname = $_GET['lastname'];
      $phone_no = $_GET['phone'];
      $gender = $_GET['gender'];
      $date = $_GET['date'];
      $message = $_GET['message'];
      $doctor = $_GET['doctorID'];
      $age = $_GET['age'];

      $sql="INSERT INTO appointment(admin_ID, pa_firstname, pa_lastname, phone_no, gender, age, appointment_date, message, status, doctor_ID) VALUES('$adminID', '$firstname', '$lastname', '$phone_no', '$gender', '$age', '$date', '$message', 'waiting', '$doctor')";

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
                                          title: "Appointment Sent",
                                          text: "Have a nice day <?php echo"$firstname";?>",
                                          type: "success",
                                          timer: 4000,
                                          showConfirmButton: true
                                        },
                                            function(){
                                            location="<?php echo"../home.php";?>";
                                        });
                                    </script>
                                    <?php
                              }
                        }else{
                              ?>
                                    <script>
                                        swal({
                                          title: "Appointment Sent",
                                          text: "Have a nice day <?php echo"$firstname";?>",
                                          type: "success",
                                          timer: 4000,
                                          showConfirmButton: true
                                        },
                                            function(){
                                            location="<?php echo"../home.php";?>";
                                        });
                                    </script>
                                    <?php
                        }
                  }

            }else{
                  echo"Error in sql 2";
            }
      }else{
            ?>
            <script>
                swal({
                  title: "Ooppss!",
                  text: "Your appointment was not sent, Please use our landline",
                  type: "error",
                  timer: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="../d.php";
                });
            </script>
            <?php
      }
?>
