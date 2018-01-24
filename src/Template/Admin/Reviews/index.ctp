<section class="content-header">
    <h1>
    Reviews
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reviews</li>
    </ol>
</section>
<?php //print_r($trainers); ?>
<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?= $this->Flash->render() ?>
        
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
                  <th>Name</th>
                  <th>Product</th>
                  <th>Reviewer (name)</th>
                  <th>Reviews</th>
                  <th>Rated</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($review as $reviews): ?>
                <tr>
                  <td><?php echo $reviews['id']; ?></td>
                  <td><?php echo $reviews['user']['name']; ?></td>
                  <td><?php echo $reviews['product']['name']; ?></td>
                  <td><?php echo $reviews['product']['user']['name']; ?></td>  
                   <td>
                  <?php echo $reviews['text']; ?>
                  </td>
                  <td><?php echo $reviews['rating']; ?></td>
                 
                  <td>
                    <?= $this->Html->link(  
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View Reviews') . '</span>',
                        ['action' => 'view', $reviews['id']],
                        ['escape' => false, 'title' => __('View Reviews'), 'class' => 'btn btn-info']
                    ) ?>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Reviews</th>
                  <th>Average Rating</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>
    </div>
</section>       