<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="stock_out";
unset($_SESSION["confirmed"]);
if(!isset($_GET['updid'])){
  echo "<script>window.location.href='viewstockout.php';</script>";
}
else{
  $id=$_GET['updid'];
  include "../includes/connect.php";
// checking if it's cash or debt
  $check_pay=mysqli_query($con,"SELECT payment FROM stock_out WHERE stock_out_id='$id'");
  $check_pay_fetch=mysqli_fetch_array($check_pay);


  // if condition to check debt
  if ($check_pay_fetch["payment"]=="debt") {
  
// codes to be executed when payment is debt

  $query=mysqli_query($con,"SELECT * FROM stock_out INNER JOIN stock_in INNER JOIN products INNER JOIN debt INNER JOIN clients ON  stock_out.stock_in_id=stock_in.stock_in_id AND debt.stock_out_id=stock_out.stock_out_id AND stock_in.p_id=products.p_id AND debt.client_id=clients.client_id  WHERE stock_out.stock_out_id='$id'");
  $row=mysqli_fetch_array($query);

  // -----------------------------------

          // i'm going to calculate total stock in
          $total_stockin_forproduct=mysqli_query($con,"SELECT SUM(quantity_in) AS totat_stockin_pro FROM stock_in WHERE p_id='$row[p_id]'");
          $total_in=mysqli_fetch_array($total_stockin_forproduct);

          // i'm going to calculate total stock out
          $total_stockout_forproduct=mysqli_query($con,"SELECT SUM(quantity_out) AS totat_stockout_pro FROM stock_out INNER JOIN stock_in WHERE stock_in.p_id='$row[p_id]'");
          $total_out=mysqli_fetch_array($total_stockout_forproduct);

          // calculating remaining quantity
          $remaining_quantity = $total_in["totat_stockin_pro"] - $total_out["totat_stockout_pro"];

  // -----------------------------------
    }else{
   $query=mysqli_query($con,"SELECT * FROM stock_out INNER JOIN stock_in INNER JOIN products  ON  stock_out.stock_in_id=stock_in.stock_in_id AND stock_in.p_id=products.p_id  WHERE stock_out.stock_out_id='$id'");
  $row=mysqli_fetch_array($query);

  // -----------------------------------

          // i'm going to calculate total stock in
          $total_stockin_forproduct=mysqli_query($con,"SELECT SUM(quantity_in) AS totat_stockin_pro FROM stock_in WHERE p_id='$row[p_id]'");
          $total_in=mysqli_fetch_array($total_stockin_forproduct);

          // i'm going to calculate total stock out
          $total_stockout_forproduct=mysqli_query($con,"SELECT SUM(quantity_out) AS totat_stockout_pro FROM stock_out INNER JOIN stock_in WHERE stock_in.p_id='$row[p_id]'");
          $total_out=mysqli_fetch_array($total_stockout_forproduct);

          // calculating remaining quantity
          $remaining_quantity = $total_in["totat_stockin_pro"] - $total_out["totat_stockout_pro"];

  // -----------------------------------
}
}
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
                 
            <?php include "forms/updatestockoutform.php"; ?>
                  

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
   <script>
        // Get the current date
        var currentDate = new Date().toISOString().split("T")[0];

        // Get the date input element
        var dateInput = document.getElementById("dateInput");

        // Set the minimum date attribute to the current date
        dateInput.min = currentDate;
    </script>
  </body>
</html>
