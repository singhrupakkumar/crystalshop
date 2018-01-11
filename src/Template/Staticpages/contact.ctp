
  

<!-- ---------------------------------section---------------------------- -->
<div class="contactus">
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-sm-offset-3">
                <div class="cntctbox">
                     <div class="col-sm-12">  
                        <div class="sign-flash">
                         <?= $this->Flash->render() ?>   
                         </div>  
                     </div> 
                    <h4>Contact Us</h4>
                    <?php if(isset($contact['content'])) { echo $contact['content']; }?>  

                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="cntct-frm">  
                           <?= $this->Form->create(null, ['type' => 'file','id' => 'contact-form']) ?>  
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">NAME</label>
                                    <?php echo $this->Form->control('name', ['label' => false,'class' => 'form-control']); ?> 
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">YOUR EMAIL </label>
                                    <?php echo $this->Form->control('email', ['label' => false,'class' => 'form-control','type'=>'email']); ?> 
                         
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">SUBJECT</label>
                                   <?php echo $this->Form->control('subject', ['label' => false,'class' => 'form-control','type'=>'text']); ?> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">YOUR MESSAGE</label>
                                    <?php echo $this->Form->control('message', ['label' => false,'class' => 'form-control','type'=>'textarea','rows'=>3]); ?> 
                                   
                                </div>
                                 <p class="mymessage"></p>   
                                  <div class="g-recaptcha cpta_tnm" data-sitekey="6Lef5j0UAAAAADt47q0_rrHhl3BfaFQBtP2O6UBM"></div>   
                                <div class="cntct-btn">
                                     <?= $this->Form->button(__('Send'),['class'=>'btn cntctbtn','id'=>'send']); ?>
                                </div>
                            
                            <?= $this->Form->end() ?>
                        </div></div></div></div>
        </div>
    </div>  
</div>

<script>
$().ready(function() {
	var cform = $("#contact-form").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			name: {
				required: true
			},
			subject: {required: true},
			message: {
				required: true
			}
		
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			message: "message is required",
			subject: "Please enter your subject"
		}
	});
        

   jQuery("#send").click(function(event) {
          if(cform.form()){  
          jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/capchaverify', 
                    data: jQuery('#contact-form').serialize(),
                    type: 'POST',
                    dataType: "json",
                    success: function (msg) {    
                        if (msg.status === true) 
                        {
                            jQuery(".mymessage").html(msg.msg); 
                            jQuery("#contact-form").submit();  
                        }
                        else
                        { 
                              event.preventDefault();
                            jQuery(".mymessage").html(msg.msg);
                        } 
                    }
                });
                }                 
  event.preventDefault();    
});
   
jQuery("#message").keyup(function(event) {
    if (event.keyCode === 13) {
        jQuery("#send").click(); 
    }
});
 
 
});
</script>

