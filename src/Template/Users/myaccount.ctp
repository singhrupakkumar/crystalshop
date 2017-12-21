<!--------banner section------->
  <div class="sgn_bner">
      
  <img src="<?php echo $this->request->webroot; ?>images/website/sgn_bner.jpg">
    	<div class="uper_sgnlyer">
        <h4>My Profile</h4>
        	</div>
  	</div>
<?= $this->Flash->render() ?> 
<!--------sign_up_section------->
<div class="frm_sgnup">
	<div class="container">
    	<div class="row">
        	 <div class="sgnup_heading">
   <h4>My Profile</h4>
   	</div> 
    <div class="frm_sgncvr">
    <div class="chnge_spcr"></div>
   
   <div class="my_cvr"> 
 <div class="col-sm-4">
 	<div class="prfle_pic">
        <?php if(isset($userdata->image)){  ?>    
    	<img src="<?php echo $this->request->webroot."images/users/".$userdata->image; ?>">
        <?php }else{  ?>
        <img src="<?php echo $this->request->webroot."images/users/noimage.png"?>">
        <?php } ?>
    	</div>
 	</div>
    
    <div class="col-sm-8">
    	<div class="prfle_text">
                <h3><?php if(isset($userdata->name)){ echo $userdata->name; } ?></h3>
            </div>
            <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-2" style="padding: 0;">
            	<div class="labl_prf">Email:</div>
                </div>
                <div class="col-sm-10" style="padding: 0;">
            	<div class="dtl_prf"><?php if(isset($userdata->email)){ echo $userdata->email; } ?></div>
                </div>
            	</div>
        	</div>
            
            <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-2" style="padding: 0;">
            	<div class="labl_prf">Phone:</div>
                </div>
                <div class="col-sm-10" style="padding: 0;">
            	<div class="dtl_prf"><?php if(isset($userdata->phone)){ echo $userdata->phone; } ?></div>
                </div>
            	</div>
        	</div>
            
            <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-2" style="padding: 0;">
            	<div class="labl_prf">Addres:</div>
                </div>
                <div class="col-sm-10" style="padding: 0;">
            	<div class="dtl_prf"><?php if(isset($userdata->address)){ echo $userdata->address; } ?></div>
                </div>
            	</div>
        	</div>
              <a href="<?php echo $this->request->webroot; ?>users/changepassword"><button type="button" class="btn btn-success lft_grn">Change Password</button></a>   
             <a href="<?php echo $this->request->webroot; ?>users/edit"><button type="button" class="btn btn-success lft_grn"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button></a> 
    	</div>
        	</div>
    	</div>
        	</div>
    	</div>
</div>