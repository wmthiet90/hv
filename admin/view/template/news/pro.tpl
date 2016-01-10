<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default" onclick="$('#form-article').attr('action', '<?php echo $copy; ?>').submit()"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-article').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> News Pro Comming Soon</h3>
      </div>
      <div class="panel-body">
      	<div class="well">
      		<div class="row">
        		<div class="col-sm-3">News version: 2.1.2</div>
        		<div class="col-sm-3">Update: 26/12/2015 Lasted</div>
        	</div>
      	</div>
        <div class="well">
          <div class="row">
          	<div class="col-sm-6">
          		Featured in Pro:
          		<ul>
          			<li>Author manager</li>
          			<li>Article Set</li>
          			<li>Newsletter</li>
          			<li>Module Slider article</li>
          			<li>More than.....</li>
          		</ul>
          	</div>
          	<div class="col-sm-6">
          		<h1>Comming Soon: 1/2016</h1>
          		<ul>
          			<li>Contact: <a href="mailto:vdhoangson@gmail">vdhoangson@gmail.com</a></li>
          		</ul>
          	</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>