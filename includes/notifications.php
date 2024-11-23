<div class="col-md d-none d-lg-block" >
<div class="card">
  <h5 class="card-header"><?php echo $lang["notifications"]; ?></h5>
   <div class="card-body">

<?php

// --------------------
//  here we are going to find notifications
include "../includes/connect.php";
$notify=mysqli_query($con,"SELECT * FROM debt INNER JOIN stock_out INNER JOIN stock_in INNER JOIN clients ON debt.stock_out_id=stock_out.stock_out_id AND debt.client_id=clients.client_id AND stock_out.stock_in_id=stock_in.stock_in_id WHERE payment_status <> 'paid' ORDER BY debt_payment_date asc ");

if (mysqli_num_rows($notify)==0) {
  echo "No Notifications Today";
}

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
else{
continue;
}
if ($i==3) {
  break;
}

}
$_SESSION['notification']=$count;

?>
   </div>
  </div>
</div>
