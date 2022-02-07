<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div id="splide" class="splide">
    <div class="splide__track">
        <ul class="splide__list">
            <?php foreach ($rows as $row) : ?>
                <li class="splide__slide">
                        <img src="<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['title']; ?>" />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>