<?php echo $header; ?>
<div class="container custom-container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> product-page product-details-page">
      <?php echo $content_top; ?>
      <h1 class="heading-title"><?php echo $heading_title; ?></h1>
      <div class="row">
        <div class="col-sm-12">
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
        </div>
      </div>
      <p class="hidden">
        <label class="checkbox-inline">
          <?php if ($description) { ?>
          <input type="checkbox" name="description" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="description" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?></label>
      </p>
      <div class="text-center padding-top-30">
        <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary" />
      </div>      
      <h3 class="sub-heading-title">
        <span><?php echo $text_search; ?></span>
      </h3>
      <div class="products-box">
        <?php if ($products) { ?>
          <div class="row product-grid">
            <?php foreach ($products as $product) { ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-item">
              <div class="product-thumb transition">
                <div class="image">
                  <a href="<?php echo $product['href']; ?>">
                    <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="responsive-img" />
                    </a>
                </div>
                <div class="caption">
                  <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                </div>
              </div>
            </div>
            <?php } ?> 
          </div>
          <div class="row">
            <div class="col-sm-12 center">
              <?php echo $pagination; ?>
            </div>
          </div>
        <?php } else { ?> 
          <p><?php echo $text_empty; ?></p>
        <?php } ?>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').prop('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');
--></script> 
<?php echo $footer; ?> 