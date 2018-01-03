<section class="content-header">
    <h1>
   <?= __('Product Gallery') ?>  
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= __('Add Gallery') ?></li>
    </ol>
</section>

<section class="content">
        <?php echo $this->Flash->render(); ?>
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Gallery') ?></h3> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create(null, ['id' => 'product-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body"> 
                <div class="form-group">
                    <label>Image</label>
                  <?php echo $this->Form->control('image[]',['class' => 'form-control','type'=>'file','multiple'=>'multiple','label'=>false]);?>
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



