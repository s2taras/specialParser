<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-161522132-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-161522132-1');
</script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:400,500,600,700" type="text/css" media="all">
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/OPC040_13/stylesheet/TemplateTrip/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="catalog/view/theme/OPC040_13/stylesheet/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/OPC040_13/stylesheet/TemplateTrip/ttblogstyle.css" rel="stylesheet" type="text/css" />
<?php if($direction=='rtl') { ?>
<link href="catalog/view/theme/OPC040_13/stylesheet/TemplateTrip/rtl.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/OPC040_13/stylesheet/TemplateTrip/ttblogstyle-rtl.css" rel="stylesheet" type="text/css" />
<?php } ?>
<link href="catalog/view/theme/OPC040_13/stylesheet/TemplateTrip/lightbox.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<!-- TemplateTrip custom Theme JS -->
<script src="catalog/view/javascript/TemplateTrip/addonScript.js" type="text/javascript"></script>
<script src="catalog/view/javascript/TemplateTrip/lightbox-2.6.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
<div id="page">
<?php if($header_top) { ?>
  <div class="header-top">
	<?php echo $header_top; ?>
  </div>
  <?php } ?>
<header>
	<nav id="top">
	<div class="container">
  	<div class="header-top-left">
		<?php if($header_left) { ?>
	  <div class="header-left-cms">
		  <?php echo $header_left; ?>
	  </div>
	  <?php } ?>
		<!--<div class="phone-number"><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></div>-->
	</div>
	<div class="header-top-right">
	    <div id="top-links" class="nav pull-right">
      <ul class="list-inline">
	  <li><?php echo $language; ?></li>
	  <li><?php echo $currency; ?></li>
       <li>
        <div class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right account-link-toggle">
            <?php if ($logged) { ?>
            <li><a href="<?php echo $account; ?>"><i class='fa fa-user'></i> <?php echo $text_account; ?></a></li>
            <li><a href="<?php echo $order; ?>"><i class='fa fa-calendar'></i> <?php echo $text_order; ?></a></li>
            <li><a href="<?php echo $transaction; ?>"><i class='fa fa-credit-card'></i> <?php echo $text_transaction; ?></a></li>
{*            <li><a href="<?php echo $download; ?>"><i class='fa fa-download'></i> <?php echo $text_download; ?></a></li>*}
            <li><a href="<?php echo $logout; ?>"><i class='fa fa-sign-out'></i> <?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><i class='fa fa-user'></i> <?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><i class='fa fa-sign-in'></i> <?php echo $text_login; ?></a></li>
            <?php } ?>
          </ul>
        </div>
        </li>
		
		<li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
		<!--
        <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
        <li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li>
-->    </ul>
    </div>
	</div>
  </div>
</nav>	
	<div class="full-header">
	<div class="container">
	  <div class="header-left">
	  <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
		</div>
       <div class="header-right">
	  		<?php echo $cart; ?>
	   </div>
	    <?php if($header_right) { ?>
	  <div class="header-right-cms">
		  <?php echo $header_right; ?>
	  </div>
	  <?php } ?>
	  <div class="col-sm-7 header-middle">
	  	<?php echo $search; ?>
      </div>
	
  </div>
  	</div>
  <?php if($header_bottom) { ?>
  <div class="header-bottom">
	<?php echo $header_bottom; ?>
  </div>
  <?php } ?>
</header>
<!--<div class="menu-container">
	
</div>-->