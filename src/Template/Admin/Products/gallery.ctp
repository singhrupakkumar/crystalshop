<section class="content-header">
  
    <h1>
    Gallery   <?= $this->Html->link(__('Add Gallery'), ['action' => 'addgallery/'.$productid], ['class' => 'btn btn-warning']) ?>
    <small></small>  
    </h1>

    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gallery</li>
    </ol>
    
     <?php echo $this->Flash->render(); ?>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="gallery" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>

                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                  <?php foreach ($gallery['galleries'] as $image): ?>
                    
                    
            <tr>
  
                <td><?php echo $this->Html->Image("../images/gallery/".$image->image, array('width' => 100, 'height' => 100, 'alt' =>$gallery->name, 'class' => 'image')); ?></td>
                <td><?= h($image->created) ?></td>
                <td class="actions">
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'gallerydelete', $image->id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->id),'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>  
            <?php endforeach; ?>    
                </tbody>
     
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>  
    </div>
</section>  
<script>
    $(document).ready(function() {  
        
    $('#gallery').DataTable();
     });   
</script>