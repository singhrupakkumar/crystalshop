<section class="content-header">
    <h1>
    Users
     <?= $this->Flash->render() ?> 
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
        
       <?php if($user->paypal_email){ ?>
        <tr>
          <th><?= __('Paypal Email') ?></th>
          <td><?= h($user->paypal_email) ?></td>  
        </tr>
        <?php } ?> 
        <?php if($user->phone){ ?>
        <tr>
          <th><?= __('Phone') ?></th>
          <td><?= h($user->phone) ?></td>
        </tr>
         <?php } ?> 
        <?php if($user->address){ ?>
        <tr>
          <th><?= __('Address') ?></th>
          <td><?= h($user->address) ?></td>
        </tr>
         <?php } ?> 
        
        
        <?php if($user->dob){ ?>
        <tr>
          <th><?= __('Dob') ?></th>
          <td><?= h($user->dob) ?></td>
        </tr>
        <?php } ?>
        
       <?php if($user->city){ ?>
        <tr>
          <th><?= __('City') ?></th>
          <td><?= h($user->city) ?></td>
        </tr>
         <?php } ?>
        
         <?php if($user->state){ ?>
        <tr>
          <th><?= __('State') ?></th>
          <td><?= h($user->state) ?></td>
        </tr>
         <?php } ?>
        
        
          <?php if($user->zip){ ?>  
        <tr>
          <th><?= __('Zip') ?></th>
          <td><?= h($user->zip) ?></td>
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
  


<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title">Bonus Product</h3>  
  </div>
  <!-- /.box-header -->
  <?php if(!empty($bonus)){ ?>
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($bonus->id) ?></td>
        </tr>
        <?php if($bonus->name){ ?>
        <tr>
          <th><?= __('Name') ?></th>
          <td><?= h($bonus->name) ?></td>
        </tr>
        <?php } ?>
        <?php if($bonus->price){ ?>
        <tr>
          <th><?= __('Price') ?></th>
          <td><?= h($bonus->price) ?></td>
        </tr>
        <?php } ?> 
        <?php if($bonus->quantity){ ?>
        <tr>
          <th><?= __('Quantity') ?></th>
          <td><?= h($bonus->quantity) ?></td>
        </tr>
         <?php } ?>
        <?php if($bonus->category->name){ ?>
        <tr>
          <th><?= __('Category') ?></th>
          <td><?= h($bonus->category->name) ?></td>
        </tr>
         <?php } ?>
        <?php if($user->name){ ?>
        <tr>
          <th><?= __('Seller Name') ?></th>
          <td><?= h($user->name) ?></td>
        </tr>
        <?php } ?>
        
        <?php if($bonus->image){ ?>
        <tr>
          <th><?= __('Image') ?></th>
          <td>
               <?php if($bonus['image']){ ?>  
                    <img src="<?php echo $this->request->webroot."images/products/".$bonus['image']; ?>" class="ful_lnght" width="80" height="80">
                     <?php }else{ ?>
                    <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" class="ful_lnght" width="80" height="80">
                     <?php } ?> 
          </td>
        </tr>
         <?php } ?>
        <tr>
             <th><?= __('') ?></th>
             <td>
            <?php if($bonus['bonus_disable_admin'] == 1){ ?>     
                       <?= $this->Form->postLink(__('Enable'), ['action' => 'bonusenable', $bonus['id']], ['confirm' => __('Are you sure you want to enable # {0}?', $bonus['id']),'class' => 'btn btn-success btn-xs']) ?>      
                    <?php }else{ ?> 
                    <?= $this->Form->postLink(__('Disable'), ['action' => 'bonusdisable', $bonus['id']], ['confirm' => __('Are you sure you want to disable # {0}?', $bonus['id']),'class' => 'btn btn-danger btn-xs']) ?>     
                    <?php } ?>  
             </td>         
        </tr>
     
      </tbody>
    </table>
  </div>
  <?php }else{ 
      
      echo '<div class="col-sm-12"><div class="blankimg"><img src="'.$this->request->webroot.'/img/no_product_5.png" class="img-responsive"></div></div>';
      ?>
  <?php } ?>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>  


<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title">Products</h3> 
  </div>
  <!-- /.box-header -->
  <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Seller Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                  <?php foreach ($user['products'] as $product): ?>
                    
                    
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>  
                <td><?= h($product->name) ?></td>
                <td><?= h($product->price) ?></td>  
                <td><?= h($product->quantity) ?></td>
                <td><?= h($product->category->name) ?></td>
                <td><?= h($user->name) ?></td> 
                <td>
                     <?php if($product['image']){ ?>  
                    <img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>" class="ful_lnght" width="80" height="80">
                     <?php }else{ ?>
                    <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>" class="ful_lnght" width="80" height="80">
                     <?php } ?>  
                    
                </td>
                <td><?php if($product->status==1){ echo "Active"; }else{ echo "Deactive"; } ?></td>
                <td><?= h($product->created) ?></td>
                <td class="actions">
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $product->id],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?> 
                    <?= $this->Html->link(   
                        __('Gallery'),
                        ['action' => 'gallery', $product->id],
                        ['escape' => false, 'title' => __('Gallery'), 'class' => 'btn btn-warning btn-xs']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $product->id],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?> 
                  
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id),'class' => 'btn btn-danger btn-xs']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
                </tbody>
     
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>   