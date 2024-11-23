<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="stock_in";
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
                <div class="col-lg-12 mb-4 order-0">
                  
                  <!-- card -->
                  <div class="card mb-2">

                    <?php

                    if (isset($_GET['delid'])) {
                      $id=$_GET['delid'];
                      include "../includes/connect.php";
                     
                      echo "
                      <form class='p-2' action='viewstockin.php' method='POST'>
                      <input type='hidden' value='".$id."' name='id'>
                      <p><h4>".$lang["suredeletestockin"]."</h4></p>
                       <button type='submit' name='yes' class='btn btn-danger'>".$lang["yes"]."</button>
                       <button type='submit' name='no' class='btn btn-info'>".$lang["no"]."</button>
                       </form>
                       ";
                     
                      
                      
                    }
                    ?>
                    <?php
                    if (isset($_POST['yes'])) {
                      include "../includes/connect.php";
                      $delete=mysqli_query($con,"DELETE FROM stock_in WHERE stock_in_id='$_POST[id]'");
                      if ($delete) {
                        echo "<script>alert('Record Deleted')</script>";
                      }
                    }
                    if (isset($_POST["no"])) {
                      unset($_GET['delid']);
                    }
                    ?>
                    <!-- Bordered Table -->
              <div class="card">
                <h5 class="card-header">Stock</h5>
                <div class="card-body">

                  <div class="table-responsive ">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="background-color: #f2f2f2;">
                          <th>No</th>
                          <th><?php echo $lang["dateregistered"]; ?></th>
                          <th><?php echo $lang["productname"]; ?></th>
                          <th><?php echo $lang["quality"]; ?></th>
                          <th><?php echo $lang["quantity"]; ?></th>
                          <th><?php echo $lang["unitprice"]; ?></th>
                          <th><?php echo $lang["totalprice"]; ?></th>
                          <th><?php echo $lang["sellprice"]; ?></th>
                          <th><?php echo $lang["totalincome"]; ?></th>
                          <th><?php echo $lang["interest"]; ?></th>
                          <th><?php echo $lang["expiration"]; ?></th>
                          <?php if ($_SESSION['user']=="manager") {
                            ?>
                          <th><?php echo $lang["actions"]; ?></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        include "../includes/connect.php";
                        $query=mysqli_query($con,"SELECT * FROM stock_in INNER JOIN products ON stock_in.p_id=products.p_id ORDER BY date_registered DESC");
                        if (mysqli_num_rows($query)<1) {
                         echo "<h5 class='text-center text-muted'>No Stock In Done</h5>";
                        }
                        else{
                          $i=1;
                          while ($row=mysqli_fetch_array($query)) {
                          ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row["date_registered"]; ?></td>
                          <td><?php echo $row["product_name"]; ?></td>
                          <td class="text-nowrap"><?php echo $lang["quality"].$row["quality"]; ?></td>
                          <td><?php echo $row["quantity_in"]; ?></td>
                          <td><?php echo $row["unit_price"]; ?></td>
                          <td><?php
                          $total_s=$row["unit_price"] * $row["quantity_in"];
                           echo $total_s; 
                          ?></td>
                          <td><?php echo $row["sell_price"]; ?></td>
                          <td><?php
                              $total_income=$row["sell_price"] * $row["quantity_in"];
                           if($total_income<=0){
                            echo "<span class='text-danger'>".$total_income."</span>";
                           }
                           else{
                            echo $total_income;
                           }
                            ?></td>
                            <td><?php echo $total_income - $total_s; ?></td>
                          <td class="text-nowrap"><?php echo $row["expired_date"]; ?></td>
                          <?php if ($_SESSION['user']=="manager") {
                            ?>
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
                                <a class="dropdown-item" href="updatestockin.php?updid=<?php echo $row['stock_in_id']; ?>">
                                <i class="bx bx-edit-alt me-1"></i><?php echo $lang["edit"]; ?></a>
                                <a class="dropdown-item" href="viewstockin.php?delid=<?php echo $row['stock_in_id']; ?>"
                                  ><i class="bx bx-trash me-1"></i> <?php echo $lang["delete"]; ?></a
                                >
                              </div>
                            </div>
                          </td>
                          <?php } ?>
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
