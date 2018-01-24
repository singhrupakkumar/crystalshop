<section class="content-header">
    <h1>
    Contact Us
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contact Us</li>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($contacts as $contact): ?>  
                <tr>
                  <td><?php echo $contact['id']; ?></td>
                  <td><?php echo $contact['name']; ?></td>
                  <td><?php echo $contact['email']; ?></td>
                  <td><?php echo $contact['status'] != 0 ? '<span class="label label-success">Answered</span>' : '<span class="label label-danger">Not Answered</span>'; ?></td>
                  <!--td>
                   <?php if($contact['status'] == 1){ ?>      
                      <a href="#" class="btn btn-success btn-xs">YES </a> 
                    <?php }else{ ?>
                    <?= $this->Form->postLink(__('NO'), ['action' => 'changestatus', $contact->id], ['confirm' => __('Are you sure you want to change status # {0}?', $contact->id),'class' => 'btn btn-danger btn-xs']) ?>     
                    <?php } ?>
                  </td-->      
                  <td>  
                    <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $contact['id']],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $contact['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                    
                   
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
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