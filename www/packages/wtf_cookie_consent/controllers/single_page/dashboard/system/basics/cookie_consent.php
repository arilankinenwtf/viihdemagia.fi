<?php
namespace Concrete\Package\WtfCookieConsent\Controller\SinglePage\Dashboard\System\Basics;

use Core;
use Page;
use Package;
use Concrete\Core\Multilingual\Page\Section\Section;
use Concrete\Core\Page\Controller\DashboardPageController;

defined('C5_EXECUTE') or die("Access Denied.");

class CookieConsent extends DashboardPageController
{
    protected $colorProfiles;
    protected $languageSections;

    public function __construct(Page $c)
    {
        parent::__construct($c);
        $this->languageSections = Section::getList();
    }

    public function view()
    {
        $config = $this->getConfig();
        $debug = $config->get('cookies.consent_debug');
        $this->set('cookies.consent_debug', $config->get('cookies.consent_debug'));
        $this->set('cookies.consent_bannerBg', $config->get('cookies.consent_bannerBg'));
        $this->set('cookies.consent_bannerColor', $config->get('cookies.consent_bannerColor'));
        $this->set('cookies.consent_accBtnBg', $config->get('cookies.consent_accBtnBg'));
        $this->set('cookies.consent_accBtnColor', $config->get('cookies.consent_accBtnColor'));

        $this->set('cookies.consent_necessaryScriptsHead', $config->get('cookies.consent_necessaryScriptsHead'));
        $this->set('cookies.consent_analyticsScriptsHead', $config->get('cookies.consent_analyticsScriptsHead'));
        $this->set('cookies.consent_marketingScriptsHead', $config->get('cookies.consent_marketingScriptsHead'));
        $this->set('cookies.consent_necessaryScriptsFooter', $config->get('cookies.consent_necessaryScriptsFooter'));
        $this->set('cookies.consent_analyticsScriptsFooter', $config->get('cookies.consent_analyticsScriptsFooter'));
        $this->set('cookies.consent_marketingScriptsFooter', $config->get('cookies.consent_marketingScriptsFooter'));

        foreach ($this->languageSections as $languageSection ) {
            $locale = $languageSection->getLocale();

            $localeMesg = $config->get('cookies.consent_'.$locale.'_message');
            $localeMoreInfoPage = $config->get('cookies.consent_'.$locale.'_more-info-page');
            $localeMoreInfoPageText = $config->get('cookies.consent_'.$locale.'_more-info-page-text');
            $localeBtnTxt = $config->get('cookies.consent_'.$locale.'_more-info-button-text');
            $localeAcptBtnTxt = $config->get('cookies.consent_'.$locale.'_accept-button-text');
            $localeDeclineBtnTxt = $config->get('cookies.consent_'.$locale.'_decline-button-text');
            $localeLongDesc = $config->get('cookies.consent_'.$locale.'_long-description');

            $this->set($locale.'-message', $localeMesg);
            $this->set($locale.'-more-info-page', $localeMoreInfoPage);
            $this->set($locale.'-more-info-page-text', $localeMoreInfoPageText);
            $this->set($locale.'-more-info-button-text', $localeBtnTxt);
            $this->set($locale.'-accept-button-text', $localeAcptBtnTxt);
            $this->set($locale.'-decline-button-text', $localeDeclineBtnTxt);
            $this->set($locale.'-long-description', $localeLongDesc);
        }

        $this->set('has_multilingual', Core::make('multilingual/detector')->isEnabled());

    }


    public function saveSettings()
    {
        $config = $this->getConfig();
        $this->flash('success', t("Display settings successfully saved."));

        if ($this->post('debug') === 'true') {
            $config->save('cookies.consent_debug', 'true');
        } else {
            $config->save('cookies.consent_debug', 'false');
        }

        foreach ($this->languageSections as $languageSection){
            $locale = $languageSection->getLocale();

            if($this->post($locale.'-enabled') === 'true'){
                $enabled = 'true';
            } else {
                $enabled = 'false';
            }
            $message = $this->post($locale.'-message');
            $acptButtonTxt = $this->post($locale.'-accept-button-text');
            $declineButtonTxt = $this->post($locale.'-decline-button-text');
            $buttonTxt = $this->post($locale.'-more-info-button-text');
            $moreInfoPage = $this->post($locale.'-more-info-page');
            $moreInfoPageText = $this->post($locale.'-more-info-page-text');
            $longDesc = $this->post($locale.'-long-description');

            $config->save('cookies.consent_'.$locale.'_enabled', $enabled);
            $config->save('cookies.consent_'.$locale.'_message', $message);
            $config->save('cookies.consent_'.$locale.'_more-info-button-text', $buttonTxt);
            $config->save('cookies.consent_'.$locale.'_more-info-page', $moreInfoPage);
            $config->save('cookies.consent_'.$locale.'_more-info-page-text', $moreInfoPageText);
            $config->save('cookies.consent_'.$locale.'_accept-button-text', $acptButtonTxt);
            $config->save('cookies.consent_'.$locale.'_decline-button-text', $declineButtonTxt);
            $config->save('cookies.consent_'.$locale.'_long-description', $longDesc);

            $config->save('cookies.consent_bannerBg', $this->post('bannerBg'));
            $config->save('cookies.consent_bannerColor', $this->post('bannerColor'));
            $config->save('cookies.consent_accBtnBg', $this->post('accBtnBg'));
            $config->save('cookies.consent_accBtnColor', $this->post('accBtnColor'));
        }

        if (is_object($page)) {
            $this->redirect('/dashboard/system/basics/cookie_consent');
        }
    }

    public function saveScriptSettings()
    {
        $config = $this->getConfig();
        $this->flash('success', t("Scripts successfully saved."));

        $config->save('cookies.consent_necessaryScriptsHead', $this->post('necessaryScriptsHead'));
        $config->save('cookies.consent_analyticsScriptsHead', $this->post('analyticsScriptsHead'));
        $config->save('cookies.consent_marketingScriptsHead', $this->post('marketingScriptsHead'));

        $config->save('cookies.consent_necessaryScriptsFooter', $this->post('necessaryScriptsFooter'));
        $config->save('cookies.consent_analyticsScriptsFooter', $this->post('analyticsScriptsFooter'));
        $config->save('cookies.consent_marketingScriptsFooter', $this->post('marketingScriptsFooter'));

        if (is_object($page)) {
            $this->redirect('/dashboard/system/basics/cookie_consent');
        }
    }

    protected function getConfig()
    {
        $pkg = Package::getByID($this->c->getPackageID());
        return $pkg->getConfig();
    }

}