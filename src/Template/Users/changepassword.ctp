<div class="sgn_bner">
    <img src="<?php echo $this->request->webroot; ?>images/website/sgn_bner.jpg">
    <div class="uper_sgnlyer">
        <h4>Change Password</h4> 
    </div>
</div>
<!--------sign_up_section------->
<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="sgnup_heading">
                <h4>Change Password</h4>
            </div> 
            <div class="frm_sgncvr">
                <div class="chnge_spcr"></div>
                <?= $this->Form->create('', ['type' => 'file', 'id' => 'change-from']) ?>
                    <div class="input-group">
                        <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span>
                         <input type="password" placeholder="Enter Your Old Password" name="opassword" class="form-control ctrl_smn" id="opassword">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span> 
                        <input type="password" class="form-control ctrl_smn" placeholder="Enter Your New Password" name="password1" id="password1">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control ctrl_smn" placeholder="Confirm Password" name="password">
                    </div>

                <?= $this->Form->button(__('Change Password'),['class'=>'btn btn-success cntr_grn']); ?>
                 <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
 $(document).ready(function() {
         $("#change-from").validate({
                 rules: { 
                         opassword: "required",
                         password1: {
				required: true,
				minlength: 6
			},
                         password: {
                                 equalTo: "#password1"
                         }
                 },
                 messages: {
                         opassword: "Please enter your old password",
                         password1: "Password is required", 
                         password: {
                                 equalTo: "Password and confirm password should be same"
                         }		
                 }
         });
 });
 </script>
