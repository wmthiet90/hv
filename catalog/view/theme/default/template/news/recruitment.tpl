<?php echo $header; ?>
<div class="container custom-container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="recruitment-page <?php echo $class; ?>">
      <?php echo $content_top; ?>
      <div class="job-box">
        <div class="banner-img">
          <img src="image/catalog/recruitment/hiring.jpg" class="responsive-img" alt="We're hiring">
        </div>
      </div>
      <div class="table job-box">
        <div class="table-cell box-img">
          <img src="image/catalog/recruitment/workinhoaviet.png" alt="Lam viet tai HV">
          <h3 class="uppercase">Làm việc tại Hóa Việt </h3>
        </div>
        <div class="table-cell box-content">
          Công ty TNHH Hóa Việt được thành lập năm 2006. Những năm vừa qua, chúng tôi luôn luôn nỗ lực không ngừng để phát triển và khẳng định uy tín. Hiện nay, công ty chúng tôi cung cấp sản phẩm của hơn 25 nhà cung cấp nổi tiếng trên thế giới như: Mỹ, Đức, Pháp, Ý, Nhật, Thụy Sỹ,… với những thiết bị khoa học, dụng cụ, hóa chất đầy đủ để đáp ứng được nhu cầu ngày càng cao của toàn xã hội trong việc kiểm tra chất lượng sản phẩm, vệ sinh an toàn thực phẩm, vệ sinh y tế, môi trường, nghiên cứu,… <br/>
          Công Ty TNHH Hóa Việt chuyên kinh doanh Thiết Bị - Hóa Chất – Dụng Cụ phòng thí nghiệm trong các lĩnh vực như: Chăn Nuôi – Thủy Sản, Công Nghệ Sinh Học, Thiết Bị - Vật Tư Phòng Thí Nghiệm, Thực Phẩm – Rượu, Bia, Nước Giải Khát, Môi Trường, Dược Phẩm – Y Tế.
        </div>
      </div>      
      <div class="table job-box">
        <div class="table-cell box-img">
          <img src="image/catalog/recruitment/openjobs.png" alt="Vi tri tuyen dung">
          <h3 class="uppercase">Vị trí tuyển dụng </h3>
        </div>
        <div class="table-cell box-content">
          <?php if ($articles) { ?>
            <ul class="list-unstyled job-list">
              <?php $count = 1; ?>
              <?php foreach ($articles as $article) { ?>
              <li class="<?php echo ($count ++ <= 5) ? 'show' : 'hidden' ?>">
                <a href="<?php echo $article['href']; ?>" title="<?php echo $article['name']; ?>">
                  <?php echo $article['name']; ?>
                  <span class="time pull-right"><?php echo $article["date_added"]; ?></span>
                </a>
              </li>
              <?php } ?>
            </ul>
            <div class="right">
              <a class="btn-link btn-link-icon-r showmore-job-list"> Xem tiếp <i class="fa fa-chevron-down"></i></a>
            </div>
          <?php } else { ?>
            <p><?php echo $text_empty; ?></p>
          <?php } ?>
        </div>
      </div>      
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
