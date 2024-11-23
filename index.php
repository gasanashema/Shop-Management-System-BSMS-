<?php
@session_start();
unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login | BSMS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />
<!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <!-- my css -->
    <link rel="stylesheet" type="text/css" href="includes/style.css">
    <!-- /my css -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper">
      <div class="layout-container">
       
        <!-- Layout container -->
        <div class="container d-flex justify-content-center align-items-center">
          

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container">

              <div class="col d-flex justify-content-center align-items-center">
                  <div class="card mb-4" style="width: 18rem;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">LOGIN </h5> 
                    </div>
                    <div class="card-body">
                      <form action="index.php" method="POST">
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">USER / UWINJIRA</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder=""
                              aria-label=""
                              name="user"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-company">PASSWORD / IJAMBOBANGA</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"
                              ><i class="bx bxs-key"></i
                            ></span>
                            <input
                              type="password"
                              id="basic-icon-default-company"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              name="password"
                              aria-describedby="basic-icon-default-company2"
                            />
                          </div>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                      </form>
                    </div>
                  </div>

                </div>
<?php

  if (isset($_POST['login'])) {
      include "includes/connect.php";

      $query=mysqli_query($con,"SELECT * FROM accounts WHERE type='$_POST[user]'");
      if (mysqli_num_rows($query)==1) {
        $row=mysqli_fetch_array($query);
        if ($row["password"]==$_POST['password']) {
          $_SESSION['user']=$row["type"];
          echo "<script>window.location.href='html/index.php';</script>";
          exit;
        }
        else{
          echo "<h6 class='text-center text-danger'>Incorrect Password</h6>";
        }
      }
      else{
        echo "<h6 class='text-center text-danger'>User Not Found!</h6>";
      }
    }

?>

       </div>
            <!-- / Content -->



            <!-- Footer -->

           <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                <div class="mb-5 mb-md-0">
                  &copy;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  BSMS , Designed by
                  <a class="footer-link fw-bolder">COG High School Developers</a>
                </div>
                
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
   <?php include "includes/jslinks.php"; ?>
  </body>
</html>
