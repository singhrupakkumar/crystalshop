<!--------banner section------->
<div class="banner_ctrgy">
    <img src="<?php echo $this->request->webroot; ?>images/website/ctgry_bngle.jpg">
    <div class="bnr_txt">
        <h3><?php if(isset($cat['name'])){ echo $cat['name']; } ?></h3> 
    </div>
</div>
<!-----------category_lst--------------->
<div class="categry_sction">
    <div class="container">
        <div class="row">
            <div class="slidr_heading">
                <h4><?php if(isset($cat['name'])){ echo $cat['name']; } ?> Products</h4>
            </div>
            
             <div class="col-sm-4">
                <div class="rfne_txt">
                    <h4>Refine your search</h4>
                </div>
                <div class="by_heding">
                    <span>By Seller</span>
                </div>
                <div class="srch_fm">
                    <form action="#">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                <div class="cate_sctin">
                    <div class="by_heding">
                        <span>Categories</span>
                    </div>
                    <ul>
                        <li>
                            <span class="arw_frst">
                                <img src="<?php echo $this->request->webroot; ?>images/website/arrow_rght.png">
                                <h3>Jewellery</h3>
                                <h5>(23)</h5>
                            </span> 
                        </li>

                        <li>
                            <span class="arw_frst">
                                <img src="<?php echo $this->request->webroot; ?>images/website/arrow_rght.png">
                                <h3>Jewellery</h3>
                                <h5>(23)</h5>
                            </span>
                        </li>
                        <li>
                            <span class="arw_frst">
                                <img src="<?php echo $this->request->webroot; ?>images/website/arrow_rght.png">
                                <h3>Jewellery</h3>
                                <h5>(23)</h5>
                            </span>
                        </li>
                        <li>
                            <span class="arw_frst">
                                <img src="<?php echo $this->request->webroot; ?>images/website/arrow_rght.png">
                                <h3>Jewellery</h3>
                                <h5>(23)</h5>
                            </span>
                        </li>
                    </ul>
                </div>  
            </div>
           
            <div class="col-sm-8">
                <div class="borx_txt">
                    <h4><span class="numbr_text"><?php if(!empty($products)){ echo count($products); } ?></span> Results</h4>
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
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li>(629)</li>
                                    </ul>
                                    <div class="btn_sell1">   
                                    <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'products', 'action' => 'addtocart'))); ?> 
                                    <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $item['id'])); ?>       
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




