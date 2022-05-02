<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<!-- Etusivulle on hyvä olla oma pohja -->

<main class="main-content home-page" id="main-content">


  <?php
  if($c->getAttribute('main_image')) {
    $main_image = $c->getAttribute('main_image');
    $main_image = $main_image->getURL(); 
  } else {
    $main_image = '';
  }
  ?>
  <div class="header-image" style="background-image: url('<?php echo $main_image; ?>');">
    <div class="header-title">
      <?php
      $a = new Area('Page Header Title');
      $a->setAreaGridMaximumColumns(12);
      $a->display($c);
      ?>
    </div>
  </div>

  <?php
  $a = new Area('Main');
  $a->enableGridContainer();
  $a->display($c);
  ?>

    <div class=content></div>
    <div class="curtainBody">
      <div id="leftCurtain" class="curtainContainer">
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
      </div>
      <div id="rightCurtain" class="curtainContainer">
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
        <div class="unCurtain"></div>
      </div>
    </div>

</main>

<?php
// Hakukoneoptimointiin liittyen structured data määrityksiä
$site = Site::getSite();
$siteOrganization = $site->getAttribute('site_organization');
$siteUrl = BASE_URL;

if ($site->getAttribute('site_logo')) {
  $siteLogo = $site->getAttribute('site_logo')->getURL();
}

$schema = [
  "@context" => "https://schema.org/",
  "@graph" => [
    [
      "@type" => "WebSite",
      "@id" => $siteUrl . "/#website",
      "name" => Config::get('concrete.site'),
      "url" => $siteUrl,
      "potentialAction" => [
        "@type" => "SearchAction",
        "target" => "/haku?search_paths%5B%5D=&query={search_term_string}&submit=Hae",
        "query-input" => "required name=search_term_string"
      ]
    ],
    [
      "@type" => "Organization",
      "@id" => $siteUrl . "/#organization",
      "name" => $siteOrganization,
      "url" => $siteUrl,
      "logo" => [
        "@type" => "ImageObject",
        "url" => $siteLogo,
      ]
    ]
  ]
]
?>

<script type="application/ld+json">
  <?php echo json_encode($schema); ?>
</script>

<?php  $this->inc('elements/footer.php'); ?>
