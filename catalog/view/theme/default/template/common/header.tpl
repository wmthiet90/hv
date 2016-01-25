<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/news_stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link href="catalog/view/theme/default/stylesheet/custom.css" rel="stylesheet">
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body class="<?php echo $class; ?>">
<header>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="logo" class="center">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>">
            <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" />
          </a>
          <?php } else { ?>
            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</header>
<div id="menu-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <nav id="menu" class="navbar">
          <div class="navbar-header">
            <span id="category" class="visible-xs">Menu</span>
            <button type="button" class="btn btn-navbar btn-main navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
          </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="<?php echo ($active_menu == 'home' ? 'active': '') ?>"><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a>
              </li>
              <li class="<?php echo ($active_menu == 'about' ? 'active': '') ?>"><a href="<?php echo $about; ?>"><?php echo $text_introduction; ?></a>
              </li>
              <li class="dropdown <?php echo ($active_menu == 'product' ? 'active': '') ?>">
                <a href="<?php echo $product; ?>" class="dropdown-toggle"><?php echo $text_product; ?></a>
                <div class="dropdown-menu hidden">
                  <?php if($manufacturers) { ?>
                  <div class="dropdown-inner sub-product-list">
                    <ul class="list-unstyled">
                      <?php foreach ($manufacturers as $manufacturer) { ?>
                        <li>
                          <a href="<?php echo $manufacturer['href'] ?>"><?php echo $manufacturer['name'] ?></a>
                        </li>                      
                      <?php } ?>
                    </ul>
                  </div>
                  <?php } ?>
                </div>
              </li>
              <li class="dropdown <?php echo ($active_menu == 'news' ? 'active': '') ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $text_newsevent; ?></a>
                <div class="dropdown-menu">
                  <div class="dropdown-inner">
                    <ul class="list-unstyled">
                    <?php foreach ($news_categories as $category) { ?>
                      <?php if ($category['children']) { ?>
                        <li class="dropdown">
                          <a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?>
                          </a>
                          <div class="dropdown-menu">
                            <div class="dropdown-inner">
                              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                                <ul class="list-unstyled">
                                  <?php foreach ($children as $child) { ?>
                                  <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                                  <?php } ?>
                                </ul>
                              <?php } ?>
                            </div>
                            <a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> 
                          </div>
                        </li>
                      <?php } else { ?>
                        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    </ul>
                  </div>
                </div>
              </li>              
              <li class="<?php echo ($active_menu == 'download' ? 'active': '') ?>"><a href="<?php echo $home; ?>"><?php echo $text_downloads; ?></a></li>
              <li class="<?php echo ($active_menu == 'recruitment' ? 'active': '') ?>"><a href="<?php echo $recruitment; ?>"><?php echo $text_job; ?></a>
              </li>
              <li id="gotocontact" class="<?php echo ($active_menu == 'contact' ? 'active': '') ?>"><a href="<?php echo $base; ?>#contact"><?php echo $text_contact; ?></a>
              </li>
            </ul>
          </div>          
        </nav>
        <div class="nav-controls">
          <div class="nav-controls-wrapper">
            <?php echo $search; ?>
            <?php echo $language; ?>    
          </div>            
        </div>
      </div>
    </div>  
  </div>  
</div>

