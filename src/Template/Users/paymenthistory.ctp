<div class="smart_container">
    <!--------------------Your Order_sec----------------------->
    <div class="ur_ordr_sec">

        <div class="ur_order">
            <h1>Payment History</h1>                
        </div>         
    </div>
    <!---------------------Have A Questions------------------------->
  
    <div class="urorder">
        <div class="container-fluid">    

            <div class="row">

                <div class="col-sm-10 col-sm-offset-1">
                    <div class="order_tbl">
                        <div class="order_tblsec table-responsive">
                           <table id="example2" class="table table-bordered table-hover">
                            <thead>
                           <tr>
                               <th scope="col"><?= $this->Paginator->sort('Payer Name') ?></th>
                               <th scope="col"><?= $this->Paginator->sort('Payer Email') ?></th>
                               <th scope="col"><?= $this->Paginator->sort('Payer Phone') ?></th>  
                               <th scope="col"><?= $this->Paginator->sort('Subtotal') ?></th>
                               <th scope="col"><?= $this->Paginator->sort('created') ?></th>

                           </tr>
                           </thead>
                               <tbody>
                                 <?php 
                                 $total = 0;
                                 foreach ($orderhistory as $info):
                                     
                                     $total += $info->total;
                                     
                                     ?>  


                           <tr>
                               <td data-label="Order Name"><?= h($info->name) ?></td>
                               <td data-label="Order email"><?= h($info->email) ?></td>
                               <td data-label="Order phone"><?= h($info->phone) ?></td>
                               <td data-label="Order subtotal">$<?= h($info->subtotal) ?></td>
                               <td data-label="Order created"><?= h($info->created) ?></td> 
                          
                           </tr>
                           <?php endforeach; ?>
                          
                               </tbody>
                                <tr><td colspan="5"> <span>Total</span> <span>$<?php if(isset($total)){ echo $total; } ?></span> </td> </tr>
                             </table>
                           
                           

                        </div>
                    </div> 
                </div>     
            </div>      


        </div>
    </div>
</div>
