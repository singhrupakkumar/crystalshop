<div class="smart_container">
    <!--------------------Your Order_sec----------------------->
    <div class="ur_ordr_sec">

        <div class="ur_order">
            <h1>Order Details</h1>                    
        </div>         
    </div>
    <!---------------------Have A Questions------------------------->
  
    <div class="urorder">
        <div class="container">    

            <div class="row">

                <div class="col-sm-6">
                    <div class="order_tbl">
                        <div class="order_tblsec2 table-responsive">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td data-label="Name"><?= h($order->name) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td data-label="Email"><?= h($order->email) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td data-label="Phone"><?= h($order->phone) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td data-label="Address"><?= h($order->address) ?></td>
        </tr>
    
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td data-label="City"><?= h($order->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td data-label="State"><?= h($order->state) ?></td>
        </tr>
        
       

      </tbody>
    </table>
	
	
 
                        </div>
						
						
                    </div> 
                </div>  
				
				<div class="col-sm-6">
							                    <div class="order_tbl">
                        <div class="order_tblsec2 table-responsive">
    <table class="table table-condensed">
	<tbody>
	 <tr>
            <th scope="row"><?= __('Zip') ?></th>
            <td data-label="Zip"><?= h($order->zip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td data-label="Country"><?= h($order->country) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Subtotal') ?></th>
            <td data-label="Subtotal">$<?= h($order->subtotal) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td data-label="Total">$<?= h($order->total) ?></td>    
        </tr>
         <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td data-label="Status"><?php if($order->order_status == 1){ echo "Pending"; }elseif($order->order_status == 2){ echo "Processing";  }elseif($order->order_status == 3){ echo "Complete";  }elseif($order->order_status == 4){ echo "Cancel";  } ?></td>    
        </tr>  
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td data-label="Created"><?= h($order->created) ?></td>
        </tr>
		 </tbody>
	</table>
						
						</div>  
						 </div>   
						  </div>    
            </div>      


        </div>
    </div>
</div>
            
      
        <div class="col-xs-12"> 

        <div class="container"> 
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= __('Order Items') ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body tbl-ordr no-padding">
    <?php  
    if (!empty($order->order_items)): ?>   
    <table class="table table-condensed">
        <thead>
             <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Seller Name') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Subtotal') ?></th>
            </tr> 
        </thead>    
      <tbody>  
             <?php foreach ($order->order_items as $item): ?>
            <tr>
                <td data-label="name"><?= h($item->name) ?></td>
                <td data-label="Seller Name"><?= h($item->user->name) ?></td> 
                <td data-label="Image">
                <?php if($item->product->image != ''){ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $item->product->image; ?>" style="width:100px; height="100px"  class="previewHolder"/>
                <?php }else{ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" style="width:100px; height="100px"  class="previewHolder"/>
                <?php } ?>
                </td>
                <td data-label="price"><?= h($item->price) ?></td> 
                <td data-label="quantity"><?= h($item->quantity) ?></td> 
                <td data-label="subtotal">$<?= h($item->subtotal) ?></td>    
            </tr>
            <?php endforeach; ?>  
      </tbody>
    </table>
    <?php endif; ?>   
  </div>
  <!-- /.box-body -->
</div>
</div>

        
        
        
        </div>     
            
            
            
            
            
  