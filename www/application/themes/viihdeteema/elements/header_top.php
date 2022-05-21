<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>" class="<?php if(!$c->isEditMode()) echo "ccm-html";?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
    // Google Fontin "optimaalinen" asennus. Vaihda vain linkki tähän alle:
    $googleFontLink = "https://fonts.googleapis.com/css2?family=Nunito&family=Open+Sans&family=Quattrocento+Sans&family=Readex+Pro:wght@400;700&display=swap";
    ?>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link rel="preload" as="style" href="<?php echo $googleFontLink;?>" />
    <link rel="stylesheet" href="<?php echo $googleFontLink;?>" 
          media="print" onload="this.media='all'" />
    <noscript>
      <link rel="stylesheet" href="<?php echo $googleFontLink;?>" />
    </noscript>
    
    <?php Loader::element('header_required');?>
    <?php
      $ih = Loader::helper('image');
      $siteName = Config::get('concrete.site'); //Gets Name of the site
      $page = Page::getCurrentPage(); 
      $title = $page->getCollectionName(); //Gets the title of the page
      if($page->getAttribute('meta_title')) {
        $metaTitle = $page->getAttribute('meta_title'); //Gets the meta title of the page
      }
      $description = $page->getCollectionDescription(); //Gets the meta description of the page
      $url = $page->getCollectionLink(); //Gets the URL of the page
      
      if($page->getAttribute('main_image')) {
        $thumb = $page->getAttribute('main_image')->getVersion()->getRelativePath();
      } 
      else {
        $thumb = '';
      }
    ?>
    
    <!-- Open Graph -->
    <meta property="fb:app_id" content="966242223397117" />
    <meta property="og:site_name" content="<?php echo $siteName  ?>"/>
    <meta property="og:title" content="<?php if($metaTitle) { echo $metaTitle; } else { echo $title; } ?>"/>
    <meta property="og:description" content="<?php echo $description ?>"/>
    <meta property="og:url" content="<?php echo  $url ?>"/>
    <meta property="og:type" content="website" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo $siteName ?>" />
    <meta name="twitter:description" content="<?php echo $description ?>" />
    <meta name="twitter:url" content="<?php echo  $url ?>" />

    <?php if($thumb): ?>
      <meta property="og:image" content="<?php echo BASE_URL . $thumb; ?>"/>
      <meta name="twitter:image" content="<?php echo BASE_URL . $thumb; ?>" />
    <?php endif; ?>
    
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style')
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle)
        }
    </script>

    <script src="<?php echo $view->getThemePath()?>/js/main.js"></script>
    <script src="<?php echo $view->getThemePath()?>/js/game.js" async></script>
    <script src="<?php echo $view->getThemePath()?>/js/balloon.js" async></script>
    <script src="<?php echo $view->getThemePath()?>/js/lazysizes.min.js" async></script>
    
    

    <link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/bootstrap.min.css">


    <noscript><link rel="stylesheet" href="styles.css"></noscript>
    <?php echo $html->css($view->getStylesheet('main.less'))?>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
<a class="skip-main" href="#main-content">Skip to main content</a>
<div class="<?php echo $c->getPageWrapperClass()?>">
