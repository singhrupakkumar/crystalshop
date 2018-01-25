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
                           <table id="paymenthisry" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Order ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Payer Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Payer Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Payer Phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total Pay') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Your Amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Admin Comission') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Created') ?></th>
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
                    <th></th> 
                </tr>
            </tfoot>
                <tbody>
                  <?php foreach ($orderhistory as $info): ?>
                    
                    
            <tr>
                <td><?= $this->Number->format($info['id']) ?></td>
                <td><?= h($info['name']) ?></td>    
                <td><?= h($info['email']) ?></td>
                <td><?= h($info['phone']) ?></td>
                <td>$<?= h($info['total']) ?></td>
                <td>$<?= h($info['total'] - $info['commission_amount']) ?></td>  
                <td>$<?= h($info['commission_amount']) ?></td>
                <td><?= h($info['created']) ?></td>   
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


<script>
    $(document).ready(function() { 
        
        
     $('.date').datepicker({ changeYear: true });   
        
        
    $('#paymenthisry').DataTable( {
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
