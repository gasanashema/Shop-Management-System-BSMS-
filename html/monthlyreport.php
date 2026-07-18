<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="report";
unset($_SESSION["confirmed"]);
  $year = date("Y");
  $month = date("m");
  
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
                <h5 class="card-header"><?php echo $lang["monthlyreport"]; ?></h5>
                <div class="card-body">

                  <div class="table-responsive ">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="text-nowrap" style="background-color: #f2f2f2;">
                          <th>No</th>
                          <th><?php echo $lang["productname"]; ?></th>
                          <th><?php echo $lang["quality"]; ?></th>
                          <th><?php echo $lang["manufacturer"]; ?></th>
                          <th><?php echo $lang["purchase"]; ?></th>
                          <th><?php echo $lang["purchaseamount"]; ?></th>
                          <th><?php echo $lang["expectedincome"]; ?></th>
                          <th><?php echo $lang["quantitysold"]; ?></th>
                          <th><?php echo $lang["remaining"]; ?></th>
                          <th><?php echo $lang["income"]; ?></th>
                          <th><?php echo $lang["interest"]; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sum_inc = 0;
                       $sum_int = 0;
                        include "../includes/connect.php";
                         $query=mysqli_query($con,"SELECT 
                             p.p_id, 
                             p.product_name, 
                             p.quality, 
                             p.manufacturer,
                             sin.q_in,
                             sin.total_price,
                             sin.expected_income,
                             sout.total_q_out,
                             sout.t_income,
                             sout.intrest
                         FROM products p
                         INNER JOIN (
                             SELECT 
                                 p_id,
                                 SUM(quantity_in) AS q_in,
                                 SUM(quantity_in * unit_price) AS total_price,
                                 SUM(quantity_in * sell_price) AS expected_income
                             FROM stock_in
                             GROUP BY p_id
                         ) sin ON p.p_id = sin.p_id
                         LEFT JOIN (
                             SELECT 
                                 si.p_id,
                                 SUM(so.quantity_out) AS total_q_out,
                                 SUM(so.quantity_out * si.sell_price) AS t_income,
                                 SUM((si.sell_price - si.unit_price) * so.quantity_out) AS intrest
                             FROM stock_out so
                             INNER JOIN stock_in si ON so.stock_in_id = si.stock_in_id
                             WHERE DATE_FORMAT(si.date_registered, '%Y-%m') = '{$year}-{$month}'
                             GROUP BY si.p_id
                         ) sout ON p.p_id = sout.p_id
                         ORDER BY p.product_name ASC");
                         if (mysqli_num_rows($query)<1) {
                          echo "<h5 class='text-center text-muted'>No Report Available</h5>";
                         }
                         else{
                           $i=1;
                           while ($row=mysqli_fetch_array($query)) {
                           ?>
                         <tr>
                           <td><?php echo $i; ?></td>
                           <td><?php echo $row["product_name"]; ?></td>
                           <td class="text-nowrap"><?php echo $lang["quality"].$row["quality"]; ?></td>
                           <td><?php echo $row["manufacturer"]; ?></td>
                           <td><?php echo $row["q_in"]; ?></td>
                           <td><span id="numbersTable"><?php echo $row["total_price"]; ?></span> Rwf</td>
                           <td><span id="numbersTable"><?php echo $row["expected_income"]-$row["total_price"];?></span> Rwf</td>
                           <td <?php if ($row["total_q_out"]==NULL) {
                             echo "class='bg-danger text-dark'";
                           } ?>>
                             <?php
                           if ($row["total_q_out"]==NULL) {
                             echo 0;
                           }else{
                            echo $row["total_q_out"]; 
                           }
                          ?></td>
                           <td><?php $remaining= $row["q_in"]-$row["total_q_out"];
                            if($remaining <0){
                             echo "<span class='text-danger'>0</span>";
                            }
                            else{
                             echo $remaining;
                            }
                           ?>
                             
                           </td>
                           <td <?php if ($row["t_income"]==NULL) {
                             echo "class='bg-danger text-dark'";
                           } ?>><span id="numbersTable">
                           <?php
                           if ($row["t_income"]==NULL) {
                             echo 0;
                           }else{
                            echo $row["t_income"]; 
                           }
                          ?></span> Rwf</td>
                             <td <?php if ($row["intrest"]==NULL) {
                             echo "class='bg-danger text-dark'";
                           } ?>><span id="numbersTable">
                               <?php
                             if ($row["intrest"]==NULL) {
                               echo 0;
                             }else{
                              echo $row["intrest"]; 
                             }
                            ?></span> Rwf</td>
                                              
                         </tr>

                           <?php

                           $sum_inc += $row["t_income"];
                           $sum_int += $row["intrest"];

                           $i++;
                           }
                         }


                        ?>
                         <tr>
                          <td colspan="9" class="bg-info"><h5><?php echo $lang["total"]; ?> :</h5></td>
                          <td class="bg-success text-nowrap"><span id="numbersTable"> <?php echo $sum_inc;  ?></span> Rwf</td>
                          <td class="bg-success text-nowrap"><span id="numbersTable"> <?php echo $sum_int;  ?></span> Rwf</td>
                        </tr>
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

<script type="text/javascript">
        
        window.addEventListener('DOMContentLoaded', function() {
  var numbers = document.querySelectorAll('#numbersTable');

  numbers.forEach(function(numberCell) {
    var number = parseInt(numberCell.innerHTML);
    numberCell.innerHTML = number.toLocaleString();
  });
});

      </script>

    <!-- Core JS -->
   <?php include "../includes/jslinks.php"; ?>
  </body>
</html>
