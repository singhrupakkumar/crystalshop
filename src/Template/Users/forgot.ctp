<div class="sgn_bner">
    <img src="<?php echo $this->request->webroot; ?>images/website/sgn_bner.jpg">
    <div class="uper_sgnlyer">
        <h4>Forgot Password</h4>
    </div>
</div>
<!--------sign_up_section------->
<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="sgnup_heading">
                <h4>Forgot Password</h4>
            </div> 
            <div class="frm_sgncvr">
                <span class="req_fld">Enter Email Address to Reset Password</span>
                 <?= $this->Form->create('', ['type' => 'file']) ?>
                    <div class="input-group zip_full">
                        <span class="input-group-addon brdr_trns"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <input id="email" type="email" class="form-control ctrl_smn" name="email" placeholder="Email Address" required="required">
                    </div>

                 <?= $this->Form->button(__('Send'),['class'=>'btn btn-success cntr_grn']); ?>
                 <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</div>
  