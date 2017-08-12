<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Patient System</title>

      <!-- CSS External -->
      <link rel="stylesheet" type="text/css" href="lib/materialize/css/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="lib/font-awesome-4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="lib/sweetalert-master/dist/sweetalert.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/margins.css">
</head>
<body>
      <header class="navbar-fixed">
            <nav class="white nav-style">
                  <div class="nav-wrapper">
                        <div class="wrapper">
                              <a href="#" class="brand-logo"><img class="responsive-img margin-top" src="img/logo.png" height="200px" width="200px"></a>
                              <ul id="nav-mobile" class="right hide-on-med-and-down">
                                    <li><a class="black-text" href="collapsible.html">About</a></li>
                                    <li><a class="black-text" href="collapsible.html">Help</a></li>
                                    <li><a class="waves-effect waves-light btn blue" href="patient_signin.php">Sign In</a></li>
                              </ul>
                        </div>
                  </div>
            </nav>
      </header>

      <main>
            <div class="home-bg">
                  <div class="row">
                        <div class="col s12 m12 l12 right-align">
                              <span class="fa fa-user-md fa-4x white-text"></span>
                              <h5 class="white-text">BETTER TECHNOLOGY</h5>
                              <p class="white-text">Far far away, behind the word mountains, far from the countries in Olongapo to be other, there live blind texts.</p>
                              <button class="waves-effect waves-light btn blue">Read More</button>
                        </div><!--End of col-->
                  </div><!--End of row-->
            </div><!--End of home-bg-->

            <div class="info">
                  <div class="row center-align">
                        <div class="col s12 m12 l4 blue info-card">
                              <span class="fa fa-ambulance fa-3x white-text"></span>
                              <h5 class="white-text">Emergency Case</h5>
                              <p class="white-text">If you need a doctor urgently outside of Mediacom opening hours, call emergency appointment number for emergency service.</p>
                              <button class="waves-effect waves-light btn white blue-text">Read More</button>
                        </div>
                        <div class="col s12 m12 l4 grey lighten-2 info-card">
                              <span class="fa fa-clock-o fa-3x black-text"></span>
                              <h5 class="black-text">Opening Hours</h5>
                              <table class="bordered centered">
                                    <thead>
                                          <tbody>
                                                <tr>
                                                      <td>Mon, Wed & Fri</td>
                                                      <td>8:00am - 6:00pm</td>
                                                </tr>
                                                <tr>
                                                      <td>Tue, Thu & Sat</td>
                                                      <td>10:00am - 8:00pm</td>
                                                </tr>
                                          </tbody>
                              </table>
                        </div>
                        <div class="col s12 m12 l4 blue info-card">
                              <span class="fa fa-ambulance fa-3x white-text"></span>
                              <h5 class="white-text">Emergency Case</h5>
                              <p class="white-text">If you need a doctor urgently outside of Mediacom opening hours, call emergency appointment number for emergency service.</p>
                              <button class="waves-effect waves-light btn white blue-text">Read More</button>
                        </div>
                  </div><!--End of row-->
            </div><!--End of info-->

            <div class="appointment margin-large-top margin-large-bottom">
                  <div class="row">
                        <div class="col s12 m12 l6 center-align">
                              <h5>Make an Appointment</h5>
                              <p>Register first, A schedule time with the doctor where they will try to help you with your problem.</p>
                        </div>
                        <div class="col s12 m12 l6">
                              <div class="card">
                                    <div class="card-header blue center-align">
                                          <h5 class="white-text">Register</h5>
                                    </div>
                                    <div class="card-content">
                                          <form method="POST" action="include/register.php">
                                                <div class="input-field col s12 m6 l6">
                                                      <input type="text" id="firstname" name="firstname">
                                                      <label for="firstname">Firstname</label>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                      <input type="text" id="lastname" name="lastname">
                                                      <label for="lastname">Lastname</label>
                                                </div>

                                                <!-- <div class="input-field col s12 m6 l6">
                                                      <input type="number" id="age" name="age">
                                                      <label for="age">Age</label>
                                                </div>

                                                <div class="input-field col s12 m6 l6">
                                                      <input type="date" class="datepicker2" id="dateofbirth" name="dateofbirth">
                                                      <label for="dateofbirth">Date of Birth</label>
                                                </div> -->

                                                <div class="input-field col s12 m6 l6">
                                                      <input type="text" id="username" name="username">
                                                      <label for="username">Username</label>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                      <input type="password" id="password" name="password">
                                                      <label for="password">Password</label>
                                                </div>

                                                <div class="center-align">
                                                      <button class="waves-effect waves-light btn blue white-text"><span class="fa fa-send white-text"></span> Register</button>
                                                </div>
                                          </form>
                                    </div><!--End of card-content-->
                              </div><!--End of card-->
                        </div>
                  </div><!--End of row-->
            </div><!--End of appointment-->
      </main>

      <footer class="page-footer blue">
            <div class="container">
                  <div class="row">
                        <div class="col l6 s12">
                              <h5 class="white-text">Footer Content</h5>
                              <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                        </div>
                        <div class="col l4 offset-l2 s12">
                              <h5 class="white-text">Map</h5>
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.5832108061013!2d120.28960531427798!3d14.84863188964487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339670f72b0697bf%3A0xd32d1967500aab59!2sSta.+Rita+Catholic+Church!5e0!3m2!1sfil!2sph!4v1494114888082" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                  </div>
            </div>
            <div class="footer-copyright">
                  <div class="container">
                        © 2017 Copyright Team 2
                        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
                  </div>
            </div>
      </footer>
      <!-- JS External -->
      <script type="text/javascript" src="lib/materialize/js/jquery.min.js"></script>
      <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
      <script type="text/javascript" src="lib/sweetalert-master/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="js/initialize.js"></script>
</body>
</html>
