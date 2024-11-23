<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="report";
unset($_SESSION["confirmed"]);
  $today = date("Y-m-d");
  

  
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
                <h5 class="card-header"><?php echo $lang["dailyreport"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".date("Y-m-d"); ?></h5>
                <div class="card-body">

                  <div class="table-responsive ">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="text-nowrap" style="background-color: #f2f2f2;">
                          <th>No</th>
                          <th><?php echo $lang["product"]; ?></th>
                          <th><?php echo $lang["quality"]; ?></th>
                          <th><?php echo $lang["manufacturer"]; ?></th>
                          <th><?php echo $lang["sold"]; ?></th>
                          <th><?php echo $lang["remaining"]; ?></th>
                          <th><?php echo $lang["income"]; ?></th>
                          <th><?php echo $lang["interest"]; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "../includes/connect.php";
                        $d_report=mysqli_query($con,"SELECT * FROM stock_out INNER JOIN stock_in INNER JOIN products ON stock_out.stock_in_id=stock_in.stock_in_id AND stock_in.p_id=products.p_id WHERE stock_out.date_sold='$today' GROUP BY product_name ORDER BY product_name ASC");
                       $i=1;
                       $sum_inc = 0;
                       $sum_int = 0;
                        while($row=mysqli_fetch_array($d_report)){
                          $check=mysqli_query($con,"SELECT SUM(quantity_out) as q_out,SUM(quantity_out*sell_price) AS t_income,SUM((sell_price-unit_price)*quantity_out) AS intrest FROM stock_out INNER JOIN stock_in INNER JOIN products ON stock_out.stock_in_id=stock_in.stock_in_id AND stock_in.p_id=products.p_id WHERE products.p_id='$row[p_id]' AND stock_out.date_sold='$today'");
                            $records=mysqli_fetch_array($check);

                         // ----------------------------------------------------------

                            // getting total stockin
          $total_in=mysqli_query($con,"SELECT SUM(quantity_in) as total_s_in from stock_in WHERE p_id='$row[p_id]'");
          $s_in=mysqli_fetch_array($total_in);

          // check if total stock in quantity is not null
          if ($s_in["total_s_in"]==NULL) {
            $stock_in_quantity=0;
          }
          else{ 
          $stock_in_quantity=$s_in["total_s_in"];
          }
          // -----------------------------
          

          // getting total stock_out

          $total_out=mysqli_query($con,"SELECT SUM(quantity_out) as total_s_out from stock_out INNER JOIN stock_in ON stock_out.stock_in_id=stock_in.stock_in_id WHERE stock_in.p_id='$row[p_id]'");
          $s_out=mysqli_fetch_array($total_out);

           // check if total stock in quantity is not null
          if ($s_out["total_s_out"]==NULL) {
            $stock_out_quantity=0;
          }
          else{ 
          $stock_out_quantity=$s_out["total_s_out"];
          }
          // -----------------------------

          // calculating remaining quantity
          $remaining_quantity=$stock_in_quantity-$stock_out_quantity;



                          //---------------------------------------------------------- 
                         
                          ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row["product_name"]; ?></td>
                          <td class="text-nowrap"><?php echo $lang["quality"].$row["quality"]; ?></td>
                          <td><?php echo $row["manufacturer"]; ?></td>
                          <td><?php echo $records["q_out"];?></td>
                          <td><?php
                           if($remaining_quantity <0){
                            echo "<span class='text-danger'>0</span>";
                           }else{
                            echo $remaining_quantity;
                           }
                         ?></td>
                          <td class="text-nowrap"><span id="numbersTable"> <?php echo $records["t_income"];?> </span> Rwf</td>
                          <td class="text-nowrap"><span id="numbersTable"> <?php echo $records["intrest"];?> </span> Rwf</td>
                                             
                        </tr>
                      
                          <?php
                          $sum_inc += $records["t_income"];
                          $sum_int += $records["intrest"];
                          $i++;
                        }

                        ?>
                        <tr>
                          <td colspan="6" class="bg-info"><h5>Total :</h5></td>
                          <td class="bg-success text-nowrap" ><span id="numbersTable"><?php echo $sum_inc;  ?></span> Rwf</td>
                          <td class="bg-success text-nowrap"><span id="numbersTable"><?php echo $sum_int;  ?> </span> Rwf</td>
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
