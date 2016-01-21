<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li> <a href="<?php echo $breadcrumb['href']; ?>"> <?php echo $breadcrumb['text']; ?> </a> </li>
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
    <div id="content" class="<?php echo $class; ?> product-page">
      <?php echo $content_top; ?>
      <div class="filter-box">
        <select class="js-manufacturers">
          <option value="0"><?php echo $text_select_manufacturer; ?></option>
          <?php if ($manufacturers) { ?>
            <?php foreach ($manufacturers as $manufacturer) { ?>
              <?php if($manufacturer["selected"])  { ?>
                <option selected="selected" data-url="<?php echo $manufacturer['href']; ?>" value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?>
                </option>
              <?php } else { ?>
                <option data-url="<?php echo $manufacturer['href']; ?>" value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?>
                </option>
              <?php } ?>
            <?php } ?> 
          <?php } ?>
        </select>
      </div>
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
        <?php }else { ?> 
          <p><?php echo $text_empty; ?></p>
        <?php } ?>
      </div>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>