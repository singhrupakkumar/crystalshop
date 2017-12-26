<?php
echo $this->set('title_for_layout', 'Order Success'); ?>
  <div class="container">
    <div class="col-sm-12">
      <div class="fancy">
        <h2>Order Success</h2>
      </div>
    </div>
    
    
    
    
    
    <div class="col-sm-12">
      <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
      <div class="order-confrm">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="track-order">
  <tr>
    <td colspan="2"><h1>Order Confirmated!</h1></td>   
  </tr>
  <tr>
    <td class="text-center whitebg_color" colspan="2"><img src="<?php echo $this->webroot;?>home/images/confrm-order.png" alt="" ></td>  
    
  </tr>
  <tr>
  	<td  colspan="2" class="text-center whitebg_color"> <span class="blue_color">Thank You for Your order!</span></td>
  </tr>
  <tr>
    <td colspan="2" class="text-left whitebg_color">Summary</td>
    
  </tr>
  <tr>
    <td class="ordr_none"><?php echo $shop['Order']['first_name'];?></td>
    <td class="text-right" data-label="1xkoa Bracelet"><?php echo $shop['Order']['email'];?></td>
  </tr>
  <tr>
    <td class="drkgreybg ordr_none">Order Quantity</td>
    <td class="drkgreybg text-right"  data-label="Quantity"><?php echo $shop['Order']['quantity'];?></td>
  </tr>
  <tr>
    <td class="drkgreybg ordr_none">Sub Total</td>
    <td class="drkgreybg text-right" data-label="Sub Total">$<?php echo $shop['Order']['subtotal'];?></td> 
  </tr>
  <tr>
    <td class="drkgreybg ordr_none">Total</td>
    <td class="drkgreybg text-right" data-label="Total">$<?php echo $shop['Order']['total'] ;?></td>
  </tr>
</table>


        </div>
        </div>

      
        
        
      </div>
    </div>
    
    
  </div>