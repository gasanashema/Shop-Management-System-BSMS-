<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
include "../includes/connect.php";
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

    <title>Dashboard|BSMS</title>

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
                <h5 class="card-header"><?php echo $lang["debt"]; ?></h5>
                <div class="card-body">

                  <div class="table-responsive ">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="background-color: #f2f2f2;">
                          <th>No</th>
                          <th><?php echo $lang["clientname"]; ?></th>
                          <th><?php echo $lang["phone"]; ?></th>
                          <th><?php echo $lang["productname"]; ?></th>
                          <th><?php echo $lang["quantity"]; ?></th>
                          <th><?php echo $lang["price"]; ?></th>
                          <th><?php echo $lang["totalamount"]; ?></th>
                          <th><?php echo $lang["paymentdate"]; ?></th>
                          <th><?php echo $lang["comment"]; ?></th>
                          <th><?php echo $lang["status"]; ?></th>
                          <th><?php echo $lang["actions"]; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        include "../includes/connect.php";
                        $query=mysqli_query($con,"SELECT * FROM debt INNER JOIN stock_out INNER JOIN stock_in INNER JOIN products INNER JOIN clients ON debt.stock_out_id=stock_out.stock_out_id AND debt.client_id=clients.client_id AND stock_out.stock_in_id=stock_in.stock_in_id AND stock_in.p_id=products.p_id ORDER BY payment_status ASC");
                        if (mysqli_num_rows($query)<1) {
                         echo "<h5 class='text-center text-muted'>No Debts</h5>";
                        }
                        else{
                          $i=1;
                          while ($row=mysqli_fetch_array($query)) {

                            // checking if payment date has reached passed or not yet reached
                              
                              // codes to get dates and calculate days
                              
                              $str_date1 =Date("Y-m-d");
                              $str_date2 = $row["debt_payment_date"];
                              
                              $date1=strtotime($str_date1);
                              $date2=strtotime($str_date2);
                              
                              //get the interval 
                              $daysCalc= ($date2 - $date1)/60/60/24;
                              $date= intval($daysCalc);
                              
                              // ending
                          ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td class="text-nowrap text-capitalize"><?php echo $row["client_names"]; ?></td>
                          <td><?php echo $row["client_phone"]; ?></td>
                          <td class="text-capitalize"><?php echo $row["product_name"]; ?></td>
                          <td><?php echo $row["quantity_out"]; ?></td>
                          <td class="text-nowrap"><?php echo $row["unit_price"]; ?></td>
                          <td class="text-nowrap"><?php echo $row["unit_price"]*$row["quantity_out"]; ?></td>
                          <td class="text-nowrap"><?php echo $row["debt_payment_date"]; ?></td>
                          <td class="text-nowrap">
                            <?php
                            if ($date==0) {
                              echo $lang["willbepaidtoday"];
                            }else if($date<0){
                              echo $lang["timehaspassed"];
                            }else{
                              echo $lang["timenotreached"];
                            }
                            ?>
                              
                            </td>
                          <td class="text-nowrap"><?php if($row["payment_status"]=="paid"){
                            echo $lang["dpaid"];
                          }else{
                            echo $lang["dnotpaid"];
                          } ?></td>

                          
                          <td>
                            <?php
                            if ($row["payment_status"]=="paid") {
                             ?>
                            <a href="viewdebts.php?not_id=<?php echo $row['debt_id']; ?>" class="btn btn-info text-dark text-nowrap"><?php echo $lang["dpaid"]; ?> &#10003;</a>
                            <?php
                            }else{
                              ?>
                            <a href="viewdebts.php?paid_id=<?php echo $row['debt_id']; ?>" class="btn btn-danger text-dark text-nowrap"><?php echo $lang["dnotpaid"]; ?> &times;</a>
                            <?php
                            }
                            ?>
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
                  <?php
                  if (isset($_GET['paid_id'])) {
                   $update=mysqli_query($con,"UPDATE debt SET payment_status='paid' WHERE debt_id='$_GET[paid_id]'");
                   if ($update) {
                     echo "<script>alert('".$lang["markedaspaid"]."')</script>";
                   }
                  }
                  if (isset($_GET['not_id'])) {
                   $update=mysqli_query($con,"UPDATE debt SET payment_status='not paid' WHERE debt_id='$_GET[not_id]'");
                   if ($update) {
                     echo "<script>alert('".$lang["markedasnotpaid"]."')</script>";

                   }
                  }
                  ?>
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
