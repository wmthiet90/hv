<ul id="menu">
  <li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i> <span><?php echo $text_dashboard; ?></span></a></li>
  <li id="catalog"><a class="parent"><i class="fa fa-tags fa-fw"></i> <span><?php echo $text_catalog; ?></span></a>
    <ul>
      <li><a href="<?php echo $category; ?>"><?php echo $text_category; ?></a></li>
      <li><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li>
      <li class="hidden"><a href="<?php echo $filter; ?>"><?php echo $text_filter; ?></a></li>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <li class="hidden"><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
    </ul>
  </li>
  <li id="news"><a class="parent"><i class="fa fa-pencil fa-fw"></i> <span><?php echo $text_news; ?></span></a>
    <ul>
      <li><a href="<?php echo $news_category; ?>"><?php echo $category_heading_title; ?></a></li>
      <li><a href="<?php echo $article; ?>"><?php echo $article_heading_title; ?></a></li>
      <li class="hidden"><a href="<?php echo $news_review; ?>"><?php echo $review_heading_title; ?></a></li>
      <li class="hidden"><a class="parent">Module</a>
        <ul>
          <li><a href="<?php echo $news_by_category; ?>">Article by category</a></li>
          <li><a href="<?php echo $news_article_category; ?>">Category</a></li>
          <li><a href="<?php echo $news_carousel; ?>">News Carousel By Category</a></li>
        </ul>
      </li>
      <li class="hidden"><a href="<?php echo $news_setting; ?>"><?php echo $setting_heading_title; ?></a></li>
    </ul>
  </li>
  <li id="system"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span><?php echo $text_system; ?></span></a>
    <ul>
      <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
      <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
      <li class="hidden"><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
      <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
      <li><a class="parent"><?php echo $text_users; ?></a>
        <ul>
          <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
          <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
        </ul>
      </li>
      <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
    </ul>
  </li>
  <li id="tools"><a class="parent"><i class="fa fa-wrench fa-fw"></i> <span><?php echo $text_tools; ?></span></a>
    <ul>
      <li class="hidden"><a href="<?php echo $upload; ?>"><?php echo $text_upload; ?></a></li>
      <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
      <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
    </ul>
  </li>
</ul>
