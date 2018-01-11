<section class="content-header">
    <h1>
    Contacts
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contacts</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($contact->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($contact->id) ?></td>
        </tr>
        <tr>
          <th><?= __('Name') ?></th>
          <td><?= h($contact->name) ?></td>
        </tr>
        <tr>
          <th><?= __('Email') ?></th>
          <td><?= h($contact->email) ?></td>
        </tr>
        <tr>
          <th><?= __('Subject') ?></th>
          <td><?= h($contact->subject) ?></td>
        </tr>
        <tr>
          <th><?= __('Message') ?></th>
          <td><?= $this->Text->autoParagraph(h($contact->message)); ?></td>
        </tr>
        <tr>
          <th><?= __('Reply') ?></th>
          <td><?php if($contact->status ==0){ echo "NO"; }else{  echo "YES"; } ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       