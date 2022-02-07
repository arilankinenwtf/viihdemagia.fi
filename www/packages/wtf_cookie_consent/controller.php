<?php
namespace Concrete\Package\WtfCookieConsent;

defined('C5_EXECUTE') or die('Access Denied.');

use \Concrete\Core\Package\Package;
use \Concrete\Core\Page\Single as SinglePage;
use \Concrete\Core\Asset\AssetList;
use Core;
use Concrete\Package\WtfCookieConsent\Src\PackageServiceProvider;

class Controller extends Package
{
    protected $pkgHandle = 'wtf_cookie_consent';
    protected $appVersionRequired = '8.5.0';
    protected $pkgVersion = '1.0.1';
    
    protected $pkgAutoloaderRegistries = array(
        'src' => '\Concrete\Package\WtfCookieConsent\Src'
    );

    public function getPackageName()
    {
        return t('Evästesuostumus');
    }

    public function getPackageDescription()
    {
        return t('WTF Evästesuostumus paketti');
    }

    public function install()
    {
        $pkg = parent::install();

        // install dashboard page
        SinglePage::add('/dashboard/system/basics/cookie_consent', $pkg);
        $pkg->getConfig()->save('cookies.disclosure_debug', 'false');
    }

    public function upgrade() 
    {
      parent::upgrade();
    }

    public function on_start()
    {
        $app = Core::getFacadeApplication();
        $sp = new PackageServiceProvider($app);
        $sp->register();
        $sp->registerAssets();

        if (!$this->getConfig()->has('cookies.disclosure_prevent_tracking')) {
            $this->getConfig()->set('cookies.disclosure_prevent_tracking', true);
        }

        $sp->registerEvents();
    }
}