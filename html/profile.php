<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("location:../index.php");
}
$_SESSION['page']="product";

include "../includes/connect.php";

$person=mysqli_query($con,"SELECT * FROM accounts WHERE type='$_SESSION[user]'");
$data=mysqli_fetch_array($person);
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

             <div class="card mb-4">
                    <h5 class="card-header"><?php echo $lang["profiledetails"]; ?></h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../assets/img/avatars/1.gif"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block"><?php echo $lang["uploadphoto"]; ?></span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          

                          <p class="text-muted mb-0"><?php echo $lang["alowed"]; ?> JPG, GIF <?php echo $lang["or"]; ?> PNG.</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST"  action="profile.php">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label"><?php echo $lang["names"]; ?></label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="names"
                             value="<?php echo $data['names']; ?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label"><?php echo $lang["privilage"]; ?></label>
                            <input class="form-control text-capitalize" type="text" readonly name="type" id="lastName" value="<?php echo $data['type']; ?>" />
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber"><?php echo $lang["phone"]; ?></label>
                            <div class="input-group input-group-merge">
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phone"
                                class="form-control"
                                value="<?php echo $data['phone']; ?>"
                              />
                            </div>
                          </div>


                    <div class="form-password-toggle mb-3 col-md-6">
                        <label class="form-label" for="basic-default-password12"><?php echo $lang["password"]; ?></label>
                        <div class="input-group">
                          <input
                            type="password"
                            class="form-control"
                            id="basic-default-password12"
                            aria-describedby="basic-default-password2"
                            name="password"
                            value="<?php echo $data['password']; ?>"
                          />
                          <span id="basic-default-password2" class="input-group-text cursor-pointer"
                            ><i class="bx bx-hide"></i
                          ></span>
                        </div>
                      </div>
                    </div>



                        <div class="mt-2">
                          <button type="submit" name="reset" class="btn btn-primary me-2"><?php echo $lang["save"]; ?></button>
                          <button type="reset" class="btn btn-outline-secondary"><?php echo $lang["cancel"]; ?></button>
                        </div>
                      </form>
                    </div>
                    <?php
                    if (isset($_POST['reset'])) {
                      include "../includes/connect.php";
                    $query2=mysqli_query($con,"UPDATE accounts SET names='$_POST[names]',phone='$_POST[phone]',password='$_POST[password]' WHERE type='$_POST[type]'");
                    if ($query2) {
                      unset($_POST['reset']);
                      echo "<script>alert('".$lang["done"]."')</script>";
                      

                    }
                    else{
                    echo "<script>alert('SOMETHING WENT WRONG')</script>";
                    unset($_POST['reset']);
                    exit;

                    }
                  }

                    ?>
                    <!-- /Account -->
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
