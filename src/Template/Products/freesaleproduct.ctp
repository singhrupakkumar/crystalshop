<?= $this->Html->css( array('docsupport/style.css') ) ?>  
<div class="smart_container">
    <!--------------------Your Order_sec----------------------->
    <div class="ur_ordr_sec">   
        <div class="ur_order">
            <h1>Bonus Product</h1>              
        </div>        
    </div>
  <?= $this->Flash->render() ?>   
    <!----------------bonus_section--------------------->
    <div class="bons_sctn">
        <div class="container">
            <div class="row">
                <div class="hgh_lght">
                    <p>SELL ANY 1 PRODUCT AND GET 100% MONEYBACK. You as a seller can have one product for which you can get 100% of the money. If you have only one of the product then once sold you can choose another product to get 100% of the sale for. As a seller, you also have the option to change the product you want to get 100% of the money when sold. It is always the seller's option to decide which product to be your BONUS product</p>
                </div>

                <div class="ordr_bons">
                                        <?php        if(!empty($userproduct)){ ?>
                    <div class="bons_heading">
                        <h3>Bonus Form</h3>
                    </div>

                    <div class="dumy_form">
                         <?= $this->Form->create(null, array('class'=>'form-horizontal','id' => 'addsaleproduct')) ?>   
                            <div class="col-sm-12">
                                <div class="fm_nmcvr">
                                    <div class="form-group">
                    
                                        <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="2" name="saleproduct" required="required">
                                                
                                            <option value=" ">Choose Product</option>
                                            <?php  
                                            foreach($userproduct as $prod){?>  
                                            <option value="<?php echo $prod['id'];?>"><?php echo $prod['name'];?></option>
                                            <?php } ?>
                                        </select>
                                     
                                    </div>    
                                </div>
                            </div>
                            <div class="btn_idst"> 
                                <button type="submit" class="btn btn-success cntr_grn">Update</button>
                            </div>

                         <?= $this->Form->end() ?>  

                    </div>
                     <?php  }else{ echo '<img src="'.$this->request->webroot.'/img/no_product_5.png">'; }  ?>  
                </div> 
            </div>
        </div>
    </div>

</div>    

<script>
    var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : { allow_single_deselect: true },
  '.chosen-select-no-single' : { disable_search_threshold: 10 },
  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.chosen-select-rtl'       : { rtl: true },
  '.chosen-select-width'     : { width: '95%' }
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
    </script>