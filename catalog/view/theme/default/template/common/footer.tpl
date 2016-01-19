<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="company-info">
          <h2 class="uppercase">Công ty TNHH Hóa Việt</h2>
          <p class="info">
            <span><?php echo $text_headoffice; ?>:</span> 229 - 231 Lê Cao Lãng, P. Phú Thạnh, Q. Tân Phú, TP.HCM
          </p>
          <div class="info-phones">
            <p class="info">
              <span>t:</span> + (84) 8 39 789 666
            </p>
            <p class="info">
              <span>t:</span> + (84) 8 39 789 777
            </p>
            <p class="info">
              <span>t:</span> + (84) 8 39 789 888
            </p>
          </div>          
          <p class="info">
            <span>f:</span> + (84) 8 39 789 555
          </p>
          <p class="info">
            <span>e:</span> <a href="mailto: hoaviet@hoaviet.vn">hoaviet@hoaviet.vn</a>
          </p>
          <div class="info social-links">            
            <a class="social-icon facebook" href="#"><i class="fa fa-facebook"></i></a>
            <a class="social-icon twiter" href="#"><i class="fa fa-twitter"></i></a>
            <a class="social-icon googleplus" href="#"><i class="fa fa-google-plus"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="map-info">
          <div class="map-wrapper" style="width: 100%; margin-top: 23px;">
             <iframe src="map.html" width="100%" height="270" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="map-info">
            <a class="invisible" name="contact"></a>
            <h3 class="uppercase"><?php echo $text_contact; ?></h3>
            <form role="form">
              <div class="form-group">
                <input placeholder="<?php echo $text_contact_name; ?>" type="text" class="form-control" id="contactName">
              </div>
              <div class="form-group">
                <input placeholder="<?php echo $text_contact_email; ?>" type="email" class="form-control" id="contactEmail">
              </div>
              <div class="form-group">
                <input placeholder="<?php echo $text_contact_topic; ?>" type="text" class="form-control" id="contactTopic">
              </div>
              <div class="form-group">
                <textarea placeholder="<?php echo $text_contact_message; ?>" id="contactMessage" class="form-control no-resize-hon" style="min-height: 80px;"></textarea>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-default btn-smaller"><?php echo $text_send; ?></button>
              </div>              
            </form>
          </div>
      </div>
    </div>    
  </div>
</footer>
<div class="fluid-container">
  <div class="footer-links">
    <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <a href="<?php echo $home_url; ?>"><?php echo $text_home; ?></a> | 
            <a href="<?php echo $introduction_url; ?>"><?php echo $text_introduction; ?></a> | 
            <a href="<?php echo $product_url; ?>"><?php echo $text_product; ?></a> | 
            <a href="<?php echo $news_url; ?>"><?php echo $text_newsevent; ?></a> | 
            <a href="<?php echo $download_url; ?>"><?php echo $text_downloads; ?></a> | 
            <a href="<?php echo $jobs_url; ?>"><?php echo $text_job; ?></a> | 
            <a href="<?php echo $contact_url; ?>"><?php echo $text_contact; ?></a> 
          </div>          
        </div>
        <div class="row">
          <div class="col-sm-12">
            <?php echo $powered; ?>
          </div>
        </div>
    </div>      
  </div>
</div>
<script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",34183]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
</body></html>