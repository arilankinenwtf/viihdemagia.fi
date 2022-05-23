<?php defined('C5_EXECUTE') or die("Access Denied.");
$sliderHeight = '500px';
$sliderWidth = '1200px';
$imgMaxwidth = '150px';
$imgMaxHeight = '150px';

$sliderSrc = '';
$listSrc = '';

$page = Page::getCurrentPage();
$cID = $page->getCollectionID();
?>

<div class="references-list-block position-relative <?php if($cID == 1) echo 'home-references-list';?>">

  <!-- Slider -->
  <div class="slider-list splide" id="list-slider-<?php echo $bID; ?>">
    <div class="splide__track">
      <ul class="splide__list">
        <?php 
        $rowsCount = 0;
        foreach ($rows as $row) { 
          // Show max 10 references in slider
          if($rowsCount >= 10) {
            break;
          } else {
            $rowsCount++;
          }?>
            <li class="slider-item splide__slide">
              <div class="slider-item-image">
                <?php 
                $f = File::getByID($row['fID']);
                if (is_object($f)) {
                  $sliderSrc = $f->getURL();
                }
                ?>
                <img data-splide-lazy="<?php echo $sliderSrc;?>" alt="<?php echo $row['titleText'];?>" 
                height="<?php echo $sliderHeight;?>" width="<?php echo $sliderWidth;?>"/>
              </div>

              <div class="slider-item-text">
                <?php if($row['titleText'] != '') { ?>
                  <h2 class="slider-item-title"><?php echo $row['titleText'] ?></h2>
                <?php } ?>
                <?php if($row['descriptionText'] != '') { ?>
                  <div class="slider-item-description"><?php echo $row['descriptionText']; ?></div>
                <?php } ?>
              </div>
            </li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <!-- Grid -->
  <?php 
  // do not show grid on frontpage
  if($cID != 1):
  ?>
  <div class="list-wrapper list-references" id="list-<?php echo $bID; ?>">
    <ul class="list-ul list-ul-references">
      <?php foreach ($rows as $row) { ?>
          <li class="list-item">
            <div class="list-item-image list-item-image-references">
              <?php 
              $f = File::getByID($row['fID']);
              if (is_object($f)) {
                $listSrc = $f->getURL();
              }
              ?>
              <img src="<?php echo $listSrc;?>" alt="<?php echo $row['titleText'];?>" class="lazyload" 
              height="<?php echo $imgMaxHeight;?>" width="<?php echo $imgMaxwidth;?>"/>
            </div>

            <div class="list-item-text list-item-text-references">
              <<?php echo $headingType;?> class="list-item-title">
                <?php echo $row['titleText'] ?>
              </<?php echo $headingType;?>>
              <div class="list-item-description"><?php echo $row['descriptionText']; ?></div>
            </div>

          </li>
      <?php } ?>
    </ul>
  </div>
  <?php endif; ?>

  <script>
  document.addEventListener( 'DOMContentLoaded', function () {

    var splide = new Splide( '#list-slider-<?php echo $bID; ?>', {
      rewind: true,
      pagination: true,
      autoplay: true,
      type: "loop",
      interval: 5000,
      lazyLoad: true,
      arrows: false
    } ).mount();

  });
  </script>
  
</div>