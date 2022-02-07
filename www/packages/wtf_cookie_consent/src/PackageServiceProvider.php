<?php
namespace Concrete\Package\WtfCookieConsent\Src;

use View;
use Page;
use Events;
use Config;
use Package;
use AssetList;
use User;
use Concrete\Core\Foundation\Service\Provider as ServiceProvider;
use Concrete\Core\Localization\Localization;

class PackageServiceProvider extends ServiceProvider
{

    protected $pkgHandle = 'wtf_cookie_consent';

    public function register()
    {
        $singletons = array(
            'allowance' => '\Concrete\Package\Cookiesconsent\Src\CookieAllowance',
        );

        foreach ($singletons as $key => $value) {
            $this->app->singleton($this->pkgHandle . '/' . $key, $value);
        }
    }

    public function registerAssets()
    {
        $v = View::getInstance();
        $al = AssetList::getInstance();
        $pkg = Package::getByHandle($this->pkgHandle);

        $al->register(
            'javascript', 'cookieconsent', 'js/cookieconsent.min.js', 
            array('minify' => true, 'combine' => true), 
            $this->pkgHandle
        );
        $al->register(
            'javascript', 'cookieconsent_element', 'js/cookie_consent_element.js', 
            array('minify' => true, 'combine' => true), 
            $this->pkgHandle
        );
        $al->register(
            'css', 'cookieconsent', 'css/cookieconsent.min.css', 
            array('position' => 'F', 'minify' => true, 'combine' => true), 
            $this->pkgHandle
        );

    }

