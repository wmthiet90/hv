<div class="block-box featured-box">
  <div class="block-heading">
    <h3 class="block-title"><?php echo $heading_title; ?></h3>
    <p class="block-desc hidden"><?php echo $text_heading_desc; ?> </p>  
  </div>  
  <div class="row product-grid">
    <?php foreach ($products as $product) { ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 product-item">
      <div class="product-thumb transition">
        <div class="image">
          <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="responsive-img" />
            </a>
          </div>
        <div class="caption">
          <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['manufacturer']; ?></a></h4>          
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="center padding-bottom-30">
    <a href="<?php echo $see_all_url; ?>" class="btn btn-main"><?php echo $text_see_all; ?></a>
  </div>
</div>