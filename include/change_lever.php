<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" type="text/css" href="../lib/sweetalert-master/dist/sweetalert.css">
            <script type="text/javascript" src="../lib/sweetalert-master/dist/sweetalert.min.js"></script>
      </head>
</html>
<?php
      include 'connect.php';
            $sql ="SELECT status FROM appointment_today";
            $result = $conn->query($sql);

            while($rows = $result -> fetch_assoc()){
                  $status = $rows['status'];

                  if($status == 'checked'){
                        $sql2="UPDATE appointment_today SET status = 'uncheck'";

                        if($conn->query($sql2) === TRUE){
                              ?>
                              <script>
                                  swal({
                                    title: "OFF",
                                    text: "You turned off the reservation",
                                    type: "success",
                                    timer: 4000,
                                    showConfirmButton: true
                                  },
                                      function(){
                                      location="../dashboard.php";
                                  });
                              </script>
                              <?php
                        }
                  }else if($status == 'uncheck'){
                        $sql3="UPDATE appointment_today SET status = 'checked'";

                        if($conn->query($sql3) === TRUE){
                              ?>
                              <script>
                                  swal({
                                    title: "ON",
                                    text: "You turned on the reservation",
                                    type: "success",
                                    timer: 4000,
                                    showConfirmButton: true
                                  },
                                      function(){
                                      location="../dashboard.php";
                                  });
                              </script>
                              <?php
                        }
                  }
            }//closing of while



?>
