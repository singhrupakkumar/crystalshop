<?php if($ajax != 1): ?>

<?php $this->Html->addCrumb('Search'); ?>

<div class="container">
    
      <div class="col-sm-12">
        <div class="fancy01">
          <h2>Search</h2>
        </div>
          </div>
    
<!--<h1>Search</h1>-->

<br />

<div class="row">

    <div class="container">
<?php echo $this->Form->create('Product', array('type' => 'GET')); ?>

<div class="col-sm-4 col-sm-offset-4">
   


 <div class="search-pg" >
  <div class="form-group">
     <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'value' => $search)); ?>
   <?php echo $this->Form->button('Search', array('div' => false, 'class' => 'btn btn-sm btn-primary black ')); ?>
  </div>

  
</div> 
</div>


<?php echo $this->Form->end(); ?>

        </div>
        
</div>

</div><!--container-->
<br />
<br />

<?php endif; ?>

<?php // echo $this->Html->script('search.js', array('inline' => false)); ?>   

<?php $this->Html->addCrumb($search); ?>

<?php if(!empty($products)) : ?>

 <div class="brod_cvr">
                    
                    <?php if(!empty($products)):
                        foreach($products as $item):
                        ?>
                    <div class="col-sm-3">
                        <div class="cvr_pic">
                            <div class="brd_pic">
                                 <?php if($item['image']){ ?>  
                                <img src="<?php echo $this->request->webroot."images/products/".$item['image']; ?>" class="ful_lnght">
                                 <?php }else{ ?>
                                <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" class="ful_lnght">
                                 <?php } ?>
                            </div>
                            <div class="sld_txt">
                                <h5><?php if(isset($item['name'])){ echo $item['name']; } ?></h5>
                                <span>$<?php if(isset($item['price'])){ echo $item['price']; } ?></span>    
                                <div class="star_lst">
                                   <ul>
                                      <?php 
                               $avg = 0;
                               $avgRating = 0; 
                            if(!empty($item['reviews'])){   
                                $reviewcount = count($item['reviews']);  
                                 
                             foreach($item['reviews'] as $rt){

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
                            <li>(<?php echo count($item['reviews']); ?>)</li>  
                                    </ul>  
                                    <div class="btn_sell1">
                                        <button type="button" class="btn btn-success scss_grn">Buy it Now</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> 
              
                    <?php endforeach; ?>   
                 
                    <?php endif;?>  
                 
 

                </div> 
 
<?php else: ?>

<?php echo '<div class="col-sm-12"><div class="blankimg"><img src="'.$this->request->webroot.'/img/search-not-found.jpg" class="img-responsive"></div></div>';  ?> 

<?php endif; ?>

