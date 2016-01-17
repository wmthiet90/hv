<?php echo $header; ?>
<div class="container-fluid">
    <div class="row full-block">
        <div class="col-sm-12 top-banner">
            <img src="image/catalog/banners/about_banner.jpg" class="responsive-img" alt="About HoaViet">
        </div>
    </div>
</div>
<div class="container custom-container">
    <div class="row">
        <div id="content" class="col-sm-12 about-page">            
            <div class="line-20"></div>
            <!-- Start About us content -->
            <div class="content-block">
                <h1 class="heading-title"><?php echo $text_aboutus; ?></h1>
                <div class="content">
                    <?php echo $description; ?>       
                </div>
            </div>            
            <!-- End About us content -->
            <?php echo $content_top; ?>            
            <?php echo $content_bottom; ?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row full-block">
        <div class="col-sm-12">
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
<div class="line-20"></div>
<?php echo $footer; ?>