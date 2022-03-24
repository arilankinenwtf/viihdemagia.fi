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

<script>
  $(document).ready(function () {
    $("#start").click(
      function () {
        $("#sormi").addClass("delete");
        $("#mainosteksti").addClass("delete");
      },
    );
    $("#start").hover(
      function () {
        $("#sormi").addClass("delete");
        $("#mainosteksti").addClass("delete");
      },
    );
  });
</script>

<style>
  .blink {
  animation: blinker 2.5s linear infinite;
  }
  @keyframes blinker {
    50% {
      opacity: 0;
    }
  }

</style>
  <div class="teksticontainer">
    <div id="sormi" class="sormi blink">☞</div>
    <div id="mainosteksti" class="mainosteksti blink">Kokeile tästä!</div>
  </div>
  <div class="center">
    <input id="level-one" type="checkbox"/>
    <div class="level" l="1">
      <div id="start" class="step start" r="0" c="0"></div>
      <div class="step" r="0" c="1"></div>
      <div class="step" r="1" c="1"></div>
      <div class="step" r="2" c="1"></div>
      <div class="step" r="3" c="1"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step" r="3" c="3"></div>
      <div class="step" r="2" c="3"></div>
      <div class="step" r="2" c="4"></div>
      <div class="step" r="3" c="4"></div>
      <div class="step finish" r="4" c="4">
        <label class="goal" for="level-one"></label>
      </div>
    </div>
    <input id="level-two" type="checkbox"/>
    <div class="level">
      <div class="step start" r="4" c="4"></div>
      <div class="step" r="4" c="3"></div>
      <div class="step" r="4" c="2"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step" r="3" c="1"></div>
      <div class="step" r="3" c="0"></div>
      <div class="step" r="4" c="0"></div>
      <div class="step" r="4" c="1"></div>
      <div class="step" r="3" c="1"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step" r="3" c="3"></div>
      <div class="step" r="4" c="3"></div>
      <div class="step" r="4" c="2"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step" r="3" c="1"></div>
      <div class="step" r="4" c="1"></div>
      <div class="step" r="4" c="0"></div>
      <div class="step" r="3" c="0"></div>
      <div class="step" r="2" c="0"></div>
      <div class="step" r="1" c="0"></div>
      <div class="step finish" r="1" c="1">
        <label class="goal" for="level-two"></label>
      </div>
    </div>
    <input id="level-three" type="checkbox"/>
    <div class="level">
      <div class="step start" r="1" c="1"></div>
      <div class="step" r="1" c="2"></div>
      <div class="step" r="1" c="3"></div>
      <div class="path">
        <div class="step" r="1" c="4"></div>
        <div class="step" r="0" c="4"></div>
        <div class="step" r="0" c="3"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="3" c="3"></div>
        <div class="step" r="4" c="3"></div>
        <div class="step" r="4" c="4"></div>
      </div>
      <div class="step" r="2" c="3"></div>
      <div class="step" r="3" c="3"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step" r="3" c="1"></div>
      <div class="step" r="3" c="0"></div>
      <div class="step" r="2" c="0"></div>
      <div class="step" r="1" c="0"></div>
      <div class="step finish" r="0" c="0">
        <label class="goal" for="level-three"></label>
      </div>
    </div>
    <input id="level-four" type="checkbox"/>
    <div class="level">
      <div class="step start" r="0" c="0"></div>
      <div class="path">
        <div class="step" r="0" c="1"></div>
        <div class="step" r="0" c="2"></div>
        <div class="path">
          <div class="step" r="1" c="2"></div>
          <div class="step" r="2" c="2"></div>
          <div class="step" r="3" c="2"></div>
          <div class="path">
            <div class="step" r="3" c="3"></div>
            <div class="step" r="2" c="3"></div>
            <div class="step" r="1" c="3"></div>
            <div class="step" r="1" c="4"></div>
            <div class="step" r="2" c="4"></div>
          </div>
          <div class="step" r="3" c="1"></div>
          <div class="step" r="3" c="0"></div>
          <div class="step" r="2" c="0"></div>
          <div class="step" r="2" c="1"></div>
          <div class="step" r="2" c="2"></div>
          <div class="step" r="1" c="2"></div>
          <div class="step" r="1" c="3"></div>
          <div class="step" r="0" c="3"></div>
          <div class="step" r="0" c="4"></div>
          <div class="step" r="1" c="4"></div>
          <div class="step" r="2" c="4"></div>
          <div class="step" r="3" c="4"></div>
        </div>
        <div class="step" r="0" c="3"></div>
        <div class="step" r="0" c="4"></div>
        <div class="step" r="1" c="4"></div>
        <div class="path">
          <div class="step" r="1" c="3"></div>
          <div class="step" r="2" c="3"></div>
          <div class="step" r="2" c="2"></div>
          <div class="step" r="2" c="1"></div>
          <div class="step" r="2" c="0"></div>
          <div class="step" r="1" c="0"> </div>
        </div>
        <div class="step" r="2" c="4"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="2" c="1"></div>
        <div class="step" r="2" c="0"></div>
        <div class="step" r="3" c="0"></div>
        <div class="step" r="4" c="0"></div>
        <div class="step" r="4" c="1"></div>
        <div class="step" r="4" c="2"></div>
        <div class="step" r="3" c="2"></div>
      </div>
      <div class="step" r="1" c="0"></div>
      <div class="path">
        <div class="step" r="1" c="1"></div>
        <div class="step" r="1" c="2"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="1" c="2"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="1" c="2"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="1" c="2"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="1" c="2"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="1" c="2"></div>
        <div class="step" r="1" c="3"></div>
        <div class="step" r="2" c="3"></div>
        <div class="step" r="2" c="2"></div>
        <div class="step" r="1" c="2"></div>
      </div>
      <div class="step" r="2" c="0"></div>
      <div class="step" r="3" c="0"></div>
      <div class="step" r="4" c="0"></div>
      <div class="step" r="4" c="1"></div>
      <div class="step" r="4" c="2"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step" r="2" c="2"></div>
      <div class="path">
        <div class="step" r="2" c="1"></div>
        <div class="step" r="2" c="0"></div>
        <div class="step" r="3" c="0"></div>
        <div class="step" r="4" c="0"></div>
        <div class="step" r="4" c="1"></div>
        <div class="step" r="4" c="2"></div>
      </div>
      <div class="step" r="1" c="2"></div>
      <div class="step" r="0" c="2"></div>
      <div class="step" r="0" c="3"></div>
      <div class="step" r="1" c="3"></div>
      <div class="step" r="1" c="4"></div>
      <div class="step" r="0" c="4"></div>
      <div class="step" r="0" c="3"></div>
      <div class="step" r="1" c="3"></div>
      <div class="step" r="2" c="3"></div>
      <div class="step" r="2" c="2"></div>
      <div class="step" r="3" c="2"></div>
      <div class="step finish" r="4" c="4">
        <label class="goal" for="level-four"></label>
      </div>
    </div>
    <input id="level-five" type="checkbox"/>
    <div class="level">
      <div class="step start" r="4" c="4"></div>
      <div class="step" r="3" c="4"></div>
      <div class="step" r="2" c="4">
        <label class="gamebutton" for="bridge-one"></label>
      </div>
      <div class="bridge">
        <input id="bridge-one" type="checkbox"/>
        <div class="step" r="1" c="4"></div>
        <div class="step" r="0" c="4"></div>
        <div class="step" r="0" c="3"></div>
        <div class="path">
          <div class="step" r="1" c="3"></div>
          <div class="step" r="1" c="4"></div>
          <div class="step" r="2" c="4"></div>
          <div class="step" r="3" c="4"></div>
          <div class="step" r="3" c="3"></div>
          <div class="step" r="4" c="3"></div>
          <div class="step" r="4" c="2"></div>
          <div class="step" r="4" c="1"></div>
          <div class="path">
            <div class="step" r="3" c="1"></div>
            <div class="step" r="3" c="0"></div>
            <div class="step" r="2" c="0"></div>
            <div class="step" r="1" c="0"></div>
            <div class="step" r="0" c="0"></div>
            <div class="step" r="0" c="1"></div>
            <div class="path">
              <div class="step" r="0" c="2"></div>
              <div class="bridge">
                <input id="bridge-two" type="checkbox"/>
                <div class="step" r="0" c="3"></div>
                <div class="step" r="0" c="4"></div>
                <div class="step" r="1" c="4"></div>
                <div class="step" r="2" c="4"></div>
                <div class="step" r="2" c="3"></div>
              </div>
            </div>
            <div class="step" r="1" c="1"></div>
            <div class="step" r="1" c="0">
              <label class="gamebutton" for="bridge-three"></label>
            </div>
          </div>
          <div class="step" r="4" c="0"></div>
          <div class="step" r="3" c="0"></div>
          <div class="step" r="3" c="1"></div>
          <div class="step" r="4" c="1"></div>
          <div class="step" r="4" c="2"></div>
          <div class="step" r="4" c="3">
            <label class="gamebutton" for="bridge-four"></label>
          </div>
        </div>
        <div class="step" r="0" c="2"></div>
        <div class="step" r="0" c="1"></div>
        <div class="step" r="1" c="1"></div>
        <div class="step" r="1" c="0"></div>
        <div class="bridge">
          <input id="bridge-four" type="checkbox"/>
          <div class="step" r="2" c="0"></div>
          <div class="step" r="3" c="0"></div>
          <div class="path">
            <div class="step" r="4" c="0"></div>
            <div class="step" r="4" c="1"></div>
            <div class="step" r="4" c="2"></div>
          </div>
          <div class="step" r="3" c="1"></div>
          <div class="step" r="4" c="1button"></div>
          <div class="step" r="4" c="0"></div>
          <div class="bridge">
            <input id="bridge-three" type="checkbox"/>
            <div class="step" r="3" c="0"></div>
            <div class="step" r="2" c="0"></div>
            <div class="step" r="1" c="0"></div>
            <div class="step" r="0" c="0">
              <label class="gamebutton" for="bridge-two"> </label>
            </div>
          </div>
        </div>
      </div>
      <div class="step finish" r="2" c="2">
        <label class="goal" for="level-five"></label>
      </div>
    </div>
    <input id="finsh" type="checkbox"/>
    <div class="level">
      <div class="voitto">
        <h1>VIIHDEMAGIA</h1>
        <p>Onnittelut pelin läpäisemisestä</p>
      </div>
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
