<section class="content-header">
    <h1>
    Articles
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Articles</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Articles</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($articles, ['id' => 'page-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                   <?php 
                              echo $this->Form->control('cat_id', ['options' => $categories, 'empty' => true,'class' => 'form-control', 'label' => false]);   ?> 
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false]); ?> 
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div> 
                 
                <div class="form-group">
                  <label for="keyword">Keyword</label>
                  <?php echo $this->Form->control('keyword', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div> 
                  
                <div class="form-group">
                  <label for="outboundlink">Outbound Link1</label>
                  <?php echo $this->Form->control('outboundlink', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div> 
                
                <div class="form-group">
                  <label for="linkingtext">Linking Text1</label>
                  <?php echo $this->Form->control('linkingtext', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div> 
                  
                 <div class="form-group">  
                  <label for="outboundlink">Outbound Link2</label>
                  <?php echo $this->Form->control('outboundlink2', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div> 
                
                <div class="form-group">
                  <label for="linkingtext">Linking Text2</label>
                  <?php echo $this->Form->control('linkingtext2', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div>   
                  
                <div class="form-group">
                  <label for="author">Author</label>  
                  <?php echo $this->Form->control('author', ['class' => 'form-control', 'label' => false, 'contenteditable' => false]); ?>
                </div>   
                  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 

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