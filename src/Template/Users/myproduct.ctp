<div class="chk_section">
    <div class="container">
        <div class="row">
            <div class="my_thm">
                <div class="my_hder">
                    <h3>My Product</h3>   
                </div>

                <!-----pro-table-------->               
                <div class="table_prodct">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($userdata)){
                                
                             foreach($userdata['products'] as $product){    
                            ?>
                            <tr>
                                <td data-label="Title" class="ttl_pnh">
                                    <div class="mypr_pic">
                                        <?php if($product['image']){ ?>  
                                        <img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>">
                                         <?php }else{ ?> 
                                        <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>">
                                         <?php } ?> 
                                    </div>
                                    <div class="mypr_txt">
                                        <h4><?php if(isset($product['name'])){ echo $product['name']; } ?></h4>
                                        <p><?php if(isset($product['description'])){ echo $product['description']; } ?></p> 
                                    </div>



                                </td>
                                <td data-label="QTY"><?php if(isset($product['quantity'])){ echo $product['quantity']; } ?></td>
                                <td data-label="Price">$<?php if(isset($product['price'])){ echo $product['price']; } ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(
                                         '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                                         ['controller'=>'products','action' => 'view', $product->id],
                                         ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                                     ) ?>  
                                     <?= $this->Html->link(
                                         '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                                         ['controller'=>'products','action' => 'edit', $product->id],
                                         ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                                     ) ?>


                                     <?= $this->Form->postLink(__('Delete'), ['controller'=>'products','action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id),'class' => 'btn btn-danger btn-xs']) ?>
                                 </td>
                            </tr>
                            <?php } } ?>      
                        </tbody>  
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>