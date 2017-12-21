<div class="sgn_bner">
    <img src="<?php echo $this->request->webroot; ?>images/website/sgn_bner.jpg">
    <div class="uper_sgnlyer">
        <h4>Reset Password</h4>
    </div>
</div>
<!--------sign_up_section------->
<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="sgnup_heading">
                <h4>Reset Password</h4>
            </div> 
            <div class="frm_sgncvr">
                <span class="req_fld">Reset your password</span>
                  <?= $this->Form->create('', ['type' => 'file', 'class' => 'form-horizontal','id' => 'reset-form']) ?>
                    <div class="input-group zip_full">
                        <span class="input-group-addon brdr_trns"><i class="fa fa-password" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password" required="required">
                    </div>
                    <div class="input-group zip_full">
                        <span class="input-group-addon brdr_trns"><i class="fa fa-password" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Confirm Password" required="required">
                    </div>
                

                 <?= $this->Form->button(__('Save'),['class'=>'btn btn-success cntr_grn']); ?>
                 <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</div>

<script> 
$(document).ready(function() {
	$("#reset-form").validate({ 
		rules: {
			password1: {
				required: true,
				minlength: 6
			},

			password: {
				equalTo: "#password1"
			}
		},
		messages: {
			password1: {
				required: "Please Enter New password",
				minlength: "Please enter atleast 8 characters"
			},

			password: {
				equalTo: "Both Passwords do not match"
			}		
		}
	});
});
</script>