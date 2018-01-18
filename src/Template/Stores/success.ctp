<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="sgnup_heading">
                <h4>Order Confirmed</h4>  
            </div> 
            <div class="frm_sgncvr">
                <div class="img_cnfm">
                    <img src="<?php echo $this->request->webroot; ?>images/website/thku_pic.png">     
                </div>
                <span class="smry_stng">Summary</span>
                <?php if(!empty($cart['products'])){
                    
                    foreach($cart['products'] as $item){  
                    ?>
                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3><?php if(isset($item['quantity'])) { echo $item['quantity']; }?>*<?php if(isset($item['name'])) { echo $item['name']; }?></h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">
                            <h3>$<?php if(isset($item['price'])) { echo $item['price']; }?></h3>
                        </div>
                    </div>
                </div>
                    <?php } } ?>

                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3>Quantity</h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">
                            <h3><?php if(isset($cart['cartInfo']['quantity'])) { echo $cart['cartInfo']['quantity']; }?></h3>  
                        </div>
                    </div>
                </div>

                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3>Sub Total</h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">
                            <h3>$<?php if(isset($cart['cartInfo']['quantity'])) { echo $cart['cartInfo']['subtotal']; }?></h3>
                        </div>
                    </div>
                </div>

          

                <div class="ordr_quey">
                    <div class="col-sm-6">
                        <div class="lft_smmry">
                            <h3>Total</h3>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rght_smry">  
                            <h3>$<?php if(isset($cart['cartInfo']['total'])) { echo $cart['cartInfo']['total']; }?></h3>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>