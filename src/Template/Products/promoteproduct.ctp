
<div class="terms">
    <div class="terms-img">
        <img class="img-responsive" src="<?php echo $this->request->webroot; ?>images/website/policy.png" alt="" border="0">
        <h3>Promote Your Product</h3>
    </div>
</div>

<!------------add_product-section-------------->
<div class="add_pro">
    <div class="add_hding">
        <h3>Add Your Product</h3> 
    </div>
    <div class="container">
        <div class="row">
            <div class="covr_dels">

               <?= $this->Form->create($product) ?>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Title:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Enter title here" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Category:</label>
                        <div class="col-sm-10">          
                            <select class="vov_slct">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="opel">Opel</option>
                                <option value="audi">Audi</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Condition:</label>
                        <div class="col-sm-10">          
                            <select class="con_wth">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="opel">Opel</option>
                                <option value="audi">Audi</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Photos:</label>
                        <div class="col-sm-10">          
                            <span class="up_add">Add upto 6 more photos</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Description:</label>
                        <div class="col-sm-10">          
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Price:</label>
                        <div class="col-sm-10">          
                            <input type="password" class="form-control" id="pwd" placeholder="What text do want to
                                   connect with the above URL" name="pwd">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Author</label>
                        <div class="col-sm-10">          
                            <input type="password" class="form-control" id="pwd" placeholder="Enter author name" name="pwd">
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-success cntr_grn sve_lf">Save</button>
                            <button type="button" class="btn btn-success cntr_grn sve_lf">Cancel</button>
                        </div>
                    </div>
                <?= $this->Form->button(__('Submit')) ?> 
                <?= $this->Form->end() ?>


            </div>
        </div>
    </div>
</div>
