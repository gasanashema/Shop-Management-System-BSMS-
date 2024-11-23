<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="debt";
unset($_SESSION["confirmed"]);
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
                  
                  <!-- card -->
                  <div class="card mb-2">

                    <?php
                    if (isset($_POST['yes'])) {
                      include "../includes/connect.php";
                      $delete=mysqli_query($con,"DELETE FROM products WHERE p_id='$_POST[id]'");
                      if ($delete) {
                        echo "<script>alert('".$lang["done"]."')</script>";
                      }
                    }
                    if (isset($_POST["no"])) {
                      unset($_GET['delid']);
                    }
                    ?>
                    <!-- Bordered Table -->
              <div class="card">
                <h5 class="card-header text-capitalize"><?php echo $lang["manageclient"]; ?></h5>
                <div class="card-body">

                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th><?php echo $lang["clientname"]; ?></th>
                          <th><?php echo $lang["phone"]; ?></th>
                          <th><?php echo $lang["actions"]; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        include "../includes/connect.php";
                        $query=mysqli_query($con,"SELECT * FROM clients");
                        if (mysqli_num_rows($query)<1) {
                         echo "<h5 class='text-center text-muted'>No Clients Registered</h5>";
                        }
                        else{
                          $i=1;
                          while ($row=mysqli_fetch_array($query)) {
                          ?>
                        <tr>
                          <td>
                            <?php echo $i; ?>
                          </td>
                          <td><?php echo $row["client_names"]; ?></td>
                          <td><?php echo $row["client_phone"]; ?></td>
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="updateclient.php?updid=<?php echo $row['client_id']; ?>">
                                <i class="bx bx-edit-alt me-1"></i> <?php echo $lang["edit"]; ?></a>
                              </div>
                            </div>
                          </td>
                        </tr>

                          <?php
                          $i++;
                          }
                        }


                        ?>
                        
                      </tbody>
                    </table>
                   
                  </div>
                  
                </div>
              </div>
              <!--/ Bordered Table -->
                  </div>
                  <!-- /card -->
                  

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
