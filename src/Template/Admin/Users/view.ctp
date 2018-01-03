<section class="content-header">
    <h1>
    Users
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
    <h3 class="box-title"><?= h($user->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <?php if($user->name){ ?>
        <tr>
          <th><?= __('Name') ?></th>
          <td><?= h($user->name) ?></td>
        </tr>
        <?php } ?>
        <?php if($user->email){ ?>
        <tr>
          <th><?= __('Email') ?></th>
          <td><?= h($user->email) ?></td>
        </tr>
        <?php } ?> 
        <?php if($user->phone){ ?>
        <tr>
          <th><?= __('Phone') ?></th>
          <td><?= h($user->phone) ?></td>
        </tr>
         <?php } ?>
        <?php if($user->gender){ ?>
        <tr>
          <th><?= __('Gender') ?></th>
          <td><?= h($user->gender) ?></td>
        </tr>
         <?php } ?>
        <?php if($user->dob){ ?>
        <tr>
          <th><?= __('Dob') ?></th>
          <td><?= h($user->dob) ?></td>
        </tr>
        <?php } ?>
        <?php if($user->country){ ?>
        <tr>
          <th><?= __('Country') ?></th>
          <td><?= h($user->country) ?></td>
        </tr>
         <?php } ?>
        <?php if($user->image){ ?>
        <tr>
          <th><?= __('Image') ?></th>
          <td>
            <?php if($user->image != ''){ ?>
            <img src="<?php echo $this->request->webroot; ?>images/users/<?php echo $user->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/users/noimage.png" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
         <?php } ?>

     
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       