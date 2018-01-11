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

    <div class="center_box">
<?php echo $this->Form->create('Product', array('type' => 'GET')); ?>

<div class="col col-sm-4 col-sm-offset-3">
    <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'value' => $search)); ?>
</div>

<div class="col col-sm-3">
    <?php echo $this->Form->button('Search', array('div' => false, 'class' => 'btn btn-sm btn-primary black')); ?>
</div>

<?php echo $this->Form->end(); ?>

        </div>
        
</div>

</div><!--container-->
<br />
<br />

<?php endif; ?>

<?php // echo $this->Html->script('search.js', array('inline' => false)); ?>

<?php if(!empty($search)) : ?>

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
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li>(629)</li>
                                    </ul>
                                    <div class="btn_sell1">
                                        <button type="button" class="btn btn-success scss_grn">Buy it Now</button>
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

<br />
<br />
<br />

<?php else: ?>

<h3>No Results</h3>

<?php endif; ?>
<?php endif; ?>