    public function registerEvents()
    {
        $pkg = Package::getByHandle($this->pkgHandle);

        Events::addListener('on_page_view', function ($event) use ($pkg) {

            $u = new User();
            $p = Page::getCurrentPage();
            $v = View::getInstance();

            if (!$u->isLoggedIn() && !$p->isAdminArea() && !$p->isError()) {
                $v->requireAsset('javascript', 'cookieconsent');
                $v->requireAsset('javascript', 'cookieconsent_element');
                $v->requireAsset('css', 'cookieconsent');
            }

            $locale = $this->getPageLocale(); // Localization::activeLocale() not working on v8.3
            $config = $pkg->getConfig();

            // Head scripts
            if($config->get('cookies.consent_necessaryScriptsHead')) {
                $necessaryScriptsHead = $config->get('cookies.consent_necessaryScriptsHead');
            } else { $necessaryScriptsHead = ""; }
            if($config->get('cookies.consent_analyticsScriptsHead')) {
                $analyticsScriptsHead = $config->get('cookies.consent_analyticsScriptsHead');
            } else { $analyticsScriptsHead = ""; }
            if($config->get('cookies.consent_marketingScriptsHead')) {
                $marketingScriptsHead = $config->get('cookies.consent_marketingScriptsHead');
            } else { $marketingScriptsHead = ""; }

            // Footer scripts
            if($config->get('cookies.consent_necessaryScriptsFooter')) {
                $necessaryScriptsFooter = $config->get('cookies.consent_necessaryScriptsFooter');
            } else { $necessaryScriptsFooter = ""; }
            if($config->get('cookies.consent_analyticsScriptsFooter')) {
                $analyticsScriptsFooter = $config->get('cookies.consent_analyticsScriptsFooter');
            } else { $analyticsScriptsFooter = ""; }
            if($config->get('cookies.consent_marketingScriptsFooter')) {
                $marketingScriptsFooter = $config->get('cookies.consent_marketingScriptsFooter');
            } else { $marketingScriptsFooter = ""; }   

            // If locales cookie consent popup is enabled
            if ($config->get('cookies.consent_'.$locale.'_enabled') === 'true'){

                if($config->get('cookies.consent_'.$locale.'_message')) {
                    $message = $config->get('cookies.consent_'.$locale.'_message');
                } else { $message = ""; }
                if($config->get('cookies.consent_'.$locale.'_more-info-button-text')) {
                    $infoBtn = $config->get('cookies.consent_'.$locale.'_more-info-button-text');
                } else { $infoBtn = ""; }
                if($config->get('cookies.consent_'.$locale.'_accept-button-text')) {
                    $acceptBtn = $config->get('cookies.consent_'.$locale.'_accept-button-text');
                } else { $acceptBtn = ""; }
                if($config->get('cookies.consent_'.$locale.'_decline-button-text')) {
                    $declineBtn = $config->get('cookies.consent_'.$locale.'_decline-button-text');
                } else { $declineBtn = ""; }
                if($config->get('cookies.consent_'.$locale.'_more-info-page')) {
                    $pageID = $config->get('cookies.consent_'.$locale.'_more-info-page');
                    $moreInfoPage = Page::getByID($pageID);
                    $url = $moreInfoPage->getCollectionLink();
                } else { $url = ""; }
                if($config->get('cookies.consent_'.$locale.'_more-info-page-text')) {
                    $moreInfoPageText = $config->get('cookies.consent_'.$locale.'_more-info-page-text');
                } else { $moreInfoPageText = ""; }
                if($config->get('cookies.consent_'.$locale.'_long-description')) {
                    $longDesc = $config->get('cookies.consent_'.$locale.'_long-description');
                    $longDesc = str_replace(array("\r", "\n"), '', $longDesc);
                } else { $longDesc = ""; }

                if($config->get('cookies.consent_bannerBg')) {
                    $bannerBg = $config->get('cookies.consent_bannerBg');
                } else { $bannerBg = ""; }
                if($config->get('cookies.consent_bannerColor')) {
                    $bannerColor = $config->get('cookies.consent_bannerColor');
                } else { $bannerColor = ""; }
                if($config->get('cookies.consent_accBtnBg')) {
                    $accBtnBg = $config->get('cookies.consent_accBtnBg');
                } else { $accBtnBg = ""; }
                if($config->get('cookies.consent_accBtnColor')) {
                    $accBtnColor = $config->get('cookies.consent_accBtnColor');
                } else { $accBtnColor = ""; }
                
                $showCookieInfo = ' <button id=\'cc-show-info\' class=\'btn-fake-link\'>'. $infoBtn .'</button>';
                $cookieLink = '<a href=\''. $url .'\' target=\'_blank\' style=\'color: ' . $bannerColor . '\'>'. $moreInfoPageText .'</a>';
                $cookieInfo = '<div id=\'cc-additional-info\' style=\'display:none;margin-top:10px;\'>'. $longDesc . '<br>' . $cookieLink .'</div>';

                if($infoBtn != '' && $longDesc != '') {
                    $content = $message . $showCookieInfo . $cookieInfo;
                } else {
                    $content = $message . '<br>' . $cookieLink;
                }

                $cookieScriptHead = '
                <script>
                    window.addEventListener("load", function(){
                        window.cookieconsent.initialise({
                            revokable: true,
                            revokeBtn: "<div id=\'cc-revoke-cookies\' class=\'cc-revoke\'></div>",
                            type: "opt-in",
                            position: "bottom-right",
                            showLink: false,
                            palette: {
                                popup: {
                                    background: "' . $bannerBg . '",
                                    text: "' . $bannerColor . '"
                                },
                                button: {
                                    background: "' . $accBtnBg . '",
                                    text: "' . $accBtnColor . '"
                                }
                            },
                            content: {
                                message: "' . $content . '",
                                allow: "' . $acceptBtn . '",
                                deny: "' .$declineBtn . '",
                            },
                            onInitialise: function(status) {
                                if (status == cookieconsent.status.allow) onConsent();
                            },
                            onStatusChange: function (status) {
                                var type = this.options.type;
                                var didConsent = this.hasConsented();
                                if (type == "opt-in" && didConsent) {
                                    console.log("consented, add all cookies");
                                    consentIn();
                                } else {
                                    console.log("not consented, delete all cookies");
                                    consentOut();
                                }
                            }
                        })
                    });
                </script>
                ';
            }

            // Add necessary scripts to head/footer

            $scriptsHeadTag = '
            <script>'.
                $necessaryScriptsHead .'
                function analyticsScriptsHead() {
                    ' . $analyticsScriptsHead . '
                }
                function marketingScriptsHead() {
                    ' . $marketingScriptsHead . '
                }
            </script>
            ';

            $scriptsFooterTag = '
            <script>'.
                $necessaryScriptsFooter .'
                function analyticsScriptsFooter() {
                    ' . $analyticsScriptsFooter . '
                }
                function marketingScriptsFooter() {
                    ' . $marketingScriptsFooter . '
                }
            </script>
            ';

            if (!$u->isLoggedIn() && !$p->isAdminArea() && !$p->isError()) {
                $v->addHeaderItem($scriptsHeadTag);
                $v->addFooterItem($scriptsFooterTag);

                if($cookieScriptHead) {
                    $v->addHeaderItem($cookieScriptHead);
                }
            }
        });
    }

    public function getPageLocale()
    {
        $id = Page::getCurrentPage()->getCollectionID();
        $c = Page::getById($id); // the page 
 
        $ml = \Concrete\Core\Multilingual\Page\Section\Section::getList();
        foreach ($ml as $m) {
            $tid = $m->getTranslatedPageID($c);
            if ($tid == $id) {
                return ($m->getLocale());
            }
        }
 
        // default to finnish
        return "fi_FI";
    }

}
