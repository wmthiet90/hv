<div class="block-box featured-box">
  <div class="block-heading">
    <h3 class="block-title"><?php echo $heading_title; ?></h3>
    <p class="block-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>  
  </div>  
  <div class="row product-grid">
    <?php foreach ($products as $product) { ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 product-item">
      <div class="product-thumb transition">
        <div class="image">
          <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
            </a>
          </div>
        <div class="caption">
          <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>   
          <div class="separator">
            <i class="fa fa-circle pull-left"></i>
            <div class="line pull-right"></div>
          </div>     
          <p class="desciption"><?php echo $product['description']; ?></p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="p-30 center">
    <a href="#" class="btn btn-main">Xem tất cả</a>
  </div>
</div>

<div class="block-box featured-box">
  <div class="block-heading">
    <h3 class="block-title">Tin tức & Sự kiện</h3> 
  </div>  
  <div class="row news-grid">
    <?php foreach ($products as $product) { ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 news-item">
      <div class="news-thumb transition">
        <div class="image">
          <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
            </a>
          </div>
        <div class="caption">
          <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4> 
          <p class="desciption"><?php echo $product['description']; ?></p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="p-30 center">
    <a href="#" class="btn btn-main">Xem tất cả</a>
  </div>
</div>

