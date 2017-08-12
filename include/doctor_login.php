<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';
      session_start();

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql="SELECT * FROM doctor_info WHERE username = '$username' AND password = '$password'";
      $result = $conn->query($sql);

      if($result -> num_rows > 0){
            while($rows = $result -> fetch_assoc()){
                  $doctorID = $rows['doctor_ID'];
                  $firstname = $rows['firstname'];
                  $lastname = $rows['lastname'];
                  $status = $rows['status'];

                  $_SESSION['doctor_ID'] = $rows['doctor_ID'];
                  $_SESSION['firstname'] = $rows['firstname'];
                  $_SESSION['lastname'] = $rows['lastname'];
                  $_SESSION['specialization'] = $rows['specialization'];
                  $_SESSION['username'] = $rows['username'];
                  $_SESSION['status'] = $rows['status'];

                  if($status == 'Idle'){
                        $sql2="UPDATE doctor_info SET status = 'Active' WHERE doctor_ID = '$doctorID' ";

                        if($conn->query($sql2)){
                              ?>
                              <script>
                                  swal({
                                    title: "Sign In",
                                    text: "Welcome Dr.<?php echo"$firstname $lastname"; ?>",
                                    type: "success",
                                    timer: 4000,
                                    showConfirmButton: true
                                  },
                                      function(){
                                      location="../doctor_home.php";
                                  });
                              </script>
                              <?php
                        }else{
                              ?>
                              <script>
                                  swal({
                                    title: "Ooppss!",
                                    text: "Error in Sign in",
                                    type: "error",
                                    timer: 4000,
                                    showConfirmButton: true
                                  },
                                      function(){
                                      location="../doctor.php";
                                  });
                              </script>
                              <?php
                        }
                  }else{
                              ?>
                              <script>
                                  swal({
                                    title: "Ooppss!",
                                    text: "Error in Sign Out",
                                    type: "error",
                                    timer: 4000,
                                    showConfirmButton: true
                                  },
                                      function(){
                                      location="../doctor.php";
                                  });
                              </script>
                              <?php
                        }
                  }
            
      }else{
            ?>
            <script>
                swal({
                  title: "Ooppss!",
                  text: "Error in Main",
                  type: "error",
                  timer: 4000,
                  showConfirmButton: true
                },
                    function(){
                    location="../doctor.php";
                });
            </script>
            <?php
      }
      $conn->close();
?>
