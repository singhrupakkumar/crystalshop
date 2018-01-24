<section class="content-header">
    <h1>
    Contacts
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Contact</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Contact</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($contact, ['id' => 'contact-form']) ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false,'readonly']); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false,'readonly']); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Subject</label>
                  <?php echo $this->Form->control('subject', ['class' => 'form-control', 'label' => false,'readonly']); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Message</label>
                  <?php echo $this->Form->control('message', ['type' => 'text', 'class' => 'form-control', 'label' => false,'readonly']); ?>
                </div>
                  
               <div class="form-group">  
                  <label for="exampleInputEmail1">Reply</label>
                  <select name="status" class="form-control">
                    <option value="0" <?php if($contact->status=='0'){ echo "selected"; }?>>NO</option>
                    <option value="1" <?php if($contact->status=='1'){ echo "selected"; }?>>YES</option> 
        
                  </select> 
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
	$("#contact-form").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			subject: "required",
			message: "required",
			reply: "required"
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			subject: "Please enter subject",
			message: "Please fill this field",
			reply: "Please fill this field"		
		}
	});
});
</script>      