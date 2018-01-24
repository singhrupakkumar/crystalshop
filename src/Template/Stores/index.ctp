 <!--------banner section------->
   <div class="banner_sction">  
         
   <img src="<?php echo $this->request->webroot; ?>images/website/sctn.png">
    <div class="btn_sell">
        <a href="<?php echo $this->request->webroot ?>products/addsellproduct"><button type="button" class="btn btn-success"><?php if(isset($homepages[0]['value'])){ echo $homepages[0]['value']; } ?></button> </a>
    	</div>
		 <?= $this->Flash->render() ?>        
	</div>

<div class="slidr_section">

   <div class="slidr_heading">
   <h4><?php if(isset($homepages[1]['value'])){ echo $homepages[1]['value']; } ?></h4>
   	</div>
	<div class="container">
    	<div class="row">
        	<div class="slider_cvr">
        <section class="regular slider">
            
      <?php if(!empty($features)){ 
          foreach($features as $product){ 
          ?>      
        <div>      

    <div style="width:100%; height:174px; border: 1px solid #bababa;"> 
       <a href="<?php echo $this->request->webroot."products/view/".$product['slug']; ?>"> 
       <?php if($product['image']){ ?> 
      <img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>" class="ful_lnght" title="<?php if(isset($product['name'])){ echo $product['name']; } ?>">
       <?php }else{ ?>
      <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" class="ful_lnght" title="<?php if(isset($product['name'])){ echo $product['name']; } ?>">      
       <?php } ?>
      </a>
       <div class="sld_txt">
      <h5><a href="<?php echo $this->request->webroot."products/view/".$product['slug']; ?>"> <?php if(isset($product['name'])){ echo $product['name']; } ?></a></h5>  
       <span>$<?php if(isset($product['price'])){ echo $product['price']; } ?></span>
       <div class="star_lst">
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
                                  $avgRating = (int)$avg/$rate1; 
                            }
                                    
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
      </ul>
      <div class="btn_sell1">   
      <?php if(isset($homepages[6]['value'])){ $buybtn = $homepages[6]['value']; }else{ $buybtn = "Buy it Now"; } ?>    
      <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'products', 'action' => 'addtocart'))); ?> 
      <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $product['id'])); ?>
      <?php echo $this->Form->control('seller_id', array('type' => 'hidden', 'value' => $product['user_id'])); ?>        
      <?php echo $this->Form->button($buybtn, array('class' => 'btn btn-success scss_grn','id' => $product['id']));?>
      <?php echo $this->Form->end(); ?>
    	</div>
       </div>
    </div>
    </div>
    </div>
      <?php } } ?>
   
    
  </section>
             </div>
        	</div>
    	</div>
</div>
<!------------shop_category-section---------------->
<div class="shop_ctgry">
  <div class="slidr_heading">
   <h4><?php if(isset($homepages[2]['value'])){ echo $homepages[2]['value']; } ?></h4>
   	</div>
	<div class="container">
    	<div class="row">
          <div class="list_ctgry">
          <ul>
              
          <?php if(!empty($categories)){
              
            foreach($categories as $cat){  
          ?>    
          <li><a href="<?php echo $this->request->webroot."products/productbycat/".$cat['slug']; ?>">  
          <div class="cvr_pic">
          <div class="li_pic">
              <?php if($cat['image']){ ?> 
                <img src="<?php echo $this->request->webroot."images/categories/".$cat['image']; ?>" class="ful_lnght">
                 <?php }else{ ?>
                <img src="<?php echo $this->request->webroot."images/categories/no-image.jpg"; ?>" class="ful_lnght">
                <?php } ?>   
          
          </div>
            <span class="text_lst"><?php if(isset($cat['name'])){ echo $cat['name']; } ?></span>
            </div>
          </a></li>
          <?php }} ?>
         
          </ul>
          <div class="see_txt"> 
           <a href="<?php echo $this->request->webroot."categories"; ?>"><?php if(isset($homepages[3]['value'])){ echo $homepages[3]['value']; } ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>  
          </div>
          </div> 
          
          
        	</div>
    	</div>
	</div>
<!------------recent-section-------------->
<div class="recent_section">
<div class="slidr_heading">
   <h4><?php if(isset($homepages[4]['value'])){ echo $homepages[4]['value']; } ?></h4>
   <span class="sub_artcle"></span>
   	</div>
	<div class="container">
    	<div class="row">  
              <?php if(!empty($articles)){
              
                foreach($articles as $article){  
              ?>  
        	<div class="col-sm-12">
            	<div class="detail_recnt">
                        <h4><?php if(isset($article['title'])){ echo $article['title']; } ?></h4>  
                        
                                 <?php  
                                        $string = strip_tags($article['description']);
                                        if (strlen($string) > 170) {     
                                            $stringCut = substr($string, 0, 170);
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.$this->request->webroot.'articles/view/'.$article['id'].'" class="read_lst">Read More</a>'; 
                                        }
                                        ?>
                  <?php if(isset($string)){ echo $string; } ?>      
                	</div>
            	</div>
              <?php } }  ?>        
                
                 
              
                <div class="see_txt">  
                <a href="<?php echo $this->request->webroot; ?>articles/all"><?php if(isset($homepages[5]['value'])){ echo $homepages[5]['value']; } ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
               </div>  
        	</div>     
    	</div>
	</div>  
<!-----------footer-section-------------->
