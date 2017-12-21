jQuery(document).ready(function () {
  $.getJSON("http://rupak.crystalbiltech.com/crystal/stores/webdisplaycart", function (data) { 
 jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){    
  myvar += '<h4>Shopping Cart is empty</h4>'; 
 }else{
 myvar = '<div class="table_boundry">'+
'<table>'+
'  <thead>'+
'      <tr>'+
'      <th scope="col">ITEM</th>'+
'      <th scope="col">QTY</th>'+
'      <th scope="col">PRICE</th>'+
'      <th scope="col">DELIVERY DETAIL</th>'+
'      <th scope="col">REMOVE</th>'+
'    </tr>'+
'  </thead>'+
'  <tbody>';
$.each(data['data']['products'], function (index, value) {      
myvar += '   <tr>'+
'      <td data-label="ITEM" class="zro_lvl"><div class="pic_stncrt">'+
'      	<div class="crt_pic">'+
'        	<img src="'+ value.product.image +'">'+
'        	</div>'+
'          <div class="cart_txt">'+
'          	<h3>Sphene stone</h3>'+
'            <p>'+ value.product.description +'</p>'+
'          	</div>'+
'      	</div>'+
'        </td>'+
'      <td data-label="QTY" class="on_crt">'+
'      <div class="qty_nmbr">'+
'                       <span>QTY</span>'+
'                       '+
' <div class="input-group spinner">'+
'    <input type="text" class="form-control" value="'+ value.quantity +'">'+
'    <div class="input-group-btn-vertical vrtl_pstn">'+
'      <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>'+
'      <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>'+
'                           </div>'+
'                        </div>'+
'                     </div>'+
'      '+
'      '+
'      </td>'+
'      <td data-label="PRICE">$'+ value.price +'</td>'+
'      <td data-label="DELIVERY DETAIL">'+
'      <h3 class="fre_colr">Free</h3>'+
'      <span class="delvr_bsns">Delivered in 7-8 business days.</span>'+
'      </td>'+
'      <td data-label="REMOVE" class="trsh_sze"><i class="fa fa-trash remove_item" id=' + value.product.id + ' aria-hidden="true"></i></td>'+
'    </tr> ';
 });  
myvar += '  </tbody>'+
'</table>'+
'<div class="ttl_est">'+
'  	<h3>Estimated Total:<span>$'+data['data']['cartInfo']['total']+'</span></h3>'+
'</div>'+
'    '+
'<div class="cntinue_alst">'+
' <button type="button" class="btn btn-success scss_cntn">Continue</button>  '+
'</div>'+
'        '+
'        	</div>';
 } 
  $('#added_items').html(myvar);   
 
        rmv();
        //$('#total_items').delay(2000).fadeIn('slow');
    });
    
    
    function rmv() {
        jQuery('.remove_item').off("click").on('click', function () { 
            jQuery.ajax({
                type: "POST",
                url: "http://rupak.crystalbiltech.com/crystal/stores/webremoveitems",  
                data: {
                    id: jQuery(this).attr("id") 
                },
                dataType: "json",
                success: function (data) {   
 jQuery('#cartcount').html(data['data']['cartcount']);
   
if(data['data']['cartcount'] == "0"){    
myvar += '<h3>Shopping Cart is empty</h3>';
 }else{
var myvar = '<div class="table_boundry">'+
'<table>'+
'  <thead>'+
'      <tr>'+
'      <th scope="col">ITEM</th>'+
'      <th scope="col">QTY</th>'+
'      <th scope="col">PRICE</th>'+
'      <th scope="col">DELIVERY DETAIL</th>'+
'      <th scope="col">REMOVE</th>'+
'    </tr>'+
'  </thead>'+
'  <tbody>';
$.each(data['data']['products'], function (index, value) {      
myvar += '   <tr>'+
'      <td data-label="ITEM" class="zro_lvl"><div class="pic_stncrt">'+
'      	<div class="crt_pic">'+
'        	<img src="'+ value.product.image +'">'+
'        	</div>'+
'          <div class="cart_txt">'+
'          	<h3>Sphene stone</h3>'+
'            <p>'+ value.product.description +'</p>'+
'          	</div>'+
'      	</div>'+
'        </td>'+
'      <td data-label="QTY" class="on_crt">'+
'      <div class="qty_nmbr">'+
'                       <span>QTY</span>'+
'                       '+
' <div class="input-group spinner">'+
'    <input type="text" class="form-control" value="'+ value.quantity +'">'+
'    <div class="input-group-btn-vertical vrtl_pstn">'+
'      <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>'+
'      <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>'+
'                           </div>'+
'                        </div>'+
'                     </div>'+
'      '+
'      '+
'      </td>'+
'      <td data-label="PRICE">$'+ value.price +'</td>'+
'      <td data-label="DELIVERY DETAIL">'+
'      <h3 class="fre_colr">Free</h3>'+
'      <span class="delvr_bsns">Delivered in 7-8 business days.</span>'+
'      </td>'+
'      <td data-label="REMOVE" class="trsh_sze"><i class="fa fa-trash remove_item" id=' + value.product.id + ' aria-hidden="true"></i></td>'+
'    </tr> ';
 });  
myvar += '  </tbody>'+
'</table>'+
'<div class="ttl_est">'+
'  	<h3>Estimated Total:<span>$'+data['data']['cartInfo']['total']+'</span></h3>'+
'</div>'+
'    '+
'<div class="cntinue_alst">'+
' <button type="button" class="btn btn-success scss_cntn">Continue</button>  '+
'</div>'+
'        '+
'        	</div>';
 } 
  $('#added_items').html(myvar);         
  
        rmv();
                },
                error: function () { 
                    alert('Error!');
                }
            });
            return false;
        });
      
    }   
    

  
      
});  