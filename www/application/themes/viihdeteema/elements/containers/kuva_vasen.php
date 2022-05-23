<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\Area\ContainerArea;

?>
<div class="container custom-container kuva-container kuva-vasen">
    <div class="row">
        <div class="col-12 col-md-5">
            <?php
            $area = new ContainerArea($container, 'kuva tähän');
            $a->setAreaGridMaximumColumns(12);
            $area->display($c);
            ?>
        </div>
        <div class="col-12 col-md-7 kuva-left">
            <?php
            $area = new ContainerArea($container, 'feature/esittely tähän');
            $a->setAreaGridMaximumColumns(12);
            $area->display($c);
            ?>
        </div>
    </div>
</div>