<!--------banner section------->
  <div class="sgn_bner">
      
  <img src="<?php echo $this->request->webroot; ?>images/website/sgn_bner.jpg">
    	<div class="uper_sgnlyer">
        <h4>Sign In</h4>
        	</div>
  </div> 
 <?= $this->Flash->render() ?>   
<!--------sign_up_section------->
<div class="frm_sgnup">
	<div class="container">
    	<div class="row">
        	 <div class="sgnup_heading">
   <h4>Sign In to Earth Vendors</h4>  
   	</div> 
    <div class="frm_sgncvr">
    <span class="req_fld">Enter Details To Sign In</span>
     <?= $this->Form->create('Users', ['id' => 'login-form']) ?> 
    <div class="input-group zip_full">
      <span class="input-group-addon brdr_trns"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
      <input id="email" type="email" class="form-control ctrl_smn" name="username" placeholder="Email Address" required="required">
    </div>
    
     <div class="input-group zip_full">
      <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span></span>
      <input id="password" type="password" class="form-control ctrl_smn" name="password" placeholder="Password" required="required">
    </div>
    <p class="mymessage"></p>
    <div class="g-recaptcha cpta_tnm" data-sitekey="6Lef5j0UAAAAADt47q0_rrHhl3BfaFQBtP2O6UBM"></div> 
    <?= $this->Form->button(__('Sign In'),['class'=>'btn btn-success cntr_grn','type'=>'button','id'=>'loginbutton']); ?> 
    <?= $this->Form->end() ?> 
  

    <span class="frgt_psrd"><a href="<?php echo $this->request->webroot; ?>users/forgot">Forgot Password?</a></span> 
     <h3 class="dont_accnt">Don't have an account?<span class="sign_log"><a href="<?php echo $this->request->webroot; ?>users/add">Sign Up</a></span></h3>
    	</div>
        	</div>
    	</div>
</div>

<script>
   jQuery("#loginbutton").click(function(event) {
            
          jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/capchaverify', 
                    data: jQuery('#login-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {    
                        if (msg.status === true) 
                        {
                            jQuery(".mymessage").html(msg.msg); 
                            jQuery("#login-form").submit();  
                        }
                        else
                        { 
                              event.preventDefault();
                            jQuery(".mymessage").html(msg.msg);
                        }
                    }
                });
  event.preventDefault();    
});
</script>    



<!-----------footer-section-------------->