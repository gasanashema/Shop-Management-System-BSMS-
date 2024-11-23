<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="reset_acc";
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>BSMS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
<?php include "../includes/links.php"; ?>
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- menu -->
       <?php
  if ($_SESSION["user"]=="manager") {
    include "../includes/managermenu.php";
  }
  else{
    include "../includes/sellermenu.php";
  }
  ?>
        <!-- /menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include "../includes/navbar.php" ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="col d-flex justify-content-center align-items-center">
                  <div class="card mb-4" style="width: 21rem;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0"></h5> 
                    </div>
                    <div class="card-body">
                      <form action="resetaccount.php" method="POST">
                        <div class="mb-3">
                          <label class="form-label " for="basic-icon-default-company"><h6><?php echo $lang["confirmpassword"]; ?></h6></label>
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
                        <button type="submit" name="login" class="btn btn-primary"><?php echo $lang["save"]; ?></button>
                      </form>
                    </div>
                     <?php
                  if (isset($_POST['login'])) {
                    include "../includes/connect.php"; 
                    $query=mysqli_query($con,"SELECT password FROM accounts WHERE type='$_SESSION[user]'");
                    $pass=mysqli_fetch_array($query);
                    if ($pass["password"]==$_POST['password']) {
                      $_SESSION['confirmed']=="confirmed";
                      echo "<script>window.location.href='profile.php';</script>";
          exit;
                    }
                    else{
                       echo "<h6 class='text-center text-danger'>Incorrect Password</h6>";
                      
                    }

                  }
                  ?>
                  </div>
                 

                </div>

                </div>
               <!-- Dismissible Alerts -->
                <?php include "../includes/notifications.php" ?>
                <!--/ Dismissible Alerts -->
               
                
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
           <?php include "../includes/footer.php"; ?>
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
   <?php include "../includes/jslinks.php"; ?>
  </body>
</html>
