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
    <div id="content" class="<?php echo $class; ?> news-page news-page-details recruitment-page">
      <?php echo $content_top; ?>
      <div class="row">
        <div class="<?php echo $class; ?> news-content">
          <h1 class="heading-title"><?php echo $heading_title; ?></h1>
          <div class="created_date center hidden">
            <?php echo $date_added; ?>
          </div>
          <div class="news-description">
            <?php echo $description; ?>  
          </div>
          <div class="social-share-buttons center">
            <div class="addthis_sharing_toolbox"></div>
          </div>
          <div class="job-contact-box">
            <?php echo $text_jobcontact; ?>
          </div>
        </div>
      </div>     
      <?php echo $content_bottom; ?>
    </div>
    <?php //echo $column_right; ?></div>
</div>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5693f5f5b2d34123" async="async"></script>
<?php echo $footer; ?>