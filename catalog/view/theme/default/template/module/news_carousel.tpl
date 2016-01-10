<div id="news_carousel<?php echo $module; ?>" class="owl-carousel">
  <?php foreach ($articles as $article) { ?>
  <div class="item text-center">
    <?php if ($article['link']) { ?>
    <a href="<?php echo $article['link']; ?>"><img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" class="img-responsive" /></a>
    <?php } else { ?>
    <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" class="img-responsive" />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#news_carousel<?php echo $module; ?>').owlCarousel({
	items: 6,
	autoPlay: 3000,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: true
});
--></script>