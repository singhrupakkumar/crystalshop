<section class="content-header">
        <?= $this->Flash->render() ?>
    <h1>
   <?= __('Settings') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= __('Shop Settings') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Shop Settings') ?></h3> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create('Settings', ['id' => 'product-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                 <?php 
                 foreach($settings as $setting){
                 echo $this->Form->control($setting['key'],array('class'=>'form-control','label'=>ucwords(str_replace('_', ' ', $setting['key'])),'value'=>$setting['value'])); 
                 }
                 ?>
            
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
          
            </div>
          </div>
           <?= $this->Form->end() ?>   
    </div>
</section> 
<style type="text/css">

	.datetime ,select{
		width: auto; 
    border: none;
    border-radius: 0px;
    background: #fff;
    border: 1px solid #ddd;
    padding: 7px 7px !important;
    color: #777 !important;
    font-size: 16px !important;
    box-shadow: none !important;
    margin: 0px;
	}
</style>
<script>
$('#datepicker').datepicker({
  autoclose: true
})
</script>      

