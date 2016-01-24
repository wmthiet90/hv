<?php echo $header; ?>
<div class="container custom-container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li> <a href="<?php echo $breadcrumb['href']; ?>"> <?php echo $breadcrumb['text']; ?> </a> </li>
    <?php } ?>
  </ul>
  <div class="row">
    <div id="content" class="col-sm-12 product-page product-details-page">
      <?php echo $content_top; ?>
      <div class="filter-box">
        <select class="js-manufacturers">
          <option value="0"><?php echo $text_select_manufacturer; ?></option>
          <?php if ($manufacturers) { ?>
            <?php foreach ($manufacturers as $manufacturer) { ?>
              <option data-url="<?php echo $manufacturer['href']; ?>" value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?>
              </option>
            <?php } ?> 
          <?php } ?>
        </select>
      </div>
      <div class="products-box">
        <?php if ($manufacturers) { ?>
          <div class="row product-grid">
          <?php foreach ($manufacturers as $manufacturer) { ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product-item">
              <div class="product-thumb transition">
                <div class="image">
                  <a href="<?php echo $manufacturer['href']; ?>">
                    <img src="<?php echo $manufacturer['thumb']; ?>" alt="<?php echo $manufacturer['name']; ?>" title="<?php echo $manufacturer['name']; ?>" class="responsive-img" />
                    </a>
                </div>
                <div class="caption">
                  <a href="<?php echo $manufacturer['href']; ?>"><?php echo $manufacturer['name']; ?></a>
                </div>
              </div>
            </div>
          <?php } ?> 
          </div>
        <?php }else { ?> 
          <p><?php echo $text_empty; ?></p>
        <?php } ?>
      </div>
      <?php echo $content_bottom; ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>