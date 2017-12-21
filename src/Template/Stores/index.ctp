 <!--------banner section------->
   <div class="banner_sction">
      <?= $this->Flash->render() ?>        
   <img src="<?php echo $this->request->webroot; ?>images/website/sctn.png">
    <div class="btn_sell">
    <button type="button" class="btn btn-success">Sell Your Products</button> 
    	</div>
	</div>

<div class="slidr_section">
   <div class="slidr_heading">
   <h4>Today's Top Seller</h4>
   	</div>
	<div class="container">
    	<div class="row">
        	<div class="slider_cvr">
        <section class="regular slider">
            
      <?php if(!empty($features)){ 
          foreach($features as $product){ 
          ?>      
        <div> 
    <div style="width:174px; height:174px;"> 
       <a href="<?php echo $this->request->webroot."products/view/".$product['slug']; ?>"> 
       <?php if($product['image']){ ?> 
      <img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>" class="ful_lnght">
       <?php }else{ ?>
      <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" class="ful_lnght">
       <?php } ?>
      </a>
       <div class="sld_txt">
      <h5><?php if(isset($product['name'])){ echo $product['name']; } ?></h5> 
       <span>$<?php if(isset($product['price'])){ echo $product['price']; } ?></span>
       <div class="star_lst">
        <ul>
      <li><i class="fa fa-star" aria-hidden="true"></i></li>
       <li><i class="fa fa-star" aria-hidden="true"></i></li>
        <li><i class="fa fa-star" aria-hidden="true"></i></li>
         <li><i class="fa fa-star" aria-hidden="true"></i></li>
          <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li>(629)</li>
      </ul>
      <div class="btn_sell1">   
      <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'products', 'action' => 'addtocart'))); ?> 
      <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $product['id'])); ?>       
      <?php echo $this->Form->button('Buy it Now', array('class' => 'btn btn-success scss_grn','id' => $product['id']));?>
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
   <h4>Shop By Category</h4>
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
           <a href="<?php echo $this->request->webroot."categories"; ?>">See More<i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
          </div>
          
          
        	</div>
    	</div>
	</div>
<!------------recent-section-------------->
<div class="recent_section">
<div class="slidr_heading">
   <h4>Recent Articles</h4>
   <span class="sub_artcle">Lorem ipsum is a dummy text</span>
   	</div>
	<div class="container">
    	<div class="row">
        	<div class="col-sm-12">
            	<div class="detail_recnt">
                	<h4>What Makes a Precious Gem Stone Valuable</h4>
                    <p>If you or your loved one is superstitious, consider the myths and beliefs surrounding gem stones when choosing that special gift for them. It appears there's much more to each precious gem stone than it's clarity and price..�  <a href="#" class="read_lst">Read More</a></p>
                	</div>
            	</div>
                
                <div class="col-sm-12">
            	<div class="detail_recnt">
                	<h4>Lucky Chinese Horoscope Gem Stones: The First Six Chinese Horoscope Gems</h4>
                    <p>When the Chinese heavenly god and the Chinese earth god decided to create Chinese Astrology and associate Chinese horoscope signs with animals of planet earth, they concluded that each Chinese... <a href="#" class="read_lst">Read More</a> </p>
                	</div>
            	</div>
                
                <div class="col-sm-12">
            	<div class="detail_recnt">
                	<h4>Beaded Gem Stone Jewelry - Dare to be Distinctive </h4>
                    <p>When a woman wears jewelry, she does so to complement and accentuate her beauty and to adorn herself with something unique. Beaded gem stone jewelry has the attributes to perform all these functions...  <a href="#" class="read_lst">Read More</a></p>
                	</div>
            	</div>
                
                <div class="col-sm-12">
            	<div class="detail_recnt">
                	<h4>Traditional Monthly and Zodiac Gem Stones</h4>
                    <p>Nobody is completely sure where the tradition of birth gem stones comes from but many biblical scholars and anthropologists seem to think that their original assignments... <a href="#" class="read_lst">Read More</a> </p>
                	</div>
            	</div>
                
                <div class="col-sm-12">
            	<div class="detail_recnt">
                	<h4>Can A Gem Stone Change Fate?</h4>
                    <p>To counteract the adverse affects of vibrations of planets, or to enhance the beneficial planetary vibrations on the human system the occultists advice the use of gem stones...  <a href="#" class="read_lst">Read More</a></p>
                	</div>
            	</div>
                
                 <div class="col-sm-12">
            	<div class="detail_recnt">
                	<h4>How to Care For Gem Stones </h4>
                    <p>Making the investment in quality gem stones is only the first step towards life-long enjoyment of the jewel. Like any other valued item, gems will look better and last longer...  <a href="#" class="read_lst">Read More</a></p>
                	</div>
            	</div>
                <div class="see_txt"> 
           <a href="#">Promote Your Products<i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        	</div> 
    	</div>
	</div>  
<!-----------footer-section-------------->
