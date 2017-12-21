<!--------banner section-------> 
<div class="sgn_bner"> 
    <img src="<?php echo $this->request->webroot; ?>images/website/cart_bner.jpg">
    <div class="uper_sgnlyer">  
        <h4>Cart</h4> 
    </div>
</div>
<?= $this->Flash->render() ?>  
<!-----------cart_table--------------->
<?php // if(empty($shop['OrderItem'])) : ?>

<!--h3 style="text-align: center;">Shopping Cart is empty</h3-->
  
<?php // else: ?>
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="tble_heding">
                <h3>Cart</h3>
            </div>
            <div id="added_items"></div>    
        </div>
    </div>
</div>
<?php // endif; ?>
<!-----------footer-section-------------->  
