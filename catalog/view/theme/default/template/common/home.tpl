<?php echo $header; ?>
<div class="container-fluid" id="home-slides-container">
    <div class="row full-block">
        <div class="col-sm-12">
            <div id="home-slides">
                <div class="slide-item center">
                    <a href="#" class="banner-img">
                        <img src="image/catalog/demo/si01.jpg" alt="">
                    </a>
                    <div class="banner-actions">
                        <a href="#" class="btn btn-main">Chi tiết</a>
                    </div>
                    <div class="banner-description">
                        1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nunc diam, venenatis sit amet nulla et, vulputate sollicitudin ipsum.
                    </div>
                </div>
                <div class="slide-item center">
                    <a href="#" class="banner-img">
                        <img src="image/catalog/demo/si02.jpg" alt="">
                    </a>
                    <div class="banner-actions">
                        <a href="#" class="btn btn-main">Chi tiết</a>
                    </div>
                    <div class="banner-description">
                        2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nunc diam, venenatis sit amet nulla et, vulputate sollicitudin ipsum.
                    </div>
                </div>         
            </div>
            <script>
                $("#home-slides").owlCarousel({
                        autoPlay: true,
                        pagination : true,
                        singleItem: true,
                        navigation: false,
                        stopOnHover: true,
                        slideSpeed : 800,
                        rewindSpeed : 1000
                });
            </script>
        </div>
    </div> 
</div>
<div class="container-fluid" id="brand-logos-container">
    <div class="row full-block">
        <div class="col-sm-12">
            <div class="container">
                <div id="brand-logos">
                    <a href="#"><img src="image/catalog/demo/imglist01.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist02.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist03.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist04.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist05.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist06.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist07.jpg" alt=""></a>
                    <a href="#"><img src="image/catalog/demo/imglist08.jpg" alt=""></a>
                </div>
            </div>            
            <script>
                $("#brand-logos").owlCarousel({
                    items: 4,
                    pagination : false,
                    autoPlay: false,
                    singleItem: false,
                    navigation: true,
                    stopOnHover: true,
                    navigationText: ['<span class="fa fa-angle-left fa-3x"></span>', '<span class="fa fa-angle-right fa-3x"></span>']
                });
            </script>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div id="content" class="col-sm-12">
            <?php echo $content_top; ?>
            <?php echo $content_bottom; ?>
        </div>
    </div>
</div>
<?php echo $footer; ?>