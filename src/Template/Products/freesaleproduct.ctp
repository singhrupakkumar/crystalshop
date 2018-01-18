<?= $this->Html->css( array('docsupport/style.css') ) ?>  
<div class="smart_container">
 <?= $this->Flash->render() ?>  
    <!--------------------Your Order_sec----------------------->
    <div class="ur_ordr_sec">   
        <div class="ur_order">
            <h1>Bonus Product</h1>              
        </div>        
    </div>
  
    <!----------------bonus_section--------------------->
    <div class="bons_sctn">
        <div class="container">
            <div class="row">
                <div class="hgh_lght">
                    <p>SELL ANY 1 PRODUCT AND GET 100% MONEYBACK. You as a seller can have one product for which you can get 100% of the money. If you have only one of the product then once sold you can choose another product to get 100% of the sale for. As a seller, you also have the option to change the product you want to get 100% of the money when sold. It is always the seller's option to decide which product to be your BONUS product</p>
                </div>
                
            <section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box ">
  <!-- /.box-header -->
  <?php if(!empty($bonus)){ ?>
  

  
  
    <div class="col-sm-12">
	<div class="row">
  <div class="box-body no-padding">
    <table class="table table-condensed freesaleproducttbl">
	<thead>
		<tr>
			<th><?= __('Image') ?></th>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Quantity') ?></th>
			<th><?= __('Category') ?></th>
			<th><?= __('Seller Name') ?></th>
			<th><?= __('Description') ?></th>
			
		</tr>
		
	</thead>
      <tbody>
        <tr>

          
            <td><?= $this->Number->format($bonus->id) ?></td>
			<td>
               <?php if($bonus['image']){ ?>  
                    <img src="<?php echo $this->request->webroot."images/products/".$bonus['image']; ?>" width="50">
                     <?php }else{ ?>
                    <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" width="50">
                     <?php } ?> 
          </td>

          <td><?= h($bonus->name) ?></td>
   
     
         
          <td><?= h($bonus->price) ?></td>
  
     
          
          <td><?= h($bonus->quantity) ?></td>
       
     
         
          <td><?= h($bonus->category->name) ?></td>
 
    
       
         
          <td><?= h($bonus->user->name) ?></td>

   
        
        
    
  
        
          <td>
                       <?php  
                                        $string = strip_tags($bonus->description);
                                        if (strlen($string) > 20) {    
                                            $stringCut = substr($string, 0, 20);
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.$this->request->webroot.'products/view/'.$bonus->slug.'" class="read_lst">Read More</a>'; 
                                        }
                                        ?>
                     
                     
              <?php if(isset($string)){ echo $string; } ?>         
          </td>

 
        
       

        
          
        </tr>
       

     
      </tbody>
    </table>
  </div>
  </div>
   </div>
  <?php }else{ 
      
      echo '<div class="col-sm-12"><div class="blankimg"><img src="'.$this->request->webroot.'/img/no_product_5.png" class="img-responsive"></div></div>';
      ?>
  <?php } ?>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>  


                <div class="ordr_bons">
                                        <?php        if(!empty($userproduct)){ ?>
                    <div class="bons_heading">
                        <h3>Choose any one of your product as BONUS</h3>
                    </div>

                    <div class="dumy_form">
                         <?= $this->Form->create(null, array('class'=>'form-horizontal','id' => 'addsaleproduct')) ?>   
                            <div class="col-sm-12">
                                <div class="fm_nmcvr">
                                    <div class="form-group">
                    
                                        <select data-placeholder="Choose a Country..." class="chosen-select" tabindex="2" name="saleproduct" required="required">
                                                
                                            <option value="">Choose Product</option>  
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

<script type="text/javascript">
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