<style>
.fa.fa-star{color:#ffd203;}
</style>
<section class="content-header">
    <h1>
    Review And Rating (By: <?php echo $review->user->name; ?>)
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title">By <?= h($review->user->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($review->id) ?></td>
        </tr>
        <tr>
          <th><?= __('Rating') ?></th>
          <td>
            <?php for($j = 0; $j < $review->rating; $j++){ ?>
            <i class="fa fa-star" aria-hidden="true"></i>
            <?php }
            $unrated = 5-$review->rating;
            ?>
            <?php for($i=0; $i<$unrated; $i++){ ?>
            <i class="fa fa-star-o" aria-hidden="true"></i>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <th><?= __('Review') ?></th>
          <td><?= h($review->review) ?></td>
        </tr>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       