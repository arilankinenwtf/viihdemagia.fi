<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\Area\ContainerArea;

?>
<div class="container custom-container kuva-container kuva-oikea">
    <div class="row">
        <div class="col-12 col-md-6 feature-vasen">
            <?php
            $area = new ContainerArea($container, 'Feature/esittely tähän');
            $a->setAreaGridMaximumColumns(12);
            $area->display($c);
            ?>
        </div>
        <div class="col-12 col-md-6 kuva-right">
            <?php
            $area = new ContainerArea($container, 'Kuva tähän');
            $a->setAreaGridMaximumColumns(12);
            $area->display($c);
            ?>
        </div>
    </div>
</div>