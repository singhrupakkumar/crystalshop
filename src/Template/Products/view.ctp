<!--------banner section------->
<div class="sgn_bner">
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
                            <img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>">
                             <?php }else{ ?>
                            <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>">
                             <?php } ?>
                      
                    </div>

                    <div class="dtl_smple">
                        <ul>
                            <li>
                                <div class="smpl_pic">
                                    <img src="<?php echo $this->request->webroot; ?>images/website/stne2.png">
                                </div>
                            </li>

                            <li>
                                <div class="smpl_pic">
                                    <img src="<?php echo $this->request->webroot; ?>images/website/stne2.png">
                                </div>
                            </li>

                            <li>
                                <div class="smpl_pic">
                                    <img src="<?php echo $this->request->webroot; ?>images/website/stne2.png">
                                </div>
                            </li>
                            <li>
                                <div class="smpl_pic">
                                    <img src="<?php echo $this->request->webroot; ?>images/website/stne2.png">
                                </div>
                            </li>

                            <li>
                                <div class="smpl_pic">
                                    <img src="<?php echo $this->request->webroot; ?>images/website/stne2.png">
                                </div>
                            </li>

                        </ul>
                    </div>    
                </div>

                <div class="col-sm-9">
                    <div class="ylw_txt">
                        <h3><?php if(isset($product['name'])){ echo $product['name'];} ?></h3>
                    </div>
                    <div class="buyr_st">
                        <ul>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li>(629)</li>
                            <li><a class="gap_buyr" href="#" data-toggle="modal" data-target="#myModal">Buyer's Add A Review</a></li>
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
                        <div class="col-sm-2" style="padding: 0px;">
                            <div class="label">Countdown:</div>
                        </div>
                        <div class="col-sm-10" style="padding: 0px;">
                            <div class="label_desc">Hurry, only <?php if(isset($product['quantity'])){ echo $product['quantity'];} ?> left!</div>
                        </div>
                    </div>   

                    <div class="qty_bnt">
                         <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'products', 'action' => 'addtocart'))); ?> 
                        <div class="col-sm-4" style="padding: 0px;">
                            <div class="qty_nmbr">
                                <span>QTY</span>

                                <div class="input-group spinner">
                               <?php echo $this->Form->control('quantity', array('type' => 'number', 'value' => '1','class'=>'form-control','label'=>false,'min'=>'1')); ?> 
                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8" style="padding: 0px;">
                            <div class="btn_crd">
                               
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
            <div class="headng_rvw">
                <h3>All Reviews</h3>
                <span class="number_rvw">4<i class="fa fa-star" aria-hidden="true"></i></span>
            </div>
            <div class="cvr_prdct">
                <div class="col-sm-12">
                    <div class="list_really">
                        <ul>
                            <li>
                                <div class="alpha_lst">
                                    <span>2</span>
                                    <div class="view_pple">
                                        <h3>Really Nice</h3>
                                        <p>Yes, the product is very good that my son is learning while playing.</p>
                                    </div>
                                </div>
                            </li>
                            <li></li>
                        </ul>


                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="list_really">
                        <ul>
                            <li>
                                <div class="alpha_lst">
                                    <span>2</span>
                                    <div class="view_pple">
                                        <h3>Really Nice</h3>
                                        <p>Yes, the product is very good that my son is learning while playing.</p>
                                    </div>
                                </div>
                            </li>
                            <li></li>
                        </ul>


                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="list_really">
                        <ul>
                            <li>
                                <div class="alpha_lst">
                                    <span>2</span>
                                    <div class="view_pple">
                                        <h3>Really Nice</h3>
                                        <p>Yes, the product is very good that my son is learning while playing.</p>
                                    </div>
                                </div>
                            </li>
                            <li></li>
                        </ul>


                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="list_really">
                        <ul>
                            <li>
                                <div class="alpha_lst">
                                    <span>2</span>
                                    <div class="view_pple">
                                        <h3>Really Nice</h3>
                                        <p>Yes, the product is very good that my son is learning while playing.</p>
                                    </div>
                                </div>
                            </li>
                            <li></li>
                        </ul>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
  

 <!---------------pop-up-start------------->
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title cntr_ttle">Rating</h4>
        </div>
        <div class="modal-body">
        <div class="str_mogo">
          <ul>
          <li><i class="fa fa-star" aria-hidden="true"></i></li>
           <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
             <li><i class="fa fa-star" aria-hidden="true"></i></li>
              <li><i class="fa fa-star" aria-hidden="true"></i></li>
          </ul>
          </div>
          <textarea rows="4" cols="87">
At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies. 
</textarea>
          
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success cntr_grn sve_lf">Save</button>
        </div>
      </div>
      
    </div>
  </div>
