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
                    <p><a href="#">Lorem Ipsum</a> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>

                <div class="ordr_bons">
                    <div class="bons_heading">
                        <h3>Bonus Form</h3>
                    </div>

                    <div class="dumy_form">
                         <?= $this->Form->create(null, array('class'=>'form-horizontal','id' => 'addsaleproduct')) ?>   
                            <div class="fm_nmcvr">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="form-control" name="saleproduct">
                                            <?php
                                            if(!empty($userproduct)){
                                            foreach($userproduct as $prod){?>  
                                            <option value="<?php echo $prod['id'];?>"><?php echo $prod['name'];?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>    
                                </div>
                            </div>
                            <div class="btn_idst">
                                <button type="submit" class="btn btn-success cntr_grn">Update</button>
                            </div>

                         <?= $this->Form->end() ?>  

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>    