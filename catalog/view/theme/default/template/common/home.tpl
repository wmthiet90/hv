<?php echo $header; ?>
<div class="container-fluid">
    <div class="row full-block full-banners">
        <div class="col-sm-12" style="padding-left: 0; padding-right: 0;">
            <div id="home-slides">
                <img src="image/catalog/demo/si01.jpg" alt="">
                <img src="image/catalog/demo/si02.jpg" alt="">
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
    <div class="row full-block chat-block">
        <div class="col-sm-12">
            <p>
                Padaf ada fg fdsgfbg sdefdvsaf af afsa fasgfhbghs sdfsefafsd dsfds afsa fsdafsad fsdaf sda
            </p>
            <div class="chat-box">
                dasfa
            </div>
        </div>
    </div>
    <div class="row full-block carousels">
        <div class="col-sm-12">
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
            <script>
                $("#brand-logos").owlCarousel({
                    items: 4,
                    pagination : false,
                    autoPlay: false,
                    singleItem: false,
                    navigation: true,
                    stopOnHover: true
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
<?php echo $footer; ?>