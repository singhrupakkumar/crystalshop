<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = '';      
?>
<!DOCTYPE html>
<html lang="en">
 <head>
<?=  $this->Html->charset() ?>     
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $cakeDescription ?> Earth Vendors</title>   
<link rel="icon" type="image/x-icon" href="<?php echo $this->request->webroot."images/website/favicon-32x32.png";?>" />
<?= $this->Html->css( array('custom/bootstrap.min.css','custom/font-awesome.min.css','custom/style.css','custom/slick.css','custom/slick-theme.css','docsupport/chosen.css') ) ?>  
<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>  
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/assets/html5shiv.min.js"></script>
<script type="text/javascript" src="js/assets/respond.min.js"></script>
<![endif]-->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,700italic,400italic,600italic,600"
          rel="stylesheet" type="text/css">
 <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> 
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" type="text/javascript"></script>
 <?= $this->Html->script(array('jquery.min.js', 'bootstrap.min.js', 'jquery-ui.min.js', 'jquery.dataTables.min', 'dataTables.bootstrap.min.js','docsupport/chosen.js')) ?>      
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>     
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>  
   <?php echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>  
 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <style>
       .alert-danger{text-align: center;}
       .alert-success{text-align: center;}
       .alert-success{
		padding: 10px;
		font-size: 15px;
		margin: 0px;
	}
	.message.error{
		background: #cc0000;
		padding: 10px;
		color: #fff;
		font-size: 15px;
		margin: 0px 0px 0px 0px;
	}
        .my-error-class{
            color:red !important;
        }
        .my-valid-class{
          color:#49BA64 !important;  
        }
        #added_items h4{text-align: center; }
        .stock {color: red;} 
            
    </style>   
  <script>      
  $( function() {  
    $( "#dob" ).datepicker({ changeYear: true });    
  } );
  
  $(document).ready(function(){
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : false,
			'info'        : true,
			'autoWidth'   : false,
			'order'		  : [[ 1, "desc" ]]
		});
	});  
 </script>  
  </head>
  <body>
                <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  
  
 
                <ul>
                     <?php if(!$loggeduser){ ?>  
                    <li class="sgn_rht active"><a class="" href="<?php echo $this->request->webroot ?>users/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a></li> 
                    <li class="<?php  if($this->request->params['action'] == 'add' ) { echo "active"; }?>"><a class="" href="<?php echo $this->request->webroot ?>users/add"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign Up</a></li>
                    <?php }else{ ?>
                    <li class="<?php  if($this->request->params['action'] == 'myaccount' ) { echo "active"; }?>"><a class="" href="<?php echo $this->request->webroot ?>users/myaccount"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
                        <ul>
                            <li class="<?php  if($this->request->params['action'] == 'myproduct' ) { echo "active"; }?>"><a href="<?php echo $this->request->webroot ?>users/myproduct"><i class="fa fa-product-hunt" aria-hidden="true"></i> My Products</a></li>
                            <li class="<?php  if($this->request->params['action'] == 'freesaleproduct' ) { echo "active"; }?>"><a href="<?php echo $this->request->webroot ?>products/freesaleproduct"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Bonus Product</a></li>
                        </ul>
                    </li>
                    <li class="<?php  if($this->request->params['action'] == 'changepassword' ) { echo "active"; }?>">
                     <a href="<?php echo $this->request->webroot; ?>users/changepassword"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>  
                    </li> 
                    <li class="<?php  if($this->request->params['action'] == 'changepassword' ) { echo "active"; }?>">    
                     <a href="<?php echo $this->request->webroot; ?>users/paymenthistory"><i class="fa fa-history" aria-hidden="true"></i> Payment History</a>  
                    </li>
                    
                    <li class="<?php  if($this->request->params['action'] == 'changepassword' ) { echo "active"; }?>">        
                     <a href="<?php echo $this->request->webroot; ?>orders/orderhistory"><i class="fa fa-first-order" aria-hidden="true"></i> Order History</a>  
                    </li> 
                    
                      <li class="<?php  if($this->request->params['action'] == 'edit' ) { echo "active"; }?>">
                   <a href="<?php echo $this->request->webroot; ?>users/edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>   
                    </li> 
                   <li class="<?php  if($this->request->params['action'] == 'edit' ) { echo "active"; }?>">   
                   <a href="<?php echo $this->request->webroot; ?>articles/index"><i class="fa fa-pencil" aria-hidden="true"></i> My Article</a>    
                    </li> 
                    <li class="active"><a class="" href="<?php echo $this->request->webroot ?>users/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                    
                    
                <?php } ?>  
            	</ul>

