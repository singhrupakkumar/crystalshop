<!-----------category_lst--------------->
<div class="categry_sction">
    <div class="container">
        <div class="row">
            <div class="slidr_heading">
                <h4>All Categories</h4>
            </div>
           
            <div class="col-sm-12">
                <div class="borx_txt">
                    <h4><span class="numbr_text"><?php if(!empty($categories)){ echo count($categories); } ?></span> Results</h4>
                </div>
                <div class="brod_cvr">
                    <div class="list_ctgry">
                        <ul>
                    
                    <?php if(!empty($categories)):
                        foreach($categories as $cat):
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
                            </a>
                             </li> 
    
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
                 

                   </ul>
                    </div>     
                </div> 
            </div>

        </div>
    </div>
</div> 




