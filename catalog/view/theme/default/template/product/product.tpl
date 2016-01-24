<?php echo $header; ?>
<div class="container custom-container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12 product-page product-details-page">
      <?php echo $content_top; ?>
      <div class="row">
        <div class="col-md-5 col-xs-12">
          <?php if ($thumb) { ?>
          <ul class="thumbnails">
            <?php if ($thumb) { ?>
            <li>
              <a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
              </a>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </div>
        <div class="col-md-7 col-xs-12">
          <h2 class="heading-title"><?php echo $heading_title; ?></h2>
          <ul class="list-unstyled product-info">
            <li><?php echo $text_model; ?> <?php echo $model; ?></li>
            <?php if ($manufacturer) { ?>
            <li>
              <?php echo $text_manufacturer; ?> 
              <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a>
            </li>
            <?php } ?>            
          </ul>          
          <div class="product-description">
            <?php echo $description; ?>
          </div>
        </div>
      </div>
      <?php if ($products) { ?>
      <h3 class="sub-heading-title">
        <span><?php echo $text_related; ?></span>
      </h3>
      <div class="row related-products">
        <?php $i = 0; ?>
        <?php foreach ($products as $product) { ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
            <?php if ($i % 4 == 0) { ?>
            <div class="clearfix visible-md"></div>
            <?php } ?>
            <?php $i++; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
  	$('.thumbnails').magnificPopup({
  		type:'image',
  		delegate: 'a',
  		gallery: {
  			enabled:true
  		}
  	});
  });
</script> 
<?php echo $footer; ?>
