<?php

namespace Application\Block\ImageGallery;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Block\BlockController;
use Loader;
use File;
use Core;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController {

    protected $btTable              = "btImageGallery";
    protected $btInterfaceWidth     = "700";
    protected $btInterfaceHeight    = "500";
    protected $btDefaultSet         = 'multimedia';

    protected $imageSizes = array(
        'file_manager_image'    => array(360, 200, true),
        'thumbnail'             => array(360, 200, true),
        'image'                 => array(1000, 1000, true),
    );

    public function getBlockTypeDescription() {
        return t("Display multiple images as a gallery.");
    }

    public function getBlockTypeName() {
        return t("Slider Gallery");
    }

    public function add() {
        $this->requireAsset('core/file-manager');
        $this->requireAsset('core/file-manager');
        $this->requireAsset('core/file-manager');
        $this->set('rows', $this->getGalleryItems());
    }

    public function edit() {
        $this->requireAsset('core/file-manager');
        $this->set('rows', $this->getGalleryItems());
    }

    public function view() {
        $this->set('rows', $this->getGalleryItems());
    }

    public function save($args) {
        $count  = count($args['fID']);
        $db     = Loader::db();
        $db->execute('DELETE from btImageGalleryItem WHERE bID = ?', array($this->bID));

        parent::save($args);

        for($i = 0; $i < $count; $i++) {
            $db->execute('
                INSERT INTO btImageGalleryItem (bID, fID, title)
                VALUES(?,?,?)',
                array(
                    $this->bID,
                    intval($args['fID'][$i]),
                    $args['title'][$i],
                )
            );
        }
    }

    public function registerViewAssets($outputContent = '') { 

        $al = AssetList::getInstance();

        //JS
        $al->register('javascript', 'image_gallery/splidejs', 'blocks/image_gallery/js_files/splide.min.js', [], 'image_gallery');
        $this->requireAsset('javascript', 'image_gallery/splidejs');

        $al->register('javascript', 'image_gallery/splidegridjs', 'blocks/image_gallery/js_files/splide-extension-grid.min.js', [], 'image_gallery');
        $this->requireAsset('javascript', 'image_gallery/splidegridjs');

        // Css
        $al->register('css', 'image_gallery/splidecss', 'blocks//image_gallery/css_files/splide.min.css', [], 'image_gallery');
        $this->requireAsset('css', 'image_gallery/splidecss');

    }

    public function getGalleryItems() {
        $db     = Loader::db();
        $im     = Core::make('helper/image');
        $r      = $db->GetAll('SELECT * from btImageGalleryItem WHERE bID = ?', array($this->bID));
        $rows   = array();

        foreach($r as $q) {
            $file = File::getByID($q['fID']);
            if ($file) {
                foreach ( $this->imageSizes as $key => $imageSize ) {
                    $q[$key] = $im->getThumbnail(
                        $file,
                        $imageSize[0],
                        $imageSize[1],
                        $imageSize[2]
                    )->src;
                }
            }

            $rows[] = $q;
        }
        return $rows;
    }

}