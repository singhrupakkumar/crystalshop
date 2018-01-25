<div class="smart_container">
<!--------------------Your Order_sec----------------------->
	<div class="ur_ordr_sec">
            
            <div class="ur_order">
                 <div class="col-sm-12">
             <div class="sign-flash">  
              <?= $this->Flash->render() ?>   
              </div>
              </div>     
            	<h1>My Purchased Orders</h1>              
            </div>
               

	</div>


<div class="urorder">
  <div class="container-fluid">    
   
   <div class="row">
   		
        <div class="col-sm-10 col-sm-offset-1">
        	<div class="order_tbl">
            <div class="order_tblsec table-responsive">

              <table id="yourorder" class="table table-bordered table-hover">
             <thead>
            <tr class="clr_chmg">
                <th class="colr_for" scope="col">Order ID</th>
                <th class="colr_for" scope="col">Name</th>
                <th class="colr_for" scope="col">Email</th>
                <th class="colr_for" scope="col">Seller</th>
                <th class="colr_for" scope="col">Total</th>
                <th class="colr_for" scope="col">created</th>
                <th class="colr_bld" scope="col" class="actions">Status</th>  
                <th class="colr_bld" scope="col" class="actions">Action</th>
            </tr>
            </thead>
                <tbody>
                  <?php foreach ($yourorders as $info):
                      ?>  
                    
                    
            <tr>
                <td data-label="Order ID"><a href="<?php  echo $this->request->webroot; ?>orders/view/<?php echo $info['id']; ?>"><?= $this->Number->format($info->id) ?></a></td>
                <td data-label="Order name"><?= h($info->name) ?></td> 
                <td data-label="Order email" class="brk_ml"><?= h($info->email) ?></td>
                <td data-label="Order user name"><?= h($info->seller->name) ?></td>
                <td data-label="Order total"><?= h($info->total) ?></td>
                 <td data-label="Order created"><?= h($info->created) ?></td> 
                <td data-label="Order order_status"><?php if($info->order_status == 1){ echo "Pending"; }elseif($info->order_status == 2){ echo "Processing";  }elseif($info->order_status == 3){ echo "Complete";  }elseif($info->order_status == 4){ echo "Cancel";  } ?></td> 
            
                <td data-label="Order actions" class="actions">   
                     <?php 
                    $orderdate = $info->created;  
                   $createDate = new DateTime($orderdate);
                   $strip = $createDate->format('Y-m-d');
                    $now = time(); // or your date as well
            $your_date = strtotime($strip);
            $datediff = $now - $your_date;

             $datecount = floor($datediff / (60 * 60 * 24));
               if($info->order_status !=3){  
              if($datecount > 2 && $info->order_status !=4){ 
               
                         ?>        
                   <p>You cannot cancel this Booking as cancellation period has expired.</p>   
                    <?php }elseif($info->order_status !=4){ ?> 
                    <?= $this->Form->postLink(__('Cancel'), ['action' => 'ordercancel', $info['id']], ['confirm' => __('Are you sure you want to cancel order # {0}?', $info['id']),'class' => 'btn btn-danger btn-xs cancelbtn']) ?>      
               <?php } } ?>                    
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


<!--------------------Your Order_sec----------------------->
	<div class="ur_ordr_sec">
            
            <div class="ur_order">  
            	<h1>My Sold Orders</h1>              
            </div>
               

	</div>


<div class="urorder">
  <div class="container-fluid">    
   
   <div class="row">
   		
        <div class="col-sm-10 col-sm-offset-1">
        	<div class="order_tbl">
            <div class="order_tblsec table-responsive">

              <table id="sellingorder" class="table table-bordered table-hover">
             <thead>
            <tr class="clr_chmg">
                <th class="colr_for" scope="col"><?= $this->Paginator->sort('Order ID') ?></th>
                <th class="colr_for" scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th class="colr_for" scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th class="colr_for" scope="col"><?= $this->Paginator->sort('Total') ?></th>
                <th class="colr_for" scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th class="colr_for" scope="col"><?= $this->Paginator->sort('Status') ?></th> 
                <th class="colr_bld" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody> 
                  <?php foreach ($sellorder as $info): ?>    
                    
                    
            <tr>
                 <td data-label="Order ID"><a href="<?php  echo $this->request->webroot; ?>orders/view/<?php echo $info['id']; ?>"><?= $this->Number->format($info->id) ?></a></td>
                <td data-label="Order name"><?= h($info->name) ?></td>
                <td data-label="Order email" class="brk_ml"><?= h($info->email) ?> </td>  
                <td data-label="Order total"><?= h($info->total) ?></td>
                <td data-label="Order created"><?= h($info->created) ?></td> 
                 <td data-label="Order order_status"><?php if($info->order_status == 1){ echo "Pending"; }elseif($info->order_status == 2){ echo "Processing";  }elseif($info->order_status == 3){ echo "Complete";  }elseif($info->order_status == 4){ echo "Cancel";  } ?></td> 
                <td data-label="Order actions" class="actions">
                        <select name="dlsts" class="dlsts">
                            <?php if($info->order_status !=4){ ?>
                                <option <?php if($info->order_status==1){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'1'; ?>">Pending</option>
                                <option <?php if($info->order_status==2){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'2'; ?>">Processing</option>
                                <option <?php if($info->order_status==3){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'3'; ?>">Complete</option> 
                                <!--option <?php if($info->order_status==4){ echo "selected"; } ?> value="<?php echo $info['uid'] . '-'.$info['id']. '-'.'4'; ?>">Cancel</option-->  
                            <?php }else{
                                echo "<option>Canceled</option>";
                            } ?>
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
    
    
         
    $(document).ready(function() {   
  $('#yourorder').DataTable( {
   "order": [[ 1, "desc" ]]
    } );

   $('#sellingorder').DataTable( {
   "order": [[ 1, "desc" ]]
    } );
   } );  

</script>
 
