<section class="content-header">
  
    <h1>
    Payment History 
      <?php echo $this->Flash->render(); ?>
    <small></small>
    </h1>
    <div class="container">
        <div class="row">
         <div class="col-xs-12">
             <form method="post">
             <div class="form-group">
                 <label>From</label>
                 <input type="text" name="from" value="<?php if(isset($_POST['from'])){ echo $_POST['from']; } ?>" class="form-control date">
             </div> 
             <div class="form-group"> 
                 <label>To</label>
                 <input type="text" name="to" value="<?php if(isset($_POST['to'])){ echo $_POST['to']; } ?>" class="form-control date">
             </div>  
             <div class="form-group">
                 <input type="submit" name="submit" value="Search" class="btn btn-info">
             </div>     
            </form>     
          </div>   
        </div>    
    </div>    

    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
    </ol>
    
   
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
      
        
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="payment" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Order ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Seller Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Seller Paypal Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total Pay') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Pay to Seller') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Admin Comission') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="1" style="text-align:right">Total:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
                <tbody>
                  <?php foreach ($orders as $info): ?>
                    
                    
            <tr>
                <td><?= $this->Number->format($info['Orders__id']) ?></td>
                <td><?= h($info['Orders__name']) ?></td>    
                <td><?= h($info['Seller__name']) ?></td>
                <td><?= h($info['Seller__paypal_email']) ?></td>
                <td>$<?= h($info['Orders__total']) ?></td>
                <td>$<?= h($info['Orders__total'] - $info['Orders__commission_amount']) ?></td>  
                <td>$<?= h($info['Orders__commission_amount']) ?></td>
                <td><?= h($info['Orders__created']) ?></td> 
                 <td><?php if($info['Orders__order_status'] == 1){ echo "Pending"; }elseif($info['Orders__order_status'] == 2){ echo "Processing";  }elseif($info['Orders__order_status'] == 3){ echo "Complete";  }elseif($info['Orders__order_status'] == 4){ echo "Cancel";  } ?></td> 
                <td class="actions">  
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $info['Orders__id']],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>
                    
                    <?php if($info['Orders__order_status'] == 3){ if($info['Orders__paid_by_admin'] == 1){ ?>        
                      <a href="#" class="btn btn-danger btn-xs">Paid </a>   
                    <?php }else{ ?>
                    <?= $this->Form->postLink(__('Pay Now'), ['action' => 'markpay', $info['Orders__id']], ['confirm' => __('Are you sure you want to mark pay # {0}?', $info['Orders__id']),'class' => 'btn btn-success btn-xs']) ?>     
                    <?php } } ?>
                </td>  
            </tr>
            <?php endforeach; ?>  
                </tbody>
     
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>  
    </div>
</section>      

<script>
    $(document).ready(function() {
        
        
     $('.date').datepicker({ changeYear: true });   
        
        
    $('#payment').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
          var  total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
             
               // Total column 6  this page
           var pageTotal6 = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
             
            // Total column 5  this page
           var pageTotal5 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
             // Total column 4  this page
           var pageTotal4 = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );    
 
            // Update footer 
            
            $( api.column( 6 ).footer() ).html(    
               // '$'+pageTotal +' ( $'+ total +' total)'
               '$'+pageTotal6 +''
            );
            
            
            $( api.column( 5 ).footer() ).html(
               // '$'+pageTotal +' ( $'+ total +' total)'
               '$'+pageTotal5 +''
            );
    
          $( api.column( 4 ).footer() ).html(
               // '$'+pageTotal +' ( $'+ total +' total)'
               '$'+pageTotal4 +''
            );
            
        }
    } );
    

    
} );
</script>    