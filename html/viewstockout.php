<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="stock_out";
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
                    <!-- Bordered Table -->
              <div class="card">
                <h5 class="card-header"><?php echo $lang["sales"]; ?></h5>
                <div class="card-body">

                  <div class="table-responsive ">
                    <table class="table table-bordered text-dark">
                      <thead>
                        <tr class="text-nowrap" style="background-color: #f2f2f2;">
                          <th>No</th>
                          <th><?php echo $lang["dateandtimesold"]; ?></th>
                          <th><?php echo $lang["productname"]; ?></th>
                          <th><?php echo $lang["quality"]; ?></th>
                          <th><?php echo $lang["manufacturer"]; ?></th>
                          <th><?php echo $lang["quantitysold"]; ?></th>
                          <th><?php echo $lang["price"]; ?></th>
                          <th><?php echo $lang["paidamount"]; ?></th>
                          <th><?php echo $lang["interest"]; ?></th>
                          <th><?php echo $lang["payment"]; ?></th>
                          
                          <th><?php echo $lang["actions"]; ?></th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        include "../includes/connect.php";
                        $query=mysqli_query($con,"SELECT * FROM stock_out INNER JOIN stock_in INNER JOIN products ON stock_out.stock_in_id=stock_in.stock_in_id AND stock_in.p_id=products.p_id ORDER BY date_sold desc");
                        if (mysqli_num_rows($query)<1) {
                         echo "<h5 class='text-center text-muted'>No Stock in Done</h5>";
                        }
                        else{
                          $i=1;
                          while ($row=mysqli_fetch_array($query)) {
                          ?>
                        <tr class="text-nowrap text-capitalize">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row["date_sold"]; ?></td>
                          <td><?php echo $row["product_name"]; ?></td>
                          <td><?php echo $lang["quality"].$row["quality"]; ?></td>
                          <td><?php echo $row["manufacturer"]; ?></td>
                          <td><?php echo $row["quantity_out"]; ?></td>
                          <td><?php echo $row["sell_price"]; ?></td>
                          <td class="text-nowrap"><?php echo $row["sell_price"] * $row["quantity_out"]; ?></td>
                          <td>
                             <!-- total income codes -->
                            <?php
                                $total_income=($row["sell_price"] * $row["quantity_out"]) - ($row["unit_price"] * $row["quantity_out"]);
                             if($total_income<=0){
                              echo "<span class='text-danger'>".$total_income."</span>";
                             }else{
                              echo $total_income;
                             }
                            ?>
                            <!-- ----------- -->
                            </td>
                          <td><?php
                           if($row["payment"]=="cash"){
                            echo $lang["haspaid"];
                           } 
                           else{
                            echo $lang["debtpay"];
                           }
                        ?></td>
                          
                            
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
                                <a class="dropdown-item" href="#">
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
