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
                    <div class="col-sm-12">
             <div class="sign-flash">
              <?= $this->Flash->render() ?>   
              </div>
              </div>  
                <h4>Forgot Password</h4>
            </div> 
            <div class="frm_sgncvr">
                <span class="req_fld">Enter Email Address to Reset Password</span>
                 <?= $this->Form->create('', ['type' => 'file','id' => 'forgot-form']) ?>
                    <div class="input-group zip_full">
                        <span class="input-group-addon brdr_trns"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <input id="email" type="email" class="form-control ctrl_smn" name="email" placeholder="Email Address" required="required">
                    </div>
                    <p class="mymessage"></p>     
                    <div class="g-recaptcha cpta_tnm" data-sitekey="6Lef5j0UAAAAADt47q0_rrHhl3BfaFQBtP2O6UBM"></div>
                 <?= $this->Form->button(__('Send'),['class'=>'btn btn-success cntr_grn','id'=>'forgotbutton','type'=>'button']); ?>
                 <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</div>

<script>
   jQuery("#forgotbutton").click(function(event) { 
            
          jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/capchaverify', 
                    data: jQuery('#forgot-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {    
                        if (msg.status === true) 
                        {
                            jQuery(".mymessage").html(msg.msg); 
                            jQuery("#forgot-form").submit();  
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
  