<?php echo $header; ?>
<div class="container-fluid">
    <div class="row full-block">
        <div class="col-sm-12">
            <?php if(!empty($home_slideshow_banners)) { ?>
                <div id="home-slides-container">
                    <div id="home-slides">
                        <?php foreach ($home_slideshow_banners as $banner) { ?>
                            <div class="slide-item center">
                                <?php if ($banner['link']) { ?>
                                    <a href="<?php echo $banner['link']; ?>">
                                        <img class="img-responsive banner-img" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>">
                                    </a>
                                    <div class="banner-description hidden">
                                        <a href="<?php echo $banner['link']; ?>">
                                            <?php echo $banner['title']; ?>
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <img class="img-responsive banner-img" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>">                                
                                    <div class="banner-description hidden">
                                        <?php echo $banner['title']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>         
                    </div>
                    <script>
                        $("#home-slides").owlCarousel({
                                autoPlay: 10000,
                                pagination : true,
                                singleItem: true,
                                navigation: false,
                                stopOnHover: true,
                                slideSpeed : 1000,
                                rewindSpeed : 1000,
                                scrollPerPage: true
                        });
                    </script>
                </div>
            <?php } ?>   
            <?php if(!empty($home_brand_banners)) { ?> 
                <h1 class="heading-title"><?php echo $text_partners; ?></h1>
                <div id="brand-logos-container">                    
                   <div class="container">
                        <div id="brand-logos">
                            <?php foreach ($home_brand_banners as $banner) { ?>
                              <div class="item">
                                <?php if ($banner['link']) { ?>
                                <a href="<?php echo $banner['link']; ?>" target="_blank">
                                    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
                                </a>
                                <?php } else { ?>
                                    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
                                <?php } ?>
                              </div>
                              <?php } ?>
                        </div>
                    </div> 
                    <script>
                        $("#brand-logos").owlCarousel({
                            items: 4,
                            pagination : false,
                            autoPlay: 4000,
                            singleItem: false,
                            navigation: true,
                            stopOnHover: true,
                            navigationText: ['<span class="fa fa-angle-left fa-3x"></span>', '<span class="fa fa-angle-right fa-3x"></span>']
                        });
                    </script>
                </div>
            <?php } ?>
        </div>
    </div> 
</div>
<div class="container">
    <div class="row">
        <div id="content" class="col-sm-12">
            <?php echo $content_top; ?>
            <hr>
            <?php echo $content_bottom; ?>
        </div>
    </div>
</div>
<?php echo $footer; ?>