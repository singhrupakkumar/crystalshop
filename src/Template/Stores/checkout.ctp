<?php
 if(isset($user->name)){
     $name = $user->name;
 }elseif(isset($shippingaddress['name'])){
     $name = $shippingaddress['name'];         
 }
 
  if(isset($user->email)){
     $email = $user->email;
 }elseif(isset($shippingaddress['email'])){
     $email = $shippingaddress['email'];         
 }
 
  if(isset($user->phone)){
     $phone = $user->phone;
 }elseif(isset($shippingaddress['phone'])){
     $phone = $shippingaddress['phone'];         
 }

  if(isset($user->address)){
     $address = $user->address;
 }elseif(isset($shippingaddress['address'])){
     $address = $shippingaddress['address'];         
 }
 
   if(isset($user->city)){
     $city = $user->city; 
 }elseif(isset($shippingaddress['city'])){
     $city = $shippingaddress['city'];         
 }
 
    if(isset($user->state)){
     $state = $user->state; 
 }elseif(isset($shippingaddress['state'])){
     $state = $shippingaddress['state'];         
 }
 
    if(isset($user->zip)){
     $zip = $user->zip; 
 }elseif(isset($shippingaddress['zip'])){
     $zip = $shippingaddress['zip'];         
 }
?>
<div class="chk_section"> 
	<div class="container">
    	<div class="row">
        	<div class="chk_hder">
            	<h3>Checkout</h3>
            	</div>
 <!-----accordian-start-------->               
      <div class="accordion-option">
    <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>
  </div>
  <div class="clearfix"></div>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <!-----tab1-------->
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion"  href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <span class="rund_1">1</span>Order Details
         <div class="chng_rgn">Change</div>
        </a>
      </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
        
        <div class="table_chot" id="added_items"> 
          
        </div>
        </div>
      </div>
    </div>
<!-----tab2-------->
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <span class="rund_1">2</span>Shipping Address
          <div class="chng_rgn">Change</div>
        </a>
      </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
         <div class="ship_frm">
            <form id="checkout-form" method="post"> 
                <div class="form-group nm_lese">
                  <label for="name">Name</label>  
                  <input type="text" class="form-control" id="name" value="<?php if(isset($name)){ echo $name; } ?>" placeholder="Name" name="name">
                </div>
                <div class="form-group nm_lese">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" value="<?php if(isset($email)){ echo $email; } ?>" placeholder="Email Address" name="email">
                </div>

                 <div class="form-group nm_lese less_mrgn">
                  <label for="phone">Phone Number</label>
                  <input type="number" class="form-control" id="phone" value="<?php if(isset($phone)){ echo $phone; } ?>" placeholder="Phone Number" name="phone">
                </div>

                 <div class="form-group">
                  <label for="address">Street or P.O. Box</label>
                  <input type="text" class="form-control" id="address" value="<?php if(isset($address)){ echo $address; } ?>" placeholder="Street" name="address">
                </div>

                 <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" value="<?php if(isset($city)){ echo $city; } ?>" placeholder="City" name="city">
                </div>

                 <div class="form-group stret_lese">
                  <label for="state">State</label> 
                  <input type="text" class="form-control" id="state" value="<?php if(isset($state)){ echo $state; } ?>" placeholder="State" name="state"> 
                </div>

                 <div class="form-group stret_lese less_mrgn">
                  <label for="zip">Zip Code</label>
                  <input type="number" class="form-control" id="zip" value="<?php if(isset($zip)){ echo $zip; } ?>" placeholder="Zip Code" name="zip">
                </div> 
                <p class="mymessage"></p>       
                <button type="button" id="saveaddress" class="btn btn-success scss_cntn">Save</button> 
            </form>

         	</div>     
        </div>
      </div>
    </div>
<!-----tab3-------->
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingThree">
        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
         <span class="rund_1">3</span>Review Your Order
        </a>
      </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body">
        	<div class="ordr_rvew">
            	<div class="lft_itm">
            	<h3>Items(2)</h3>
                	</div>
                   <div class="rght_dte">
                   	<h3>12/12/2017</h3>
                   	</div>
            	</div> 
                
                <div class="ordr_rvew">
            	<div class="lft_itm">
                	<div class="cart_chknt">
                  <img src="images/cart_stn1.png">
                  </div>
                  <h4 class="spn_hdng">Lorem Ipsum is a dummy text</h4>
                  <p class="para_chktxt">Lorem ipsum is a dummy text and easily understand</p>
                	</div>
                   <div class="rght_dte">
                   	<h3>$40</h3>
                   	</div>
            	</div>
                
                <div class="ordr_rvew">
            	<div class="lft_itm">
                	<div class="cart_chknt">
                  <img src="images/cart_stn1.png">
                  </div>
                  <h4 class="spn_hdng">Lorem Ipsum is a dummy text</h4>
                  <p class="para_chktxt">Lorem ipsum is a dummy text and easily understand</p>
                	</div>
                   <div class="rght_dte">
                   	<h3>$40</h3>
                   	</div>
            	</div> 
                
               <div class="ordr_rvew">
            	<div class="lft_itm">
                  <h4 class="spn_hdng">Order Subtotal</h4>
                	</div>
                   <div class="rght_dte">
                   	<h3>$40</h3>
                   	</div>
            	</div>
                
                <div class="ordr_rvew">
            	<div class="lft_itm">
                  <h4 class="spn_hdng">Shipping</h4>
                	</div>
                   <div class="rght_dte">
                   	<h3>$40</h3>
                   	</div>
            	</div>
                
                <div class="ordr_rvew">
            	<div class="lft_itm">
                  <h4 class="spn_hdng">Sales Tax</h4>
                	</div>
                   <div class="rght_dte">
                   	<h3>$40</h3>
                   	</div>
            	</div>
                
                <div class="ordr_rvew">
            	<div class="lft_itm">
                  <h4 class="spn_hdng">Total</h4>
                	</div>
                   <div class="rght_dte">
                   	<h3>$40</h3>
                   	</div>
            	</div>
                
                
              <div class="shiping_detl">
              	<div class="adres_lft">
                	<h4>Shipping Address</h4>
                    
                    <address>
                      Written by <a href="mailto:webmaster@example.com">Jon Doe</a>.<br> 
                      Visit us at:<br>
                      Example.com<br>
                      Box 564, Disneyland<br>
                      USA
                      </address>
                	</div>
              	</div>  
              
                
        </div>
      </div>
    </div>
 
  </div>
 <!-----accordian-end-------->   
 <a href="#" class="blu_drk">
         <span class="rund_1">4</span>Pay Now With Paypal

        </a>
        	</div>
    	</div>
	</div>  
<script>
$().ready(function() {
	var valid = $("#checkout-form").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				digits: true
			},
			state: {
				required: true
			},
			address: "required",
			city: {
				required: true
			},
			state: "required", 
			zip: {
				required: true,
				number: true
			}
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			phone: "Please enter valid phone number",
			city: "Please enter your city",
			state: "Please enter state",
			zip: "Please enter zipcode" 
		}
	});
        

   jQuery("#saveaddress").click(function(event) {
       
       if(valid.form()){
          jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>stores/checkout',  
                    data: jQuery('#checkout-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {  
                        if (msg.status === true) 
                        {
                            jQuery(".mymessage").html(msg.msg); 
                        }
                        else
                        { 
                            event.preventDefault();
                            jQuery(".mymessage").html(msg.msg);
                        } 
                    }
                });
        }else{
          event.preventDefault();    
        }         
  event.preventDefault();    
});
   
        
});
</script>
 <script> 
	$(document).ready(function() {
            


  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }
     
});
	</script>