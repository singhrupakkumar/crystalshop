<section class="content-header">
    <h1>
    Articles
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php  echo $articles->title; ?></li>
    </ol>
</section>      
   
<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($articles->title) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($articles->id) ?></td>
        </tr>
        <tr>
          <th><?= __('Title') ?></th>
          <td><?= h($articles->title) ?></td>
        </tr>
   
        <tr>   
          <th><?= __('Description') ?></th>      
          <td><?= html_entity_decode($articles->description, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       