<?php
@session_start();

// Default language is the one selected in datadase
if (!isset($_SESSION['language'])) {
include "../includes/connect.php";
$check_lan=mysqli_query($con,"SELECT * FROM accounts WHERE type='$_SESSION[user]'");
$check_lan_fetch=mysqli_fetch_array($check_lan);
$language = $check_lan_fetch['language'];
    
}
// Check if language is set in session
if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
}

// Include the appropriate language translation file
if ($language === 'en') {
    include('../includes/en.php');
} else if ($language === 'rw') {
    include('../includes/rw.php');
}
?>
<?php
include "../includes/links.php";
if (isset($_POST['stockout_btn']) && $_POST['payment']=="cash") {
  include "../includes/connect.php";
  $DATE=date("Y-m-d");
  // inserting stockout data
  $ins_st_out=mysqli_query($con,"INSERT INTO stock_out VALUES('','$_POST[st_in_id]','$_POST[quant_out]','$DATE','cash')");
  if ($ins_st_out) {
    ?>

<!-- card -->
<body class="d-flex align-items-center justify-content-center">
                  <div class="card mb-2 d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                      <div class="col">
                        <div class="card-body row d-flex align-items-center justify-content-center">
                          <h5 class="card-title text-primary d-flex align-items-center justify-content-center"><?php echo $lang["done"]; ?> &#10003;</h5>
                          <a href="newstockout.php" class="btn btn-lg btn-outline-primary">OK</a>
                        </div>
                      </div>
                    </div>
                  </div>
</body>
<!-- /card -->

    <?php
  }
}
// ---------------------------------------------------
//              codes to insert in dept table
// ---------------------------------------------------
else {
  // if (isset($_POST['stockout_btn']) && $_POST['payment']=="dept")
   include "../includes/connect.php";
   // inserting stockout data
  $DATE=date("Y-m-d");
  $ins_st_out=mysqli_query($con,"INSERT INTO stock_out VALUES('','$_POST[st_in_id]','$_POST[quant_out]','$DATE','debt')");
  // recording debt after recording the transaction
  if ($ins_st_out) {

    // getting stockout id after recording it
  $ins_st_out_sel=mysqli_query($con,"SELECT * FROM stock_out ORDER BY stock_out_id desc LIMIT 1");
  $ins_st_out_sel_fetch=mysqli_fetch_array($ins_st_out_sel);
  
    // now i got stockout id and it is stored in this variable
    $st_out_id=$ins_st_out_sel_fetch["stock_out_id"];

    // getting the client 
    $idcl=$_POST['client_debt'];

    // getting dept payment date
    $deptPD=$_POST['paying_date'];

    // now i'm going to record the dept in dept table now

    $dept=mysqli_query($con,"INSERT INTO debt VALUES('','$idcl','$st_out_id','$deptPD','not paid')");

    if ($dept) {
      ?>
  
<!-- card -->
<body class="d-flex align-items-center justify-content-center">
                  <div class="card mb-2 d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                      <div class="col">
                        <div class="card-body row d-flex align-items-center justify-content-center">
                          <h5 class="card-title text-primary d-flex align-items-center justify-content-center"><?php echo $lang["done"]; ?> &#10003;</h5>
                          <a href="newstockout.php" class="btn btn-lg btn-outline-primary">OK</a>
                        </div>
                      </div>
                    </div>
                  </div>
</body>
<!-- /card -->
      <?php
    }
    else{
      echo "error";
    }
  }
  else{
      echo "error";
    }
}
include "../includes/jslinks.php";
?>

<!-- ----------------- CODES TO UPDATE STOCK OUT ------------------- -->

<?php

// button click
if (isset($_POST['update_stockout_btn']) && $_POST['payment']=="debt") {
  include "../includes/connect.php";
  
// getting all data
  



}


?>