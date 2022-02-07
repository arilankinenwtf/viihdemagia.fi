<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main class="news-page" id="main-content">
  <?php
  // Pääkuva
  // tarvitsee uuden attributti määrittelyn concretessa
  if($c->getAttribute('main_image')) {
    $main_image = $c->getAttribute('main_image');
    $main_image = $main_image->getURL(); 
  } else {
    $main_image = '';
  }

  // Pääkuvan alt/kuvausteksti
  // tarvitsee uuden attributti määrittelyn concretessa
  if($c->getAttribute('main_image_desc')) {
    $main_image_desc = $c->getAttribute('main_image_desc');
  } else {
    $main_image_desc = '';
  }

  if($c->getCollectionName()) {
    $title = $c->getCollectionName();
  }

  if($c->getCollectionDescription()) {
    $description = $c->getCollectionDescription();
  }

  if($c->getCollectionDatePublic()) {
    $date = $c->getCollectionDatePublicObject()->format('j.n.Y');
  }
  ?>
  <div class="news-wrapper">
    <div class="news-content container">
      <div class="row">
        <div class="col-sm-12">
          <div class="news-breadcrumbs">
            <?php
            $a = new Area('Breadcrumbs');
            $a->display($c);
            ?>
          </div>
          <div class="news-date">
            <span class="icon icon-small icon-calendar"></span><?php echo $date; ?>
          </div>
          <div class="news-title">
            <h1><?php echo $title; ?></h1>
          </div>
          <span class="ingressi"><?php echo $description; ?></span>
          <?php
          $a = new Area('Main');
          $a->enableGridContainer();
          $a->display($c);
          ?>
        </div>
      </div>
    </div>
    <img class="news-image" alt="<?php echo $main_image_desc; ?>" src="<?php echo $main_image; ?>">
  </div>
  <div class="news-read-more-list">
    <div class="news-read-more-list-title layout--image-bg">
      <h2>Lue lisää</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <?php
          $a = new GlobalArea('News Read More');
          $a->display($c);
          ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
$site = Site::getSite();
$siteLogo = $site->getAttribute('site_logo')->getURL();
$schemaDate = $c->getCollectionDatePublicObject()->format('Y-m-d');
$pageUrl = $c->getCollectionLink();

$schema = [
  "@context" => "https://schema.org",
  "@type" => "Article",
  "mainEntityOfPage" => [
    "@type" => "WebPage",
    "@id" => $pageUrl,
  ],
  "headline" => $title,
  "image" => [
    "@type" => "ImageObject",
    "url" => $main_image,
  ],
  //"author" => [
  //  "@type" => "Person",
  //  "name" => $userName,
  //],
  "publisher" => [
    "@type" => "Organization",
    "name" => Config::get('concrete.site'),
    "logo" => [
      "@type" => "ImageObject",
      "url" => $siteLogo,
    ]
  ],
  "datePublished" => $schemaDate
]
?>

<script type="application/ld+json">
  <?php echo json_encode($schema); ?>
</script>

<?php  $this->inc('elements/footer.php'); ?>
