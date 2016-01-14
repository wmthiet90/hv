<?php echo $header; ?>
<div class="container custom-container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> news-page news-page-details"><?php echo $content_top; ?>
      <div class="row">
        <div class="<?php echo $class; ?> news-content">
          <h1 class="heading-title"><?php echo $heading_title; ?></h1>
          <div class="created_date center">
            <?php echo $date_added; ?>
          </div>
          <div class="news-description">
            <?php echo $description; ?>  
          </div>
          <div class="social-share-buttons center">
            <div class="addthis_sharing_toolbox"></div>
          </div>
        </div>
      </div>
      <?php if ($articles) { ?>
      <h3 class="sub-heading-title">
        <span><?php echo $text_related; ?></span>
      </h3>
      <div class="row related-news">
        <?php $i = 0; ?>
        <?php foreach ($articles as $article) { ?>
          <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; ?>
            <?php } else { ?>
            <?php $class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; ?>
          <?php } ?>
          <div class="<?php echo $class; ?>">
            <div class="product-thumb transition">
              <div class="image">
                <a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive" />
                </a>
              </div>
              <div class="caption">
                <h4><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></h4>
                <p><?php echo $article['short_description']; ?></p>              
              </div>
            </div>
          </div>
          <?php if (($column_left && $column_right) && ($i % 2 == 0)) { ?>
          <div class="clearfix visible-md visible-sm"></div>
          <?php } elseif (($column_left || $column_right) && ($i % 3 == 0)) { ?>
          <div class="clearfix visible-md"></div>
          <?php } elseif ($i % 4 == 0) { ?>
          <div class="clearfix visible-md"></div>
          <?php } ?>
          <?php $i++; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($tags) { ?>
      <p><?php echo $text_tags; ?>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </p>
      <?php } ?>      
      <?php echo $content_bottom; ?>
    </div>
    <?php //echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
  $(document).ready(function() {
    $('.thumbnails').magnificPopup({
      type:'image',
      delegate: 'a',
      gallery: {
        enabled:true
      }
    });
  });
//--></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5693f5f5b2d34123" async="async"></script>
<?php echo $footer; ?>