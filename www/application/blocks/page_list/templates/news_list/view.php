<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
?>

<div class="news-list">
  <?php foreach ($pages as $page): ?>
    <div class="news-list-item">
      <?php
      $title = $th->entities($page->getCollectionName());
      $url = $nh->getLinkToCollection($page);
      $target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
      $target = empty($target) ? '_self' : $target;
      $hoverLinkText = $title;
      $description = $page->getCollectionDescription();
      $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
      $description = $th->entities($description);
      if ($useButtonForLink) {
        $hoverLinkText = $buttonLinkText;
      }
      if($page->getCollectionDatePublic()) {
        $date = $page->getCollectionDatePublicObject()->format('j.n.Y');
      }
      if($page->getAttribute('main_image')) {
        $type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('news_image_thumbnail');
        $main_image = $page->getAttribute('main_image');
        $src = $main_image->getThumbnailURL($type->getBaseVersion());
      } else {
        $src = '';
      }
      ?>
    <div class="news-list-item-content">
      <div class="news-list-item-text-wrapper">
        <div class="news-list-item-date"><?php echo $date; ?></div>
        <h2 class="news-list-item-title">
        <a href="<?php echo $url ?>" target="<?php echo $target; ?>">
          <?php echo $title ?>
        </a>
        </h2>

        <?php if ($includeDescription): ?>
        <div class="news-list-item-description">
          <?php echo $description ?>
        </div>
        <?php endif; ?>

        <?php if (isset($useButtonForLink) && $useButtonForLink): ?>
        <div class="news-list-item-readmore top-border">
            <a href="<?php echo $url?>" target="<?php echo $target?>" class="btn btn-secondary <?php echo $buttonClasses?>"><?php echo $buttonLinkText?></a>
        </div>
        <?php endif; ?>
      </div>
    </div>
    
  </div>
  <?php endforeach; ?>
</div>

<?php if (count($pages) == 0): ?>
<div class="ccm-block-page-list-no-pages container">
  <?php echo $noResultsMessage?>
</div>
<?php endif;?>

<?php if ($showPagination): ?>
  <?php echo $pagination;?>
<?php endif; ?>

<?php if ( $c->isEditMode() && $controller->isBlockEmpty()): ?>
<div class="ccm-edit-mode-disabled-item">
  <?php echo t('Empty Page List Block.')?>
</div>
<?php endif; ?>
