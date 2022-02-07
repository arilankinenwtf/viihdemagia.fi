<?php
namespace Application\Theme\viihdeteema; // tässä pitää olla aina teeman kansion nimi viimeisenä
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface {

	public function registerAssets() {
        $this->providesAsset('css', 'bootstrap/collapse');
        $this->requireAsset('javascript', 'bootstrap/collapse');
        $this->requireAsset('javascript', 'bootstrap/transition');
        //$this->requireAsset('css', 'font-awesome');
        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'picturefill');
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
        array('title' => t('Painike (ensisijainen)'), 'menuClass' => '', 'spanClass' => 'btn btn-primary'),
        array('title' => t('Painike (toissijainen)'), 'menuClass' => '', 'spanClass' => 'btn btn-secondary'),
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
