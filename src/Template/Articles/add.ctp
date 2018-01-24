<!--------sign_up_section------->
<div class="frm_sgnup">
    <div class="container">
        <div class="row">
            <div class="slrart_heading">
                <div class="col-sm-12">
             <div class="sign-flash">
              <?= $this->Flash->render() ?>   
              </div>
              </div>   
                <h4>Seller Write An Article</h4>
                <p></p>
            </div> 
            <div class="frm_sgncvr">
                <span class="req_fld">All Fields Are Required</span>

               <?= $this->Form->create($articles, ['id' => 'page-form', 'enctype' => 'multipart/form-data']) ?>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Title</label>
                        <div class="col-sm-10">
                             <?php echo $this->Form->control('title', ['class' => 'form-control','placeholder'=>'Enter title here','label' => false]); ?> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Category</label>
                        <div class="col-sm-10">          
                             <?php 
                              echo $this->Form->control('cat_id', ['options' => $categories, 'empty' => true,'class' => 'form-control', 'label' => false]);   ?>  
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Body</label>
                        <div class="col-sm-10">          
                           <?php echo $this->Form->control('description', ['class' => 'form-control','placeholder'=>'Write an articles between 500 and 800 words','label' => false]); ?> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Keywords</label>
                        <div class="col-sm-10"> 
                             <?php echo $this->Form->control('keyword', ['class' => 'form-control', 'label' => false,'placeholder'=>'Enter keywords separate by comma(,)', 'contenteditable' => false]); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Outbound Link1</label>
                        <div class="col-sm-10">
                          <?php echo $this->Form->control('outboundlink', ['class' => 'form-control','placeholder'=>'Web address for your website, video, etc', 'label' => false, 'contenteditable' => false]); ?>  
                         
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Linking Text1</label>
                        <div class="col-sm-10"> 
                            <?php echo $this->Form->control('linkingtext', ['class' => 'form-control','placeholder'=>'What text do want to connect with the above URL', 'label' => false, 'contenteditable' => false]); ?> 
                        
                        </div>
                    </div>
                
                     <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Outbound Link2</label>
                        <div class="col-sm-10">
                          <?php echo $this->Form->control('outboundlink2', ['class' => 'form-control','placeholder'=>'Web address for your website, video, etc', 'label' => false, 'contenteditable' => false]); ?>  
                         
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Linking Text2</label>   
                        <div class="col-sm-10"> 
                            <?php echo $this->Form->control('linkingtext2', ['class' => 'form-control','placeholder'=>'What text do want to connect with the above URL', 'label' => false, 'contenteditable' => false]); ?> 
                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Author</label>
                        <div class="col-sm-10">
                            
                            <?php 
                            if(isset($loggeduser['name'])){ $uname = $loggeduser['name']; }else{  
                                $uname = '';
                            }    
                            echo $this->Form->control('author', ['class' => 'form-control','placeholder'=>'Enter author name','value'=>$uname ,'label' => false, 'contenteditable' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">  
                            <?= $this->Form->button(__('Submit Article'), ['class' => 'btn btn-success cntr_grn adj_fx']) ?>
                              
                        </div>
                    </div>
                <?= $this->Form->end() ?>   

            </div>
        </div>
    </div>
</div>   
<script>
$().ready(function() {
	$("#page-form").validate({
		rules: {
			title: "required",
			image: {
				required: true,
				extension: "|jpg|jpeg|png",
			},
			description: "required"
		},
		messages: {
			title: "Please enter Title",
			image: {
				required: "Please Select Image First",
				extension: "Only jpg, jpeg and png formats are accepted"
			},
			description: "Please enter Content"	
		}
	});
});
</script>      

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.6/tinymce.min.js"></script>
<script>
tinymce.init({
selector: 'textarea',
plugins: [
"code", "charmap", "link"
],
toolbar: [
"undo redo | styleselect | bold italic | link | alignleft aligncenter alignright | charmap code" | "media"
]
});
</script>