<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}

include "../includes/connect.php";
$_SESSION['page']="stock_out";
unset($_SESSION["confirmed"]);

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
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
              <div class="row" >
                <div class="col-lg-8 mb-4 order-0">
                 
                  <!-- card -->
                  <div class="card mb-2 mx-5" id="i_will_hide">
                      <!-- Register -->
          <div class="card">
            <div class="card-body" >
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <svg
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs>
                        <path
                          d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                          id="path-1"
                        ></path>
                        <path
                          d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                          id="path-3"
                        ></path>
                        <path
                          d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                          id="path-4"
                        ></path>
                        <path
                          d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                          id="path-5"
                        ></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#696cff" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#696cff" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-capitalize text-body fw-bolder"><?php echo $lang["addsales"]; ?></span>
                </a>
              </div>
              <!-- /Logo -->
              <div class="alert alert-danger mt-2 fs-4" role="alert"><?php echo $lang["checkproductavailability"]; ?></div>
              <form id="formAuthentication" class="mb-3" action="newstockout.php" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["productname"]; ?></label>
                  <select class="form-select"  name="pname" required>
                    <option value=""><?php echo $lang["selectproduct"]; ?></option>
                    <?php
                    include "../includes/connect.php";
                    $prod=mysqli_query($con,"SELECT DISTINCT product_name FROM products ORDER BY product_name ASC");
                    
                      while ($row=mysqli_fetch_array($prod)) {
                        ?>
                        <option value="<?php echo $row["product_name"]; ?>"><?php echo $row["product_name"]; ?></option>
                        <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["quality"]; ?></label>
                  <select class="form-select" name="quality" required>
                    <option value=""><?php echo $lang["selectquality"]; ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["manufacturer"]; ?></label>
                  <select class="form-select" name="manufacture" required>
                    <option value=""><?php echo $lang["selectmanufacturer"]; ?></option>
                    <?php
                    include "../includes/connect.php";
                    $prod=mysqli_query($con,"SELECT DISTINCT manufacturer FROM products ORDER BY manufacturer asc");
                    
                      while ($qual=mysqli_fetch_array($prod)) {
                        ?>
                        <option value="<?php echo $qual['manufacturer']; ?>"><?php echo $qual['manufacturer']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                  
                
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit" name="save"><?php echo $lang["check"]; ?></button>
                </div>
              </form>

             
            </div>
            <!-- php -->
          </div>
              <!-- /Register -->
                  </div>
                  <!-- /card -->
<?php

function stock_in_check($pro_name,$pro_qual,$pro_manu)
      {
        include "../includes/connect.php";
        // check product availability
        $pro_check=mysqli_query($con,"SELECT * FROM products where product_name='$pro_name' and quality='$pro_qual' AND manufacturer='$pro_manu'");
        // -----
        if (mysqli_num_rows($pro_check)<1) {
          echo "<script>alert('Product Not available')</script>";
        }
        else{
          // getting the id when the product is found
          $stOut=mysqli_fetch_array($pro_check);


          // getting data from stock in for just in case
          $st_InData=mysqli_query($con,"SELECT * FROM stock_in WHERE p_id='$stOut[p_id]' ORDER BY date_registered desc LIMIT 1");
          $st_in_id=mysqli_fetch_array($st_InData);

          // hidding the check product form
          echo '<script>document.getElementById("i_will_hide").style.display="none";</script>';

          // getting total stockin
          $total_in=mysqli_query($con,"SELECT SUM(quantity_in) as total_s_in from stock_in WHERE p_id='$stOut[p_id]'");
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

          $total_out=mysqli_query($con,"SELECT SUM(quantity_out) as total_s_out from stock_out INNER JOIN stock_in ON stock_out.stock_in_id=stock_in.stock_in_id WHERE stock_in.p_id='$stOut[p_id]'");
          $s_out=mysqli_fetch_array($total_out);

           // check if total stock in quantity is not null
          if ($s_out["total_s_out"]==NULL) {
            $stock_out_quantity=0;
          }
          else{ 
          $stock_out_quantity=$s_out["total_s_out"];
          }
          // -----------------------------

          // fetching stock_in data to be able to get sell price and other data needed from stock_in table.
          $stock_in_data=mysqli_query($con,"SELECT * FROM stock_in WHERE p_id='$stOut[p_id]' ORDER BY date_registered desc LIMIT 1");
          $stock_in_data_fetch=mysqli_fetch_array($stock_in_data);



          // calculating remaining quantity
          $remaining_quantity=$stock_in_quantity-$stock_out_quantity;



         
include "forms/stockoutform.php";
        }
      
// function close
      }






    if (isset($_POST["save"])) {
      include "../includes/connect.php";
      
      // calling a function
      stock_in_check($_POST['pname'],$_POST['quality'],$_POST['manufacture']);
      }
    ?>
            <!-- /php -->

          
        
                  

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

<script type="text/javascript">
  function i_will_hide() {
  document.getElementById("i_will_hide").style.display="none";
  }
</script>


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
