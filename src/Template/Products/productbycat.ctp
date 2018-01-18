<!--------banner section------->
<div class="banner_ctrgy">
     <?= $this->Flash->render() ?>    
    <!--img src="<?php echo $this->request->webroot; ?>images/website/ctgry_bngle.jpg"-->
    <div class="bnr_txt">
        <h3><?php if(isset($cat['name'])){ echo $cat['name']; } ?></h3> 
    </div>
</div>
<!-----------category_lst--------------->
<div class="categry_sction">
    <div class="container">
        <div class="row">
            <div class="slidr_heading">
                <h4><?php if(isset($cat['name'])){ echo $cat['name']; } ?></h4>
                <P><?php if(isset($cat['description'])){ echo $cat['description']; } ?></P>  
            </div>
            
             <div class="col-sm-4">
                <div class="rfne_txt">
                    <h4>REFINE YOUR SEARCH</h4>
                </div>
                <div class="by_heding">
                    <span>By Seller</span>
                </div>
                <div class="srch_fm">
                     <form method="post">
                        <input type="text" name="sellername" placeholder="Search.." value="<?php if(isset($_POST['sellername'])){ echo $_POST['sellername']; }?>" name="search">
                        <button type="submit"><i class="fa fa-search"></i></button> 
                    </form> 
                </div>

                <div class="cate_sctin">
                    <div class="by_heding">
                        <span>Categories</span>
                    </div>
                    <ul>
                         <?php if(!empty($categories)){
                         foreach($categories as $cat){   
                         ?>
                         <li>  
                            <a href="<?php echo $this->request->webroot."products/productbycat/".$cat['slug']; ?>">
                            <span class="arw_frst">
                                <img src="<?php echo $this->request->webroot; ?>images/website/arrow_rght.png">
                                <h3><?php if(isset($cat['name'])){  echo $cat['name']; } ?></h3>
                                <h5>(<?php if(isset($cat['products'])){  echo count($cat['products']); } ?>)</h5> 
                            </span> 
                            </a>
                        </li>  
                        <?php } } ?>    
                    </ul>
                </div>  
            </div>
           
            <div class="col-sm-8">
                <div class="borx_txt">
                    <h4><span class="numbr_text">(<?php if(!empty($products)){ echo count($products); } ?>)</span> Results</h4>
                </div>
                <div class="brod_cvr">
                    
                    <?php if(!empty($products)):
                        foreach($products as $item):
                        ?>
                    <div class="col-sm-3">   
                        <div class="cvr_pic">
                            <a href="<?php echo $this->request->webroot."products/view/".$item['slug']; ?>"> 
                            <div class="brd_pic">
                                 <?php if($item['image']){ ?>   
                                <img src="<?php echo $this->request->webroot."images/products/".$item['image']; ?>" class="ful_lnght">
                                 <?php }else{ ?>
                                <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" class="ful_lnght">
                                 <?php } ?>
                            </div>
                            </a>
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
                                    <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'products', 'action' => 'addtocart'))); ?> 
                                    <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $item['id'])); ?> 
                                    <?php echo $this->Form->control('seller_id', array('type' => 'hidden', 'value' => $item['user_id'])); ?>        
                                    <?php echo $this->Form->button('Buy it Now', array('class' => 'btn btn-success scss_grn','id' => $item['id']));?>
                                    <?php echo $this->Form->end(); ?>
                                     </div>
                                </div>

                            </div>
                        </div>
                    </div>  
                    <?php endforeach; ?> 
                       <div class="paginator col-sm-12">  
                            <ul class="pagination">
                                <?= $this->Paginator->first('<< ' . __('first')) ?>
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                                <?= $this->Paginator->last(__('last') . ' >>') ?>
                            </ul>
                            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                        </div> 
                    <?php endif;?> 
                 

                   

                </div> 
            </div>

        </div>
    </div>
</div> 




