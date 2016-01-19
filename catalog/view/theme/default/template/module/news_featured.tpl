<div class="block-box featured-box">
  <div class="block-heading">
    <h3 class="block-title"><?php echo $heading_title; ?></h3> 
  </div>  
  <div class="row news-grid">
    <?php foreach ($articles as $article) { ?>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 news-item">
        <div class="news-thumb transition">
          <div class="image">
            <a href="<?php echo $article['href']; ?>">
              <img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" title="<?php echo $article['name']; ?>" class="img-responsive" />
              </a>
          </div>
          <div class="caption">
            <h4><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></h4> 
            <p class="desciption"><?php echo $article['short_description']; ?></p>
          </div>
        </div>
      </div>
    <?php } ?>    
  </div>
  <div class="p-30 center">
    <a href="<?php echo $see_all_url;?>" class="btn btn-main"><?php echo $text_see_all; ?></a>
  </div>
</div>