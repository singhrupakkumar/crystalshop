<section class="content-header">
    <h1>
    <?= __('Order') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('View') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12"> 
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title">Order Id :- <?= h($order->id) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($order->name) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($order->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paypal Email') ?></th>
            <td><?= h($order['user']['paypal_email']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($order->phone) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($order->address) ?></td>
        </tr>
    
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($order->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($order->state) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Zip') ?></th>
            <td><?= h($order->zip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($order->country) ?></td>
        </tr>
   
         <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td>$<?= h($order->total) ?></td>    
        </tr>
        
        <tr>
            <th scope="row"><?= __('Pay to Seller') ?></th>
            <td>$<?= h($order->total - $order->commission_amount) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Admin Comission') ?></th>
            <td>$<?= h($order->commission_amount) ?></td>    
        </tr>
        
         <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?php if($order->order_status == 1){ echo "Pending"; }elseif($order->order_status == 2){ echo "Processing";  }elseif($order->order_status == 3){ echo "Complete";  }elseif($order->order_status == 4){ echo "Cancel";  } ?></td>    
        </tr> 
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
            
            
      
        <div class="col-xs-12"> 

        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= __('Order Items') ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <?php  
    if (!empty($order->order_items)): ?>   
    <table class="table table-condensed">
        <thead>
             <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Seller Name') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Item Price') ?></th>
                <th scope="col"><?= __('Admin Comission') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Item Total') ?></th>
            </tr> 
        </thead>    
      <tbody>  
             <?php foreach ($order->order_items as $item): ?>
            <tr>
                <td><?= h($item->name) ?></td>
                <td><?= h($item->user->name) ?></td> 
                <td>
                <?php if($item->product->image != ''){ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $item->product->image; ?>" style="width: 190px; margin-bottom: 20px;
                " class="previewHolder"/>
                <?php }else{ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" style="width: 190px; margin-bottom: 20px;
                " class="previewHolder"/>
                <?php } ?>
                </td>
                <td><?= h($item->price) ?></td>
                <td><?= h($item->commission_amount); if($item->commission_amount == 0){ echo '<p style="color:red"> Bonus Product</p>'; } ?> </td>  
                <td><?= h($item->quantity) ?></td> 
                <td>$<?= h($item->subtotal) ?></td>    
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
</section>       