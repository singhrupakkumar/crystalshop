<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>
<script>
/********gallery popup*******************/
$( document ).ready(function() {
$('.without-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

$('.with-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		zoom: {
			enabled: true
		}
	});
}); 
</script>

<style>
      
.image-link {
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in;
}


/* This block of CSS adds opacity transition to background */
.mfp-with-zoom .mfp-container,
.mfp-with-zoom.mfp-bg {
	opacity: 0;
	-webkit-backface-visibility: hidden;
	-webkit-transition: all 0.3s ease-out; 
	-moz-transition: all 0.3s ease-out; 
	-o-transition: all 0.3s ease-out; 
	transition: all 0.3s ease-out;
}

.mfp-with-zoom.mfp-ready .mfp-container {
		opacity: 1;
}
.mfp-with-zoom.mfp-ready.mfp-bg {
		opacity: 0.8;
}

.mfp-with-zoom.mfp-removing .mfp-container, 
.mfp-with-zoom.mfp-removing.mfp-bg {
	opacity: 0;
}



/* padding-bottom and top for image */
.mfp-no-margins img.mfp-img {
	padding: 0;
}
/* position of shadow behind the image */
.mfp-no-margins .mfp-figure:after {
	top: 0;
	bottom: 0;
}
/* padding for main container */
.mfp-no-margins .mfp-container {
	padding: 0;
}



/* aligns caption to center */
.mfp-title {
  text-align: center;
  padding: 6px 0;
}
.image-source-link {
  color: #DDD;
}


body { -webkit-backface-visibility: hidden; padding: 10px 30px; 
  font-family: "Calibri", "Trebuchet MS", "Helvetica", sans-serif;
}
</style>  
<!--------banner section------->
<div class="sgn_bnerview">
     <?= $this->Flash->render() ?>    
    <!--img src="<?php echo $this->request->webroot; ?>images/website/detil_bnr.jpg"-->
   
</div>
<!-----------category_details--------------->
<div class="slvr_rng">
    <div class="container">
        <div class="row">
            <div class="rng_cvr">
                <div class="col-sm-3">
                    <div class="stne_pic">
                             <?php if($product['image']){ ?>       
                             <a href="<?php echo $this->request->webroot."images/products/".$product['image']; ?>" class="without-caption image-link"><img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>"></a>
                             <?php }else{ ?>
                            <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>">
                             <?php } ?>
                      
                    </div>

                    <div class="dtl_smple">
                        <ul>
                            <?php if(!empty($product['galleries'])){
                                foreach($product['galleries'] as $k =>$gallery)
                                    {
                                  if($k == 5)  { 
                                      break;
                                  }
                                ?>
                            <li>
                                <div class="smpl_pic">      
                                    <a href="<?php echo $this->request->webroot."images/gallery/".$gallery['image']; ?>" class="without-caption image-link"><img src="<?php echo $this->request->webroot."images/gallery/".$gallery['image']; ?>"></a>
                                </div>
                            </li>
                            <?php } } ?>  
                        </ul>
                    </div>    
                </div>

                <div class="col-sm-9">
                    <div class="ylw_txt">
                        <h3><?php if(isset($product['name'])){ echo $product['name'];} ?></h3>
                    </div>
                    <div class="buyr_st">  
                        <ul>
                            
                            <?php 
                               $avg = 0;
                                 $avgRating = 0;
                            if(!empty($product['reviews'])){   
                                $reviewcount = count($product['reviews']);  
                              
                             foreach($product['reviews'] as $rt){

                                   $avg += $rt['rating'];

                                    }

                                  $rate1 = $reviewcount?$reviewcount:1;
                                    $avgRating = $avg/$rate1; 
                            }
                            ?>
                                    <?php
                                     $i= round($avgRating);
                                        
                                        for($j=0;$j<$i;$j++){
                                        ?>
                                      <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        
                                 
                                        <?php } for($h=0;$h<5-$i;$h++){?>  
                                         
                                         <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                        <?php 
                                        
                                        } 
			                    ?> 
                             <li>(<?php echo count($product['reviews']); ?>)</li> 
                            <?php if(!$loggeduser){ ?>   
                            <li><a class="gap_buyr" href="<?php echo $this->request->webroot ?>users/login">Buyer's Add A Review</a></li>  
                            <?php }else{ ?>
                            <li><a class="gap_buyr" href="#" data-toggle="modal" data-target="#myModal">Buyer's Add A Review</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="desc_dtl">
                        <h3>Description</h3>
                       <?php if(isset($product['description'])){ echo $product['description'];} ?>
                    </div>  

                    <div class="desc_prc">
                        <h3>$<?php if(isset($product['price'])){ echo $product['price'];} ?></h3>
                    </div>  

                    <div class="cont_dnm">
                        <span class="countdw" >
                            <div class="label">Countdown:</div>
                        </span>
                        <span class="countnmbr" >
                            <div class="label_desc">Hurry, only <?php if(isset($product['quantity'])){ echo $product['quantity'];} ?> left!</div>
                        </span> 
                    </div>   

                    <div class="qty_bnt">
                         <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'products', 'action' => 'addtocart'))); ?> 
                        <div class="col-sm-3" style="padding: 0px;">
                            <div class="qty_nmbr">
                                <span>QTY</span>

                                <div class="input-group spinner">
                               <?php echo $this->Form->control('quantity', array('type' => 'number', 'value' => '1','class'=>'form-control','label'=>false,'min'=>'1')); ?> 
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9" style="padding: 0px;">
                            <div class="btn_crd">
                                <?php echo $this->Form->control('seller_id', array('type' => 'hidden', 'value' => $product['user_id'])); ?>  
                                <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $product['id'])); ?>           
                                <?php echo $this->Form->button('Add to Cart', array('class' => 'btn btn-success scss_grn','id' => $product['id']));?>
                               
                                
                            </div>
                        </div>
                         <?php echo $this->Form->end(); ?>
                    </div>       
                </div> 
            </div>
        </div>
    </div>
