  
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
                <h4>Edit Profile</h4>
            </div> 
            <div class="brdr_edt">
                
                <div class="col-sm-8 col-sm-offset-4">
                    <div class="prfle_pic">
                        <?php if($user['image']){ ?>
                        <img class="currentimg" src="<?php echo $this->request->webroot."images/users/".$user['image']; ?>">
                        <?php }else{ ?>
                        <img class="currentimg" src="<?php echo $this->request->webroot."images/users/noimage.png"; ?>">
                        <?php } ?>
                       
                    </div>
                </div>
                <div class="col-sm-12">
                   
                    <div class="frm_sgncvr1">
                         <?= $this->Form->create($user, ['id' => 'edit-form', 'enctype' => 'multipart/form-data']) ?>
                            <?php echo $this->Form->control('image', ['class' => 'form-control ctrl_smn smm_alg','type'=>'file','id'=>'img' ,'label' => false]); ?>
                            <div class="input-group gp_slct">
                                <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-user"></i></span>
                                <?php echo $this->Form->control('name', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'Full Name']); ?>
                            </div> 
                        
                             <div class="input-group">
                                <span class="input-group-addon brdr_trns"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <?php echo $this->Form->control('email', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Email Address','readonly']); ?>
                            </div>
                        
                             <div class="input-group">
                                <span class="input-group-addon brdr_trns"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <?php echo $this->Form->control('paypal_email', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Paypal Email Address']); ?> 
                            </div>

                           <div class="input-group">
                               <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-user"></i></span>
                       <!--   <label for="exampleInputGender">Gender</label>-->
                                <select name="gender" class="form-control">
                                  <option value="male" <?php if($user->gender=='male'){ echo "selected"; }?>>Male</option>
                                  <option value="female" <?php if($user->gender=='female'){ echo "selected"; }?>>Female</option>

                                </select>
                           </div>
                        
                            <div class="input-group">
                              <span class="input-group-addon brdr_trns"><i class="fa fa-mobile fnt_inc" aria-hidden="true"></i></span>  
                              <?php echo $this->Form->control('phone', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Phone Number','maxlength'=>12]); ?>
                           </div>
                           <div class="input-group ">
                           <span class="input-group-addon brdr_trns"><i class="fa fa-calendar fnt_clng" aria-hidden="true"></i></span>  
                              <?php echo $this->Form->control('dob', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'Date Of Birth']); ?>
                           </div>
                           <div class="input-group">
                            <span class="input-group-addon brdr_trns"><i class="fa fa-map-marker fnt_inc1" aria-hidden="true"></i></span>   
                              <?php echo $this->Form->control('address', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Address']); ?>
                           </div> 
                            
                           <div class="input-group grp_adjst">
                            <span class="input-group-addon brdr_trns lgh_snt"><i class="fa fa-globe" aria-hidden="true"></i></span> 
                              <?php echo $this->Form->control('state', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'State']); ?>
                           </div> 
                           <div class="input-group grp_adjst">
                             <span class="input-group-addon brdr_trns"><i class="fa fa-barcode" aria-hidden="true"></i></span> 
                              <?php echo $this->Form->control('zip', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'Zip']); ?>
                           </div>
                           <div class="input-group cntr_ctl">
                              <!--<label for="exampleInputPassword1">Country</label> -->
                              <span class="input-group-addon brdr_trns"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                <select class="form-control form-select ajax-processed sel-country" id="edit-node-type" name="country" readonly="readonly">
                               <option value="-1" selected="selected">Select Country</option>
                               <?php if(!empty($countries)){ ?>
                               <?php foreach($countries as $country){ ?>
                               <?php if($user['country'] == $country['name']){ ?>
                               <option value="<?php echo $country['name']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                               <?php }else{ ?>
                               <option value="<?php echo $country['name']; ?>"><?php echo $country['name']; ?></option>
                               <?php } ?>
                               <?php } ?>
                               <?php } ?>
                               </select>
                           </div> 

                        <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-success cntr_grn']) ?>
                           <?= $this->Form->end() ?>
                       
                    </div>
                   
                </div>
               
            </div>
        </div>
    </div>
</div>

<script>
     function contactFormat(number){   
  if(number.length == 3){
      number = number+'-'
  } else if (number.length == 7){
      number = number+'-';
  }
  return number;
}  
   
$("#phone").keyup(function(){ 
var num = contactFormat($(this).val()); 
 $(this).val(num)  ; 
});  
   $(document).ready(function() {
	$("#edit-form").validate({  
		ignore: "",
		rules: {
			email: {
				required: true,
				email: true
			},
                        paypal_email: { 
				required: true,
				email: true
			},
			name: {required:true},
			dob: {required:true},
                        phone: { 
                            required:true, 
                            number:true,
                        },
                        zip: {
                            required:true,
                            number:true,
                        },
			country: {
				required: true
			},
			gender: "required",
			state: "required"
			
		},
		messages: {
                          name: {     
                                  required: "Please enter your Full Name", 
                                },      
			dob: "Please select date of Birth",
			country: "Please select country",
			gender: "Please select gender",
                        email: "Please enter a valid email address",
			state: "Please enter state",
			zip: "Please enter zipcode"
		}
	});
}); 

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.currentimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#img").change(function(){
    readURL(this);
});
</script>    