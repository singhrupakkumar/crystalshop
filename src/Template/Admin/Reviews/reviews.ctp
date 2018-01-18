<style>
.fa.fa-star{color:#ffd203;}
</style>
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
                  <th>By User</th>
                  <th>Rating</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($reviews as $review): ?>
                <tr>
                  <td><?php echo $review['id']; ?></td>
                  <td><?php echo $review['user']['name']; ?> [ID: <?php echo $review['user']['id'] ?>]</td>
                  <td>
                  	<?php for($j = 0; $j < $review['rating']; $j++){ ?>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <?php }
                    $unrated = 5-$review['rating'];
                    ?>
                    <?php for($i=0; $i<$unrated; $i++){ ?>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <?php } ?>
                  </td>
                  <td>
                    <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $review['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-info']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $review['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success']
                    ) ?>
                    <a href="<?php echo $this->request->webroot; ?>admin/reviews/delete/<?php echo $review['id']; ?>" class="btn btn-danger" onclick="if (confirm('Are you sure you want to delete this review?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>By User</th>
                  <th>Rating</th>
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