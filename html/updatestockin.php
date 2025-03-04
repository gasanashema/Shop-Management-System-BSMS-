<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="stock_in";
unset($_SESSION["confirmed"]);
if(!isset($_GET['updid'])){
  echo "<script>window.location.href='viewstockin.php';</script>";
}
else{
  $id=$_GET['updid'];
  include "../includes/connect.php";
  $query=mysqli_query($con,"SELECT * FROM stock_in INNER JOIN products ON stock_in.p_id=products.p_id WHERE stock_in_id='$id'");
  $row=mysqli_fetch_array($query);
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

    <title>Dashboard | BSMS</title>

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
                  <div class="card mb-2 mx-5">
                      <!-- Register -->
          <div class="card">
            <div class="card-body">
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
                  <span class="app-brand-text demo text-capitalize text-body fw-bolder"><?php echo $lang["updatedata"]; ?></span>
                </a>
              </div>
              <!-- /Logo -->
              
              <form id="formAuthentication" class="mb-3" action="updatestockin.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $row['stock_in_id']; ?>">
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["productname"]; ?></label>
                  <select class="form-select"  name="pname" required>
                    <option value="<?php echo $row["p_id"]; ?>"><?php echo $row["product_name"]; ?></option>
                    <?php
                    include "../includes/connect.php";

                    $prod=mysqli_query($con,"SELECT * FROM products");
                    
                      while ($data=mysqli_fetch_array($prod)) {
                        if ($data["p_id"]==$row["p_id"]) {
                          continue;
                        }
                        ?>
                        <option value="<?php echo $data["p_id"]; ?>"><?php echo $data["product_name"]; ?></option>
                        <?php
                    }
                    ?>
                  </select>

                </div>
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["quantity"]; ?></label>
                  <input
                    type="number"
                    class="form-control"
                    id="email"
                    name="quantity"
                    value="<?php echo $row["quantity_in"]; ?>"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["unitprice"]; ?></label>
                  <input
                    type="number"
                    class="form-control"
                    id="email"
                    name="unit_price"
                    value="<?php echo $row["unit_price"]; ?>"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["sellprice"]; ?></label>
                  <input
                    type="number"
                    class="form-control"
                    id="email"
                    value="<?php echo $row["sell_price"]; ?>"
                    name="sell_price"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label"><?php echo $lang["expiration"]; ?></label>
                  <input
                    type="date"
                    class="form-control"
                    id="dateInput"
                    name="expiration"
                    value="<?php echo $row["expired_date"]; ?>"
                    required
                  />
                </div>
                
                
                
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit" name="save"><?php echo $lang["save"]; ?></button>
                </div>
              </form>

             
            </div>
            <!-- php -->
<?php
    if (isset($_POST["save"])) {
      include "../includes/connect.php";
      $date=date("Y-m-d");
             $update=mysqli_query($con,"UPDATE stock_in SET p_id='$_POST[pname]',quantity_in='$_POST[quantity]',unit_price='$_POST[unit_price]',sell_price='$_POST[sell_price]',expired_date='$_POST[expiration]' WHERE stock_in_id='$_POST[id]'");
        if ($update) {
          
          echo "<script>alert('".$lang["done"]."')</script>";
        }
      }
    ?>
            <!-- /php -->

          </div>
          <!-- /Register -->
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
