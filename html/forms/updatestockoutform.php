
<div class="card">
          <div class="card-body">
                      <!-- Logo -->
              <div class="app-brand justify-content-center pb-3">
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
              <!-- the form will send data to stockoutdata.php -->
                      <form id="formAccountSettings" method="POST" action="stockoutdata.php">
                        <!-- hidden stock out id -->
                        <input type="hidden" name="st_out_id" value="<?php echo $row['stock_out_id']; ?>">

                        
                        <div class="row d-flex flex-wrap">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label"><?php echo $lang["product"]; ?></label>
                            <select class="form-select"  name="pname" required>
                              <option value="<?php echo $row['p_id']; ?>"><?php echo $row['product_name']; ?></option>
                              <?php
                              include "../includes/connect.php";
                              $prod=mysqli_query($con,"SELECT * FROM products ORDER BY product_name asc");
                                while ($pros=mysqli_fetch_array($prod)) {
                                  if ($row['p_id']==$pros['p_id']) {
                                    continue;
                                  }else{
                                  ?>
                                 <option value="<?php echo $pros['p_id']; ?>"><?php echo $pros['product_name']; ?></option>
                                  <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label"><?php echo $lang["quality"]; ?></label>
                            <select class="form-select" name="quality" required>
                              <option value="<?php echo $row['quality']; ?>"><?php echo $lang["quality"]; ?> <?php echo $row['quality']; ?></option>
                              <?php 
                              for ($j=1; $j < 4; $j++) { 
                                if ($j==$row['quality']) {
                                  continue;
                                }else{
                                echo ' <option value="'.$j.'">QUALITY '.$j.'</option>';
                                }
                              }
                              ?>
                             
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label"><?php echo $lang["manufacturer"]; ?></label>
                            <select class="form-select text-capitalize" name="manufacture" required>
                              <option value="<?php echo $row['manufacturer']; ?>"><?php echo $row['manufacturer']; ?></option>
                              <?php
                                include "../includes/connect.php";
                                $prod=mysqli_query($con,"SELECT DISTINCT manufacturer FROM products ORDER BY manufacturer asc");
                                
                                  while ($qual=mysqli_fetch_array($prod)) {
                                    if ($qual['manufacturer']==$row['manufacturer']) {
                                      continue;
                                    }else{
                                    ?>
                                    <option value="<?php echo $qual['manufacturer']; ?>"><?php echo $qual['manufacturer']; ?></option>
                                <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label"><?php echo $lang["availablequantityinstock"]; ?></label>
                            <input type="float" class="form-control <?php if ($remaining_quantity==0) {echo "text-danger";} ?>" id="organization" name="remaining" readonly value="<?php echo $remaining_quantity; ?>"/>
                          </div>
                          <!-- php codes to hide fields when quantity is found to be zero-->
                          <?php 

                          if ($remaining_quantity>0) {
                            ?>
                            <!-- this div will be hiden when the quantity is zero -->
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber"><?php echo $lang["prive"]; ?></label>
                            <div class="input-group input-group-merge">
                              <input type="float" id="sellprice" name="unit_price" class="form-control" value="<?php echo $row['sell_price']; ?>" readonly />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label" ><?php echo $lang["stoutquantity"]; ?></label>
                            <input type="number" class="form-control" placeholder="Quantity for the client" id="quantity_out" value="<?php echo $row['quantity_out']; ?>" required name="quant_out" max="<?php echo $remaining_quantity; ?>" min="1" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="amount" class="form-label"><?php echo $lang["amounttopay"]; ?></label>
                            <input type="float"class="form-control text-info" id="payingAmount" readonly name="pay_amount"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label"><?php echo $lang["payment"]; ?></label>
                            <select name="payment" class="form-select" id="payment_meth" required>
                            <option value="<?php echo $row['payment']; ?>"><?php echo $row['payment']; ?></option>
                              <?php 
                              $pay = array("cash","debt");
                              for ($k=0; $k < 2; $k++) { 
                                if ($pay[$k]==$row["payment"]) {
                                  continue;
                                }else{
                                  echo '<option value="'.$pay[$k].'">'.$pay[$k].'</option>';
                                }
                              }
                              ?>
                              <!-- here i will use array display payment method without repetition of it -->
                            
                          </select>
                          </div>
                            <div class="row" id="select_client">
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label"><?php echo $lang["selectclient"]; ?></label>
                            <select name="client_debt" class="form-select" id="client">
                                <option value="<?php $row['client_id']; ?>"><?php echo $row["client_names"].":".$row["client_phone"]; ?></option>
                              <?php
                                include "../includes/connect.php";
                                $client=mysqli_query($con,"SELECT * FROM clients ORDER BY client_names ASC");
                                while($client_data=mysqli_fetch_array($client)){
                                  if ($client_data['client_id']==$row['client_id']) {
                                    continue;
                                  }else{
                              ?>
                                <option value="<?php echo $client_data['client_id']; ?>"><?php echo $client_data['client_names'].":".$client_data['client_phone']; ?></option>
                                <?php
                                }
                              }
                                ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label" ><?php echo $lang["paymentdate"]; ?></label>
                            <input type="date" class="form-control" placeholder="Payment Date" id="paying_date" value="<?php echo $row['debt_payment_date']; ?>" name="paying_date" required/>
                          </div>
                            </div>
                            <?php
                          } 
                            ?>
                            
                          </div>
                          
                        <div class="mt-2">
                          <?php 

                          if ($remaining_quantity>0) {
                            ?>
                          <button type="submit" name="update_stockout_btn" class="btn btn-primary me-2"><?php echo $lang["save"]; ?></button>
                          <button type="reset" class="btn btn-outline-secondary"><?php echo $lang["cancel"]; ?></button>
                          <?php
                        }
                        else{
                          echo "<h5 class='text-danger text-center text-uppercase'>Action can't be completed<h5>";
                        }

                          ?>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>

                  <!-- hidding passed dates -->
                  <script>
        // Get the current date
        var currentDate = new Date().toISOString().split("T")[0];

        // Get the date input element
        var dateInput = document.getElementById("paying_date");

        // Set the minimum date attribute to the current date
        dateInput.min = currentDate;
    </script>

    <!-- auto update on inputs -->
<script type="text/javascript">
      window.onload = function() {
    
    
        // codes to auto update inputs
        var sellprice=document.getElementById('sellprice');
        var quantityOut=document.getElementById('quantity_out');
        var payAmount=document.getElementById('payingAmount');
        payAmount.value=sellprice.value * quantityOut.value;
        function updateResult() {
          const value1 = parseFloat(sellprice.value);
          const value2 = parseFloat(quantityOut.value);
          if (isNaN(value1) || isNaN(value2)) {
            payAmount.value = '';
          } else {
           const result = value1 * value2;
        if (Number.isInteger(result)) {
          payAmount.value = result.toFixed(0);
        } else {
          payAmount.value = result.toFixed(2);
        }
          }
        }
        
        sellprice.addEventListener('input', updateResult);
        quantityOut.addEventListener('input', updateResult);
     // -------------------------------------------------------------
                  // codes to display and hide the client div
    // --------------------------------------------------------------
      var payment = document.getElementById('payment_meth');
      var payType = document.getElementById('select_client');
      var client=document.getElementById('client');
      var payDate=document.getElementById('paying_date');
         if (payment.value == "cash") {
          payType.style.display = "none";
        }
      function dataDisplay() {
        if (payment.value == "cash") {
          payType.style.display = "none";
        } else {
          payType.style.display = "flex"; // or "initial" depending on your desired display value
        }
      }
    
      payment.addEventListener('change', dataDisplay);
      payType.addEventListener('change', dataDisplay);
    }

</script>
<!-- 
> Ndabura codes za javascript zikuraho clear kuri date palete

 -->