</div>
<!--------reviews------------>
<div class="revew_nce">
    <div class="container">
        <div class="row">
          <?php 
                if(!empty($product['reviews'])){   
                    $reviewcount = count($product['reviews']);  

            ?>   
            
            <div class="headng_rvw">
                <h3>All Reviews</h3>  
                <span class="number_rvw"><?php if(isset($product['ava_rating'])) { echo $product['ava_rating']; } ?><i class="fa fa-star" aria-hidden="true"></i></span>
            </div>
            <div class="cvr_prdct">
                
                <?php 
                      foreach($product['reviews'] as $rt){
                ?>
                <div class="col-sm-12">
                    <div class="list_really">
                        <ul>
                            <li>
                                <div class="alpha_lst">
                                    <span><?php if(isset($rt['rating'])){ echo $rt['rating']; } ?></span> 
                                    <div class="view_pple">  
                                        <h3><?php if(isset($rt['user']['name'])){ echo $rt['user']['name']; } ?></h3>
                                        <p><?php if(isset($rt['text'])){ echo $rt['text']; } ?></p> 
                                    </div>  
                                </div>
                            </li>
                            <li></li>
                        </ul>


                    </div>
                </div>
                
                      <?php } ?>  

            </div>
            
          <?php } ?>  
        </div>
    </div>
</div>
  

 <!---------------pop-up-start------------->
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <form action="<?php echo $this->request->webroot;?>products/savereview" method="post" class="reviw_from">    
        <div class="modal-header">  
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title cntr_ttle">Rating</h4>
        </div>
        <div class="modal-body">  
        <div class="str_mogo">
            <div class="col-sm-12">
                       <div class="star-reviw">
                        <div class="stars rating" id="rating"> 
                          <span class="fa fa-star"></span> 
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>        
                          <input type="hidden" name="ava_rating" value="<?php echo $product['ava_rating']; ?>">  
                          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">  
                          <input type="hidden" name="server" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                          <input type="hidden" name="punctuality" id="ratings1" value="" required>  
                       </div>     

                       </div>
            </div>
          </div>  
          <textarea class="form-control" name="text"  rows="2"></textarea>  
          
        </div>
        <div class="modal-footer">  
           <button type="submit" class="btn btn-success cntr_grn sve_lf">Save</button>
        </div> 
      </form>      
      </div>
      
    </div>
  </div>
    
  <script>
      jQuery('.rating span').each(function(){

    jQuery(this).click(function(){
        if(!jQuery(this).hasClass('checked')){
            jQuery(this).addClass('checked');
            jQuery(this).prevAll().addClass('checked');
            var rate = jQuery('#rating .checked').length;
        }else{
            jQuery(this).nextAll().removeClass('checked');
            var rate = jQuery('#rating .checked').length;
        }
       
        jQuery('#ratings1').val(rate); 
    });  
});
  </script>    