</div> 
<?php if($loggeduser){ ?><span class="menu-icon" onclick="openNav()">&#9776;</span><?php } ?>
      <div class="loader" style="display:none;"></div>           
 <!---------header---------->
  <header class="bg-hdr">
 
 <div class="header-outr">
  <div class="container">
  <div class="row">
     <div class="col-sm-12">
     	<div class="seacr-br">
        <div class="col-sm-6">
        	<div class="blnk-mbl"></div>  
        </div>
        <div class="col-sm-6"> 
            <form action="<?php echo $this->request->webroot; ?>products/search" method="get">     
    	 <div class="input-group seacrh-inpt"  id="adv-search">
             <input type="text" class="form-control top_mgn" name="search" placeholder="Search for anything" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                    <button type="button" class="btn btn-default" data-toggle="dropdown" aria-expanded="false" style="padding:0;">
                    <select name="catid" style="    border: 0;
    line-height: 30px;
    height: 32px;">
                              <option value="0">Choose One</option> 
                                <?php if(isset($categories)){   
                                    foreach($categories as $cat){
                                    ?>  
                                <option value="<?php if(isset($cat['id'])){ echo $cat['id']; } ?>"><?php if(isset($cat['name'])){ echo $cat['name'];} ?></option>
                                <?php }   
                                }
                                ?>
                             </select>
                    </button>
                          
                        </div>
                        <button type="submit" class="btn defult_btn2 serch-icn"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
          </form>  

            <div class="cart">
            <a href="<?php echo $this->request->webroot ?>stores/cart">   
             <div class="cart-icn">
            	<img src="<?php echo $this->request->webroot; ?>images/website/cart-icon.png" alt="" > 
                <div class="cart-no" id="cartcount"><?php $shop = $this->request->session()->read('cart_count'); if(!empty($shop)){  echo count($shop);}else{ echo 0; } ?></div>   
            </div>
            <div class="cart-txt">Cart</div>
             </a>   
            </div>
            <div class="sgn_up">
             <?php if(!$loggeduser){ ?>   
             <ul>
                <li class="sgn_rht active"><a class="ble_rqst" href="<?php echo $this->request->webroot ?>users/login"> Sign In</a></li> 
                <li class="<?php  if($this->request->params['action'] == 'add' ) { echo "active"; }?>"><a class="ble_rqst" href="<?php echo $this->request->webroot ?>users/add">Sign Up</a></li>   
            	</ul>  
             <?php } ?>   
            </div>
         
          
            
          </div>
          
         </div> 
        </div>
     </div>
     </div>
     
  </div>
  </div>
  <div class="header-outr2">
  <div class="backgd"><img src="<?php echo $this->request->webroot; ?>images/website/hdrbg.png" class="img-bg" alt=""></div>
  <div class="container">
  
  <div class="top-nav">
  <div class="top-nav-inr">
        <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle btn defult_btn">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php  if($this->request->params['action'] == 'index' ) { echo "active"; }?>"><a href="<?php echo $this->request->webroot ?>stores/index">Home</a></li>
                <li class="<?php  if($this->request->params['action'] == 'contact' ) { echo "active"; }?>"><a href="<?php echo $this->request->webroot ?>staticpages/contact">Contact Us</a></li> 
                <li class="<?php  if($this->request->params['action'] == 'addsellproduct' ) { echo "active"; }?>"><a href="<?php echo $this->request->webroot ?>products/addsellproduct">Selling Your Products</a></li>
                 <li class="<?php  if($this->request->params['action'] == 'add' ) { echo "active"; }?>"><a href="<?php echo $this->request->webroot ?>articles/add">Promote Your Products</a></li>  
            </ul>      
            
        </div>
    </nav>
    </div>
    </div>
  </div>
  
  </div>
  
 </header>  
  <!--------banner section------->
 <?= $this->fetch('content') ?>      
<!-----------footer-section--------------> 
<div class="footer_section">
	<div class="uper_ftr">
	<div class="container">
    	<div class="row">
        <div class="col-sm-4">
        	<div class="logo_pic">
            	<a href="<?php echo $this->request->webroot ?>stores/index"><img src="<?php echo $this->request->webroot; ?>images/website/logo_fnl.png"></a>
            	</div>
        	</div>
            <div class="col-sm-8"> 
                <div class="message" style="text-align:center;font-weight: bold;color:#49BA64;"></div>   
             <div class="ftr_dvde">
              <div class="col-sm-3">
              	<div class="privcy_sction">
                	<h3>Privacy info</h3>
                       <div class="after_prvsy">
                       
                    </div>
                    <ul>
                    <li><a href="<?php echo $this->request->webroot ?>staticpages/term">Terms & Conditions</a></li>
                    </ul>
                	</div>
               </div>
               
               <div class="col-sm-3">
              	<div class="privcy_sction">
                	<h3>Need Help</h3>
                      <div class="after_prvsy">
                       
                    </div>
                    <ul>
                    <li><a href="<?php echo $this->request->webroot ?>staticpages/faq">FAQ</a></li>  
                    <li><a href="<?php echo $this->request->webroot ?>staticpages/contact">Contact Us</a></li>       
                    </ul>
                	</div>
               </div>
               
               <div class="col-sm-3">
              	<div class="privcy_sction">
                	<h3>Sellers</h3>
                      <div class="after_prvsy">
                       
                    </div>
                    <ul>
                    <li><a href="<?php echo $this->request->webroot ?>users/add">Become a seller</a></li>
                    <li><a href="<?php echo $this->request->webroot ?>articles/add">Write an article</a></li>
                    <li><a href="<?php echo $this->request->webroot ?>articles/add">Promote Yourself</a></li>  
                    </ul>
                	</div>
               </div>
               
               <div class="col-sm-3">
              	<div class="privcy_sction">
                	<h3>Subscribe</h3>
                      <div class="after_prvsy">
                       
                    </div>
                    <ul>
                  
                    <li> 
                    <div class="cntn_cvr"> 
                        <div class="search-container"> 
                            
                            <form  method="post" id="subscribe">
                              <input id="email" type="email" name="email" class="form-control" placeholder="Your email address">
                              <button type="button" id="nwsltr" name="nwsltr" class="submit_align">SUBRCIBE</button>  
                            </form>
                         </div>
                    </div>
                    </li>
                    <li><a href="#" class="rgst_lnk">Register now to get updates</a></li>
                    <li><a href="#" class="pay_lnk">payment</a><img src="<?php echo $this->request->webroot; ?>images/website/foter_paypal.png" class="pal_side"></li>
                    </ul>
                	</div>
               </div>
               
              	</div>
             	</div>
            	</div>
          <div class="copy_rsrve">
          <span>Copyright &copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?></span>
          	</div>
        	</div>
    	</div>
	</div> 
    <script type="text/javascript" src="<?php echo $this->request->webroot;?>js/slick.js"></script>

     <script type="text/javascript">
    $(document).on('ready', function() {
      $(".vertical-center-4").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 4,
        slidesToScroll: 2
      });
      $(".vertical-center-3").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".vertical-center-2").slick({
        dots: true,
        vertical: true,
        centerMode: true,
        slidesToShow: 2,
        slidesToScroll: 2
      });
      $(".vertical-center").slick({
        dots: true,
        vertical: true,
        centerMode: true,
      });
      $(".vertical").slick({
        dots: true,
        vertical: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
</script>

<script>

	  
	  
	  $('.regular').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>

<script type="text/javascript">

        function valid_email_address(email)
        {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            return pattern.test(email);
        }

        jQuery('#nwsltr').on("click", function ($) {     
            if (!valid_email_address(jQuery("#email").val()))
            {
                jQuery(".message").html('Please make sure you enter a valid email address.');
            }
            else
            {

                jQuery(".message").html("<span style='color:green;'>Almost done, please check your email address to confirmation.</span>");
                jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/newsletter', 
                    data: jQuery('#subscribe').serialize(),
                    type: 'POST',
                    success: function (msg) {
                        if (msg == "success")
                        {
                            jQuery("#email").val("");
                            jQuery(".message").html('<span style="color:green;">You have successfully subscribed to our mailing list.</span>');

                        }
                        else
                        {
                            jQuery(".message").html('<span style="color:green;">Please make sure you enter a valid email address.</span>');
                        }
                    }
                });
            }
            return false;
        });
        
        $(document).ready(function(){ 
                $('.flash-msg').delay(5000).fadeOut('slow');
        });
        
    </script> 

    
    <script> 
//    jQuery("#s").autocomplete({
//		minLength: 2,
//		select: function(event, ui) {
//			jQuery("#s").val(ui.item.label);
//			jQuery("#searchform").submit();
//		},
//		source: function (request, response) {
//			jQuery.ajax({
//				url: 'https://rupak.crystalbiltech.com/affiliate/products/searchjson',
//				data: {
//					term: request.term
//				},
//				dataType: "json",
//				success: function(data) {
//					response(jQuery.map(data, function(el, index) {
//						return {
//							value: el.name,
//							name: el.name,
//							image: el.image
//						};
//					}));
//				}
//			});
//		}
//	}).data("ui-autocomplete")._renderItem = function (ul, item) {
//		return jQuery("<li></li>")
//			.data("item.autocomplete", item) 
//			.append("<a><img width='40' src='https://rupak.crystalbiltech.com/affiliate/images/products/" + item.image + "' /> " + item.name + "</a>")
//			.appendTo(ul)
//	};
	</script> 
    
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

</body>
</html>     