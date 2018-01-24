<section class="content-header">
    <h1>
    Articles  <?= $this->Html->link(__('Add Articles'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Articles</li>
    </ol>
     <?= $this->Flash->render() ?>
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
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($articles)){
                foreach($articles as $article): ?>
                <tr>
                  <td><?php echo $article['id']; ?></td>
                  <td><?php echo $article['title']; ?></td>
                  <td><?php echo $article['description']; ?></td>
                  <td><?php echo $article['created']; ?></td>
                  <td>
                    <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $article['id']],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $article['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success']
                    ) ?>
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id),'class' => 'btn btn-danger btn-xs']) ?>
                  </td>  
                </tr>  
                <?php endforeach;
                }    
                ?>
                </tbody>
             
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>
    </div>
</section>       