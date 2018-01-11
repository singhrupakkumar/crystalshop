
<div class="smart_container">
<!--------------------Your Order_sec----------------------->
	<div class="ur_ordr_sec">
            
            <div class="ur_order">
                 <?php echo $this->Flash->render(); ?>   
            	<h1>Your Order</h1>              
            </div>
               

	</div>


<div class="urorder">
  <div class="container-fluid">    
   
   <div class="row">
   		
        <div class="col-sm-10 col-sm-offset-1">
        	<div class="order_tbl">
            <div class="order_tblsec table-responsive">

              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Order ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Seller') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Status') ?></th>
            </tr>
            </thead>
                <tbody>
                  <?php foreach ($yourorders as $info):
                      ?>  
                    
                    
            <tr>
                <td data-label="Order ID"><a href="<?php  echo $this->request->webroot; ?>orders/view/<?php echo $info['id']; ?>"><?= $this->Number->format($info->id) ?></a></td>
                <td data-label="Order name"><?= h($info->name) ?></td> 
                <td data-label="Order email"><?= h($info->email) ?></td>
                <td data-label="Order user name"><?= h($info->user->name) ?></td>
                <td data-label="Order phone"><?= h($info->phone) ?></td>
                <td data-label="Order subtotal"><?= h($info->subtotal) ?></td>
                <td data-label="Order total"><?= h($info->total) ?></td>
                 <td data-label="Order created"><?= h($info->created) ?></td>
                <td data-label="Order order_status"><?php if($info->order_status == 1){ echo "Processing"; }elseif($info->order_status == 2){ echo "Pending";  }elseif($info->order_status == 3){ echo "Complete";  }elseif($info->order_status == 4){ echo "Cancel";  } ?></td> 
               
            </tr>
            <?php endforeach; ?>
                </tbody>
     
              </table>
      </div>
            
             </div>

        </div>     
       
   </div>      
      
   
  </div>
</div>


<!--------------------Your Order_sec----------------------->
	<div class="ur_ordr_sec">
            
            <div class="ur_order">  
            	<h1>Selling Order</h1>              
            </div>
               

	</div>


<div class="urorder">
  <div class="container-fluid">    
   
   <div class="row">
   		
        <div class="col-sm-10 col-sm-offset-1">
        	<div class="order_tbl">
            <div class="order_tblsec table-responsive">

              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Order ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody> 
                  <?php foreach ($sellorder as $info): ?>    
                    
                    
            <tr>
                 <td data-label="Order ID"><a href="<?php  echo $this->request->webroot; ?>orders/view/<?php echo $info['id']; ?>"><?= $this->Number->format($info->id) ?></a></td>
                <td data-label="Order name"><?= h($info->name) ?></td>
                <td data-label="Order email"><?= h($info->email) ?> </td>
                <td data-label="Order phone"> <?= h($info->phone) ?></td>
                <td data-label="Order subtotal"><?= h($info->subtotal) ?></td>
                <td data-label="Order total"><?= h($info->total) ?></td>
                <td data-label="Order created"><?= h($info->created) ?></td> 
                <td data-label="Order actions" class="actions">
                        <select name="dlsts" class="dlsts">
                                <option <?php if($info->order_status==1){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'1'; ?>">Processing</option>
                                <option <?php if($info->order_status==2){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'2'; ?>">Pending</option>
                                <option <?php if($info->order_status==3){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'3'; ?>">Complete</option>
                                <option <?php if($info->order_status==4){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'4'; ?>">Cancel</option>  
                        </select>                  
                </td>  
            </tr>
            <?php endforeach; ?>
                </tbody>
     
              </table>
      </div>
            
             </div>

        </div>     
       
   </div>      
      
   
  </div>
</div>


</div>  

<script type="text/javascript">
    $(".dlsts").change(function () {
        var a = $(this).val();
        $.post('<?php echo $this->request->webroot; ?>orders/changestatus', {id: a}, function (d) {
            console.log(d);    
        });
        //alert(a);
    });
</script>
 
