<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Earth Vendors</title>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet"> 
<meta name="viewport" content="width">
</head>    



<body style="padding:15px 0; background: url(http://rupak.crystalbiltech.com/crystal/img/bgplait.png) repeat #dddddd;
		margin:0px auto;
		font-family: 'Roboto', sans-serif;
		font-weight:400;
		background-size: 160px;">
<table width="600" border="0" cellpadding="10" cellspacing="0" style="margin:0px auto; background:#fffefb; text-align:center;">  
  <tr style="background:#fff;">
    <td style="text-align:center; padding-top:2px; padding-bottom:2px; border-bottom:2px solid #5786a6; padding:0;">  
    	<img src="http://rupak.crystalbiltech.com/crystal/img/emaillogo.png" alt="img" />
    </td>
  </tr>  
    <tr>
    	<td style="text-align:right;">
        	<h1 style="font-size:16px; margin:0;  color:#487697; font-weight:600;">Order Cancellation</h1>     
            <h2 style="font-size:12px; margin:0; color:#4a4a4a; font-weight:normal;">Order No:- <?php if(isset($order['id'])){ echo $order['id']; } ?></h2>
        </td>
    </tr>
    
    <tr>
    	<td style="text-align:center;">    
        	<h1 style="font-size:16px; margin:0;  color:#487697; font-weight:600;">Hi <?php if(isset($order['user']['name'])){ echo $order['user']['name']; } ?>,</h1>     
            <h2 style="font-size:12px; margin:0; color:#4a4a4a; font-weight:normal;">Your order #<?php if(isset($order['id'])){ echo $order['id']; } ?> has been cancelled with below details.</h2>
        </td>
    </tr>
    
    <tr>
    	<td style="padding:15px 0; ">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="f4f4f4"; style="background-color:#f4f4f4;">
          <tr>
            <td style="text-align:left; padding: 10px;"><h3 style="margin:0; font-size:15px; font-weight:600">Order Details</h3></td>
             <td style="text-align:left; padding: 10px;"><h3 style="margin:0; font-size:15px; font-weight:600">Delivery Details</h3></td>
           
          </tr>
          <tr>
           
             <td style="text-align:left; padding: 10px;"><p style="margin:0; font-size:13px; font-weight:bold;">Order No:- <?php if(isset($order['id'])){ echo $order['id']; } ?>


</p></td>
            <td style="text-align:left; padding: 10px;"><p style="margin:0; font-size:13px"><?php if(isset($order['name'])){ echo $order['name']; } ?><br/>

<?php if(isset($order['address'])){ echo $order['address']; } ?> 

<?php if(isset($order['city'])){ echo $order['city']; } ?> <?php if(isset($order['state'])){ echo $order['state']; } ?>, PUN - <?php if(isset($order['zip'])){ echo $order['zip']; } ?></p></td>
          </tr>
          
        </table> 
        
        </td>
    </tr>
    
    
    
     <tr>  
    	<td style="padding:0 0 10px 0;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <?php if(!empty($order['order_items'])){ 
           foreach($order['order_items'] as $item) {    
           ?>   
          <tr>
              <td> 
                <?php if($item['image']){ ?> 
                     <img src="<?php echo "http://rupak.crystalbiltech.com/crystal/images/products/".$item['image']; ?>"/>  
                    <?php }else{ ?>
                   <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>"/>
                    <?php } ?>    
            </td>
            <td>
            <div style="text-align:left;">  
            <h3 style="margin:0; font-size:13px"><?php if(isset($item['name'])){ echo $item['name']; } ?></h3>  
            <p style="margin:0; font-size:13px"> <span>Quantity: <?php if(isset($item['quantity'])){ echo $item['quantity']; } ?></span></p> 
            <!--p style="margin:0; font-size:13px">Delivery by Sat, 30 Dec</p-->   
            
            </div>
            </td>  
              
            <!--td  style="text-align:left;"><p style="font-size:10px; color:#929292;">Voucher discount: Rs. 264.00</p></td-->  
            <td  style="text-align:left;"><p style=" font-size:13px; font-weight:bold; float: right; padding-right: 10px;">$<?php if(isset($item['price'])){ echo $item['price']; } ?></p></td>
          </tr>
         <?php } } ?>   
          <tr>
          	<td colspan="2" style="padding:10px 0; border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><p style="margin:0; font-size:14px;; text-align:left; padding:0 0 0 10px;">Price</p></td>
                <td colspan="2" style="padding:10px 0; border-top:1px solid #CCC;  border-bottom:1px solid #CCC; "><p style="margin:0; font-size:14px;; text-align:right; padding:0 10px 0px 0px;">$<?php if(isset($order['subtotal'])){ echo $order['subtotal']; } ?></p></td>
          </tr>
           
           <!--tr>
          	<td colspan="2" style="padding:10px 0; border-bottom:1px solid #CCC;"><p style="margin:0; font-size:14px;; text-align:left; padding:0 0 0 10px;">Handling Charges</p></td>
                <td colspan="2" style="padding:10px 0;  border-bottom:1px solid #CCC; "><p style="margin:0; font-size:14px;; text-align:right; padding:0 10px 0px 0px;">Free </p></td>
          </tr-->
  
           <tr>
          	<td colspan="2" style="padding:10px 0; border-bottom:2px solid #CCC;"><p style="margin:0; font-size:14px;; text-align:left; padding:0 0 0 10px;"><strong>Amount to be paid at delivery</strong></p></td>
            <td colspan="2" style="padding:10px 0;  border-bottom:2px solid #CCC; "><p style="margin:0; font-size:14px;; text-align:right; padding:0 10px 0px 0px;"><strong>$<?php if(isset($order['total'])){ echo $order['total']; } ?></strong></p></td>
          </tr>
        </table>

        
        </td>  
    </tr>
    <tr>
    	<td style="padding:0;"><p style="padding:10px 10px; font-size:12px; text-align:center;">Thank you  <br><span style=" font-size:12px; font-weight:600;">Team Earth Vendors</span></p></td>   
    </tr> 

</table>    
  
</body>  
</html>

      
