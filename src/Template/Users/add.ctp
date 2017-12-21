<?php
/**
* @var \App\View\AppView $this
*/
?>
 <!--------banner section------->
  <div class="sgn_bner">
  <img src="<?php echo $this->request->webroot; ?>images/website/sgn_bner.jpg">
    	<div class="uper_sgnlyer">
        <h4>seller sign up for free</h4>
        	</div>
  	</div>

<!--------sign_up_section------->
<div class="frm_sgnup">
	<div class="container">
    	<div class="row">
        	 <div class="sgnup_heading">
   <h4>Sign Up to Earth Vendors</h4>
   	</div> 
    <div class="frm_sgncvr">
    <span class="req_fld">All Fields Are Required</span>
 
     <?= $this->Form->create($user, ['type' => 'file','id' => 'user-form']) ?>
    <div class="input-group zip_full">
      <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-user"></i></span>  
          	<?php echo $this->Form->control('name', [
                    'label' => false,
                    'class' => 'form-control ctrl_smn',
                    'placeholder' => 'Full Name'
                ]); ?>
      
    
    </div>
    
     <div class="input-group zip_full <?= ($this->Form->isFieldError('email'))? 'has-error': '' ; ?>">
         <span class="input-group-addon brdr_trns"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
          <input name="email" class="form-control ctrl_smn" placeholder="Email Address" type="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">
           
          <?php echo $this->Form->error('email', null, array('class' => 'label label-block label-danger text-left', 'wrap' => 'label')); ?>
    </div>
 
    <div class="input-group zip_full">
      <span class="input-group-addon brdr_trns"><i class="fa fa-mobile fnt_inc" aria-hidden="true"></i></span>
       <?php echo $this->Form->control('phone', [
        'label' => false,
        'class' => 'form-control ctrl_smn',
        'placeholder' => 'Phone Number'
    ]); ?>
    </div>
    
     <div class="input-group zip_full">
      <span class="input-group-addon brdr_trns"><i class="fa fa-map-marker fnt_inc1" aria-hidden="true"></i></span>
       <?php echo $this->Form->control('address', [
        'label' => false,
        'class' => 'form-control ctrl_smn',
        'placeholder' => 'Street or P.O.Box'
    ]); ?>
      
    </div>
    
     <div class="input-group grp_adjst">
         <?php echo $this->Form->control('city', [
        'label' => false,
        'class' => 'form-control ctrl_smn',
        'placeholder' => 'City'
    ]); ?>   
    
    </div>
    
     <div class="input-group grp_adjst1">
         
     <?php echo $this->Form->control('state', [
        'label' => false,
        'class' => 'form-control ctrl_smn',
        'placeholder' => 'State'
    ]); ?>   
     
    </div>
    
     <div class="input-group zip_full1">
         
     <?php echo $this->Form->control('zip', [
        'label' => false,
        'class' => 'form-control ctrl_smn',
        'placeholder' => 'Zip Code'
    ]); ?>     
    
    </div>

      <div class="input-group zip_full <?= ($this->Form->isFieldError('password1'))? 'has-error': '' ; ?>">
          <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password1" class="form-control ctrl_smn" placeholder="Password" id="password1" type="password">
               <?php echo $this->Form->error('password1', null, array('class' => 'label label-block label-danger text-left', 'wrap' => 'label')); ?>
      </div>
   
    <div class="input-group zip_full <?= ($this->Form->isFieldError('password'))? 'has-error': '' ; ?>">
       <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span> 
    <input name="password" class="form-control ctrl_smn" placeholder="Confirm Password" id="password2" type="password">
   
    <?php echo $this->Form->error('password', null, array('class' => 'label label-block label-danger text-left', 'wrap' => 'label')); ?>
    </div>
     <p class="mymessage" style="color:red;text-align: center;"></p>
    <div class="g-recaptcha cpta_tnm" data-sitekey="6Lef5j0UAAAAADt47q0_rrHhl3BfaFQBtP2O6UBM"></div>  
   <?= $this->Form->button(__('Sign Up'),['class'=>'btn btn-success cntr_grn','id'=>'signupbutton','type'=>'button']); ?>  
   <?= $this->Form->end() ?>
  
     <h3 class="dont_accnt">Already have an account? <span class="sign_log"><a href="<?php echo $this->request->webroot; ?>users/login">Sign In</a></span></h3>
    	</div>
        	</div>
    	</div>
</div>

<!-----------footer-section-------------->

<script>
$().ready(function() {
	$("#user-form").validate({
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
			password1: { 
				required: true,
				minlength: 6
			},
			password: {
				equalTo: "#password1"
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
			password1: "Password is required",
			password: {
				equalTo: "Password and confirm password should be same"
			},
			city: "Please enter your city",
			state: "Please enter state",
			zip: "Please enter zipcode"
		}
	});
        

   jQuery("#signupbutton").click(function(event) {
            
          jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/capchaverify', 
                    data: jQuery('#user-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {    
                        if (msg.status === true) 
                        {
                            jQuery(".mymessage").html(msg.msg); 
                            jQuery("#user-form").submit();  
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
   
        
});
</script>
