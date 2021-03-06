<?php
namespace Application\Theme\Viihdeteema; // tässä pitää olla aina teeman kansion nimi viimeisenä
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface {

	public function registerAssets() {
        $this->requireAsset('javascript', 'bootstrap');
        //$this->requireAsset('css', 'font-awesome');
        $this->requireAsset('javascript', 'jquery');
	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large' => '900px',
            'medium' => '768px',
            'small' => '0'
        );
    }

    public function getThemeEditorClasses()
    {
      return array(
        array('title' => t('Ingressi'), 'menuClass' => '', 'spanClass' => 'ingress'),
        array('title' => t('Kuvateksti'), 'menuClass' => '', 'spanClass' => 'caption'),
        array('title' => t('Punainen teksti'), 'menuClass' => '', 'spanClass' => 'punainen-teksti'),
        array('title' => t('Isompi teksti'), 'menuClass' => '', 'spanClass' => 'isompi-teksti'),
        array('title' => t('Pienempi otsikko kaksi'), 'menuClass' => '', 'spanClass' => 'pienempi-otsikko-kaksi'),
        array(
            'title' => t('Painike'),
            'element' => array('a'),
            'menuClass' => 'btn btn-primary',
            'attributes' => array('class' => 'btn btn-primary')
        ),
        array(
            'title' => t('Toissijainen painike'),
            'element' => array('a'),
            'menuClass' => 'btn btn-primary',
            'attributes' => array('class' => 'btn btn-secondary')
        ),
      );
    }

    public function getThemeAreaLayoutPresets()
    {
        $presets = array(
            array(
                'handle' => 'md-8-offset-2',
                'name' => 'Kapea alue',
                'container' => '<div class="row"></div>',
                'columns' => array(
                    '<div class="col-md-8 col-md-offset-2"></div>'
                ),
            ),
            array(
              'handle' => 'sm-6-reverse',
              'name' => '6-6 Käännä mobiilissa',
              'container' => '<div class="row"></div>',
              'columns' => array(
                  '<div class="col-md-6 col-md-push-6 reverse-columns"></div>',
                  '<div class="col-md-6 col-md-pull-6 reverse-columns"></div>'
                ),
            ),
        );
        return $presets;
    }

    public function getThemeBlockClasses()
    {
        return array(
            'core_area_layout' => array(               
                'layout--gray'
            ),
        );
    }

}
