<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title_for_layout; ?></title>
          <?= $this->Html->css(array('custom/bootstrap.min.css', 'custom/font-awesome.min.css')) ?>
  <?= $this->Html->script(array('jquery.min.js', 'jquery-ui.min.js', 'bootstrap.min.js' )) ?>
  
    </head>
    <body  style="background:url('./images/admin-bg.png') no-repeat top center ;  background-size:cover;">
<?= $this->Flash->render() ?> 
<div class="container clearfix">
<?= $this->fetch('content') ?>
</div>

 </body>
</html>