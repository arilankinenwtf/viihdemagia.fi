<?php
use Concrete\Core\Multilingual\Page\Section\Section;

$form = Core::make('helper/form');
$pageSelector = Core::make('helper/form/page_selector');
$languageSections = Section::getList();
$pkg = Package::getByID($this->c->getPackageID());
$config = $pkg->getConfig();

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Cookie Consent'), false, false, false, false, false, false); ?>

<div class="ccm-pane-body">
    <?php
    $tabs = array(
        array('tab-settings', 'Asetukset', true),
        array('tab-scripts', 'Seurantakoodit ja skriptit'),
    );
    echo Core::make('helper/concrete/ui')->tabs($tabs);
    ?>

    <div class="tab-content">
        <div id="tab-settings" class="tab-pane ccm-tab-content <?php echo count($tabs) > 0 ? 'active' : ''; ?>">
        <!-- v8 <div id="ccm-tab-content-tab-settings" class="ccm-tab-content"> -->
            <fieldset>
                <form method="post" action="<?php echo $view->action("saveSettings"); ?>">

                    <legend style="margin-top: 30px;"><?php echo t('Content for different languages') ?></legend>
                    <?php foreach ($languageSections as $languageSection){
                        $locale = $languageSection->getLocale();?>
                        <div class="form-group" style="margin-bottom: 10px; margin-top: 30px;">
                            <label for="<?php echo $locale ?>-enabled"><?= $locale . " - " . t('Enabled'); ?></label><br>
                            <?= $form->checkbox($locale .'-enabled', 'true', $config->get('cookies.consent_'.$locale.'_enabled') === 'true'); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-description"><?= $locale . " - " . t('Message'); ?></label>
                            <?= $form->textarea($locale .'-message', $config->get('cookies.consent_'.$locale.'_message')); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-button-text"><?= $locale . " - " . t('Accept button text'); ?></label>
                            <?= $form->text($locale .'-accept-button-text', $config->get('cookies.consent_'.$locale.'_accept-button-text')); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-button-text"><?= $locale . " - " . t('Decline button text'); ?></label>
                            <?= $form->text($locale .'-decline-button-text', $config->get('cookies.consent_'.$locale.'_decline-button-text')); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-button-text"><?= $locale . " - " . t('Show More Info -button text'); ?></label>
                            <?= $form->text($locale .'-more-info-button-text', $config->get('cookies.consent_'.$locale.'_more-info-button-text')); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-long-description"><?= $locale . " - " . t('More Info'); ?></label>
                            <?= $form->textarea($locale .'-long-description', $config->get('cookies.consent_'.$locale.'_long-description')); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-more-info-page"><?= $locale . " - " . t('Cookies page link'); ?></label>
                            <?= $pageSelector->selectPage($locale . '-more-info-page',  $config->get('cookies.consent_'.$locale.'_more-info-page')); ?>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="<?php echo $locale ?>-more-info-page-text"><?= $locale . " - " . t('Cookies page link text'); ?></label>
                            <?= $form->text($locale .'-more-info-page-text', $config->get('cookies.consent_'.$locale.'_more-info-page-text')); ?>
                        </div>
                        <hr>

                    <?php } ?>

                    <legend style="margin-top: 30px;"><?php echo t('Colors') ?></legend>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="bannerBg"><?= t('Banner background'); ?></label><br>
                        <?= $form->text('bannerBg', $config->get('cookies.consent_bannerBg')); ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="bannerColor"><?= t('Banner text color'); ?></label><br>
                        <?= $form->text('bannerColor', $config->get('cookies.consent_bannerColor')); ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="accBtnBg"><?= t('Button Background'); ?></label><br>
                        <?= $form->text('accBtnBg', $config->get('cookies.consent_accBtnBg')); ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="accBtnColor"><?= t('Button Color'); ?></label><br>
                        <?= $form->text('accBtnColor', $config->get('cookies.consent_accBtnColor')); ?>
                    </div>


                    <input class="btn btn-primary" type="submit" style="margin-top: 40px;" value="<?= t('Save'); ?>">
                </form>
            </fieldset>
        </div>

        <div id="tab-scripts" class="tab-pane ccm-tab-content">
        <!-- v 8 <div id="ccm-tab-content-tab-scripts" class="ccm-tab-content"> -->
            <form method="post" action="<?php echo $view->action("saveScriptSettings"); ?>">
                
                <legend style="margin-top: 30px;"><?php echo t('Head'); ?></legend>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="necessaryScriptsHead"><?= t('Välttämättömät (aina päällä)'); ?></label>
                    <?= $form->textarea('necessaryScriptsHead', $config->get('cookies.consent_necessaryScriptsHead')); ?>
                </div> 

                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="analyticsScriptsHead"><?= t('Analytiikka'); ?></label>
                    <?= $form->textarea('analyticsScriptsHead', $config->get('cookies.consent_analyticsScriptsHead')); ?>
                </div> 

                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="marketingScriptsHead"><?= t('Markkinointi'); ?></label>
                    <?= $form->textarea('marketingScriptsHead', $config->get('cookies.consent_marketingScriptsHead')); ?>
                </div> 

                <legend style="margin-top: 30px;"><?php echo t('Footer'); ?></legend>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="necessaryScriptsFooter"><?= t('Välttämättömät (aina päällä)'); ?></label>
                    <?= $form->textarea('necessaryScriptsFooter', $config->get('cookies.consent_necessaryScriptsFooter')); ?>
                </div> 

                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="analyticsScriptsFooter"><?= t('Analytiikka'); ?></label>
                    <?= $form->textarea('analyticsScriptsFooter', $config->get('cookies.consent_analyticsScriptsFooter')); ?>
                </div> 

                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="marketingScriptsFooter"><?= t('Markkinointi'); ?></label>
                    <?= $form->textarea('marketingScriptsFooter', $config->get('cookies.consent_marketingScriptsFooter')); ?>
                </div> 
                
                <input class="btn btn-primary" type="submit" style="margin-top: 40px;" value="<?= t('Save'); ?>">
            </form>
        </div>

    </div>
</div>

<?php   echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);?>

