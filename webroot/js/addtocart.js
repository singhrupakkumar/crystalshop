jQuery(document).ready(function () {
  $.getJSON("http://rupak.crystalbiltech.com/crystal/stores/webdisplaycart", function (data) { 
 jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){     
  myvar += '<img src="http://rupak.crystalbiltech.com/crystal/img/empty-cart-icon-1.jpg" alt="img" />';   
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
    var str = value.product.description;  
myvar += '   <tr>'+
'      <td data-label="ITEM" class="zro_lvl"><div class="pic_stncrt">'+
'      	<div class="crt_pic">'+
'        	<img src="'+ value.product.image +'">'+
'        	</div>'+
'          <div class="cart_txt">'+
'          	<h3>'+ value.product.name +'</h3>'+
'          	</div>'+
'      	</div>'+
'        </td>'+
'      <td data-label="QTY" class="on_crt">'+
'      <div class="qty_nmbr"><p class="stock"></p>'+
'                       <span>QTY</span>'+
'                       '+
' <div class="input-group spinner">'+
'    <input type="text" class="form-control" value="'+ value.quantity +'">'+
'    <div class="input-group-btn-vertical vrtl_pstn">'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-up cplus"></i></button>'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-down cmins"></i></button>'+
'                           </div>'+
'                        </div>'+
'                     </div>'+
'      '+
'      '+
'      </td>'+
'      <td data-label="PRICE">$'+ value.price +'</td>'+
'      <td data-label="DELIVERY DETAIL">';
 if(value.product.delivery_details != null){    
 myvar += '      <h3 class="fre_colr"></h3>'+
'      <span class="delvr_bsns">'+ value.product.delivery_details +'</span>';   
 }
myvar += '      </td>'+
'      <td data-label="REMOVE" class="trsh_sze"><i class="fa fa-trash remove_item" id=' + value.product.id + ' aria-hidden="true"></i></td>'+
'    </tr> ';
 });  
myvar += '  </tbody>'+
'</table>'+
'<div class="ttl_est">'+
'  	<h3>Estimated Total: <span>$'+data['data']['cartInfo']['total']+'</span></h3>'+
'</div>'+
'    '+
'<div class="cntinue_alst">'+
'<a href="http://rupak.crystalbiltech.com/crystal/stores/checkout"><button type="button" class="btn btn-success scss_cntn countinue">Continue</button></a>  '+
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
  var myvar = '';
 if(data['data']['cartcount'] == "0"){    
  myvar += '<img src="http://rupak.crystalbiltech.com/crystal/img/empty-cart-icon-1.jpg" alt="img" />'; 
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
    var str = value.product.description;  
myvar += '   <tr>'+
'      <td data-label="ITEM" class="zro_lvl"><div class="pic_stncrt">'+
'      	<div class="crt_pic">'+
'        	<img src="'+ value.product.image +'">'+
'        	</div>'+
'          <div class="cart_txt">'+
'          	<h3>'+ value.product.name +'</h3>'+
'          	</div>'+
'      	</div>'+
'        </td>'+
'      <td data-label="QTY" class="on_crt">'+
'      <div class="qty_nmbr"><p class="stock"></p>'+
'                       <span>QTY</span>'+
'                       '+
' <div class="input-group spinner">'+
'    <input type="text" class="form-control" value="'+ value.quantity +'">'+
'    <div class="input-group-btn-vertical vrtl_pstn">'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-up cplus"></i></button>'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-down cmins"></i></button>'+
'                           </div>'+
'                        </div>'+
'                     </div>'+
'      '+
'      '+
'      </td>'+
'      <td data-label="PRICE">$'+ value.price +'</td>'+
'      <td data-label="DELIVERY DETAIL">';
 if(value.product.delivery_details != null){
 myvar += '      <h3 class="fre_colr"></h3>'+
'      <span class="delvr_bsns">'+ value.product.delivery_details +'</span>';
 }
myvar += '      </td>'+
'      <td data-label="REMOVE" class="trsh_sze"><i class="fa fa-trash remove_item" id=' + value.product.id + ' aria-hidden="true"></i></td>'+
'    </tr> ';
 });  
myvar += '  </tbody>'+
'</table>'+
'<div class="ttl_est">'+
'  	<h3>Estimated Total: <span>$'+data['data']['cartInfo']['total']+'</span></h3>'+
'</div>'+
'    '+
'<div class="cntinue_alst">'+
' <a href="http://rupak.crystalbiltech.com/crystal/stores/checkout"><button type="button" class="btn btn-success scss_cntn countinue">Continue</button></a>  '+
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
        
        
   /*****************Increase Decrease**********************/  
   
   jQuery('.cplus').off("click").on('click', function () {
            jQuery.ajax({
                type: "POST",
                url: "http://rupak.crystalbiltech.com/crystal/stores/cartincreaseqty", 
                data: { 
                    id:jQuery(this).attr("id"),
                },
                dataType: "json",
                success: function (data) { 

              jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){    
  myvar += '<img src="http://rupak.crystalbiltech.com/crystal/img/empty-cart-icon-1.jpg" alt="img" />'; 
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
    var str = value.product.description;  
myvar += '   <tr>'+
'      <td data-label="ITEM" class="zro_lvl"><div class="pic_stncrt">'+
'      	<div class="crt_pic">'+
'        	<img src="'+ value.product.image +'">'+
'        	</div>'+
'          <div class="cart_txt">'+
'          	<h3>'+ value.product.name +'</h3>'+
'          	</div>'+
'      	</div>'+
'        </td>'+
'      <td data-label="QTY" class="on_crt">'+
'      <div class="qty_nmbr"><p class="stock"></p>'+
'                       <span>QTY</span>'+
'                       '+
' <div class="input-group spinner">'+
'    <input type="text" class="form-control" value="'+ value.quantity +'">'+
'    <div class="input-group-btn-vertical vrtl_pstn">'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-up cplus"></i></button>'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-down cmins"></i></button>'+
'                           </div>'+
'                        </div>'+
'                     </div>'+
'      '+
'      '+
'      </td>'+
'      <td data-label="PRICE">$'+ value.price +'</td>'+
'      <td data-label="DELIVERY DETAIL">';
 if(value.product.delivery_details != null){
 myvar += '      <h3 class="fre_colr"></h3>'+
'      <span class="delvr_bsns">'+ value.product.delivery_details +'</span>';
 }
myvar += '      </td>'+
'      <td data-label="REMOVE" class="trsh_sze"><i class="fa fa-trash remove_item" id=' + value.product.id + ' aria-hidden="true"></i></td>'+
'    </tr> ';
 });  
myvar += '  </tbody>'+
'</table>'+
'<div class="ttl_est">'+
'  	<h3>Estimated Total: <span>$'+data['data']['cartInfo']['total']+'</span></h3>'+
'</div>'+
'    '+
'<div class="cntinue_alst">'+
'<a href="http://rupak.crystalbiltech.com/crystal/stores/checkout"><button type="button" class="btn btn-success scss_cntn countinue">Continue</button></a>  '+
'</div>'+
'        '+
'        	</div>';
 } 
  $('#added_items').html(myvar);   
  jQuery('.stock').html(data.msg);   
        rmv();
                },
                error: function () {
                    console.log('Error!');    
                }
            });
            return false;
        });
        jQuery('.cmins').off("click").on('click', function () { 
            jQuery.ajax({
                type: "POST",    
                url: "http://rupak.crystalbiltech.com/crystal/stores/cartdecreaseqty",         
                data: { 
                   id:jQuery(this).attr("id"), 
                },
                dataType: "json",
                success: function (data) {
     
               jQuery('#cartcount').html(data['data']['cartcount']); 
                
  var myvar = '';  
 if(data['data']['cartcount'] == "0"){    
  myvar += '<img src="http://rupak.crystalbiltech.com/crystal/img/empty-cart-icon-1.jpg" alt="img" />'; 
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
    var str = value.product.description;  
myvar += '   <tr>'+
'      <td data-label="ITEM" class="zro_lvl"><div class="pic_stncrt">'+
'      	<div class="crt_pic">'+
'        	<img src="'+ value.product.image +'">'+
'        	</div>'+
'          <div class="cart_txt">'+
'          	<h3>'+ value.product.name +'</h3>'+ 
'          	</div>'+
'      	</div>'+
'        </td>'+
'      <td data-label="QTY" class="on_crt">'+
'      <div class="qty_nmbr"><p class="stock"></p>'+
'                       <span>QTY</span>'+
'                       '+
' <div class="input-group spinner">'+
'    <input type="text" class="form-control" value="'+ value.quantity +'">'+
'    <div class="input-group-btn-vertical vrtl_pstn">'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-up cplus"></i></button>'+
'      <button class="btn btn-default" type="button"><i id="'+value.product.id+'" class="fa fa-caret-down cmins"></i></button>'+
'                           </div>'+
'                        </div>'+
'                     </div>'+
'      '+
'      '+
'      </td>'+
'      <td data-label="PRICE">$'+ value.price +'</td>'+
'      <td data-label="DELIVERY DETAIL">';
 if(value.product.delivery_details != null){
 myvar += '      <h3 class="fre_colr"></h3>'+
'      <span class="delvr_bsns">'+ value.product.delivery_details +'</span>';
 }
myvar += '      </td>'+
'      <td data-label="REMOVE" class="trsh_sze"><i class="fa fa-trash remove_item" id=' + value.product.id + ' aria-hidden="true"></i></td>'+
'    </tr> ';
 });  
myvar += '  </tbody>'+
'</table>'+
'<div class="ttl_est">'+
'  	<h3>Estimated Total: <span>$'+data['data']['cartInfo']['total']+'</span></h3>'+
'</div>'+
'    '+
'<div class="cntinue_alst">'+
'<a href="http://rupak.crystalbiltech.com/crystal/stores/checkout"><button type="button" class="btn btn-success scss_cntn countinue">Continue</button></a> '+
'</div>'+
'        '+
'        	</div>';
 } 
  $('#added_items').html(myvar);   
   jQuery('.stock').html(data.msg); 
        rmv();      
                },
                error: function () {
                    console.log('Error!');
                }
            });
            return false;  
        });
       
        


        
        
        
        
               
               
        
      
    }     
    
  
  
      
});    