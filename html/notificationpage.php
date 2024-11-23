<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="reset_acc";
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
                <div class="col-md  d-lg-block" >
<div class="card">
  <h5 class="card-header">Notifications</h5>
   <div class="card-body">

<?php

// --------------------
//  here we are going to find notifications
include "../includes/connect.php";
$notify=mysqli_query($con,"SELECT * FROM debt INNER JOIN stock_out INNER JOIN stock_in INNER JOIN clients ON debt.stock_out_id=stock_out.stock_out_id AND debt.client_id=clients.client_id AND stock_out.stock_in_id=stock_in.stock_in_id WHERE payment_status <> 'paid' ORDER BY debt_payment_date asc ");
$i=0;
$count=0;
if (mysqli_num_rows($notify)<1) {
 echo "<span class='text-primary'>No Notifications Today<span>";
}
while($notification=mysqli_fetch_array($notify)){
$str_date1 =Date("Y-m-d");
$str_date2 = $notification["debt_payment_date"];

$date1=strtotime($str_date1);
$date2=strtotime($str_date2);

//get the interval 
$daysCalc= ($date2 - $date1)/60/60/24;
$date= intval($daysCalc);

// ------------------------

if ($date>0 and $date<=3) {

  ?>


   <div class="alert alert-primary text-dark alert-dismissible" role="alert">
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["client_names"];?></span><?php echo $lang["withphone"]; ?> 

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["client_phone"];?></span>
      <?php echo $lang["remains"]; ?>

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php if($date==1){echo $lang["day"].$date;}else{echo $lang["days"].$date;}; ?></span>
      <?php echo $lang["topaydebtof"]; ?>

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["quantity_out"]*$notification["sell_price"]; ?> RWF </span>
      <?php echo $lang["takenon"]; ?>
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["date_sold"];?></span>

      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>




  <?php
  $i++;
  $count++;
}
else if ($date==0) {
 ?>

 <div class="alert alert-primary text-dark alert-dismissible" role="alert">
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["client_names"];?></span> <?php echo $lang["withphone"]; ?> 

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["client_phone"];?></span>
      <?php echo $lang["willpay"]; ?>   

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $lang["today"] ?></span>
       <?php echo $lang["debtof"]; ?>

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["quantity_out"]*$notification["sell_price"]; ?> RWF </span>
      <?php echo $lang["takenon"]; ?>
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["date_sold"];?></span>

      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


 <?php

 $i++;
 $count++;
}
else if ($date < 0) {
  ?>
<div class="alert alert-primary text-dark alert-dismissible" role="alert">
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["client_names"];?></span> <?php echo $lang["withphone"]; ?> 

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["client_phone"];?></span>
      <?php echo $lang["spent"]; ?>
       
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $date * -1;?></span>
        <?php echo $lang["withoutpaying"]; ?>

      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["quantity_out"]*$notification["sell_price"]; ?> RWF </span>
      <?php echo $lang["takenon"]; ?>
      <span class="<?php echo 'text-primary'; ?> text-capitalize"><?php echo $notification["date_sold"];?></span>

      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  <?php
}
else{
continue;
}
}
$_SESSION['notification']=$count;

?>
   </div>
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
