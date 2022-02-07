<?php
namespace Application\Theme\C5theme; // tässä pitää olla aina teeman kansion nimi viimeisenä
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;

class PageTheme extends \Concrete\Core\Page\Theme\Theme implements ThemeProviderInterface {

	public function registerAssets() {
        // Täällä määritellään teemassa tarvittavia Concreteen sisältyviä kirjastoja (Esim. jquery)

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

    // Valmiiden tyylien määrittely niin että niitä voi käyttää Concreten sisällönhallinnassa:
    // https://documentation.concrete5.org/developers/pages-themes/designing-for-concrete5/advanced-css-and-javascript-usage/adding-custom-css-classes-to-blocks-areas-and-the-editor

    public function getThemeEditorClasses()
    {
      return array(
        array('title' => t('Ingressi'), 'menuClass' => '', 'spanClass' => 'ingress'),
        array('title' => t('Kuvateksti'), 'menuClass' => '', 'spanClass' => 'caption'),
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
        array(
            'title' => t('Sininen otsikko'),
            'element' => array('h1', 'h2', 'h3', 'h4'),
            'menuClass' => 'blue-heading',
            'attributes' => array('class' => 'blue-heading')
        ),
        array(
            'title' => t('Sininen teksti'),
            'element' => array('p', 'span'),
            'menuClass' => 'blue-text',
            'attributes' => array('class' => 'blue-text')
        ),
        array(
            'title' => t('Tyhjennä tyylit'),
            'element' => array('p', 'span', 'a', 'h1', 'h2', 'h3', 'h4', 'h5'),
            'menuClass' => '',
            'attributes' => array('class' => '')
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
                'layout',
                'layout-dark',
                'layout-center-vertically',
                'layout-large-padding',
                'animated',
                'slide-in-right',
            ),
        );
    }

}
