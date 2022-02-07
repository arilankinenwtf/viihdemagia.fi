<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Core\Area\ContainerArea;

?>
<div class="container custom-container ref-grid">
    <div class="row">
        <div class="col-lg-8 left-column-ref">
            <?php
            $area = new ContainerArea($container, '1. sarake');
            $a->setAreaGridMaximumColumns(12);
            $area->display($c);
            ?>
        </div>
        <div class="col-lg-4 right-column-both">
            <div class="right-column-ref">
                <?php
                $area = new ContainerArea($container, '1. sarake');
                $a->setAreaGridMaximumColumns(12);
                $area->display($c);
                ?>
            </div>

            <div class="right-column-ref">
                <?php
                $area = new ContainerArea($container, '2. sarake');
                $a->setAreaGridMaximumColumns(12);
                $area->display($c);
                ?>
            </div>

        </div>
    </div>
</div>