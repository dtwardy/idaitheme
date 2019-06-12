<?php
/**********************************************************************/
/* @file plugins/themes/cedistheme/CedisTheme.inc.php *****************/
/**********************************************************************/
/* Copyright (c) 2019 Free University of Berlin ***********************/
/* Developed by Dennis Twardy (kontakt@dennistwardy.com) **************/
/* Distributed under the GNU GPL v3. For full terms see LICENSE. ******/
/**********************************************************************/
/* Based on PKP's code (see github.com/pkp/ojs) by John Willinsky and */
/* Simon Fraser University ********************************************/
/**********************************************************************/
/* @class CedisTheme **************************************************/
/* @ingroup plugins_themes_cedistheme *********************************/
/**********************************************************************/

import('lib.pkp.classes.plugins.ThemePlugin');
import('classes.file.PublicFileManager');

include('debug.php');

class CedisTheme extends ThemePlugin {

  /**
	 * @copydoc ThemePlugin::isActive()
	 */
	public function isActive() {
		if (defined('SESSION_DISABLE_INIT')) return true;
		return parent::isActive();
  }
  
  public function init() {
    // Register options

    // Colour Scheme#
    $this->addOption('mainColour', 'colour', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.mainColourLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.mainColourDescription',
      'default' => '#B56357'
    ));
    $this->addOption('secondaryColour', 'colour', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.secondColourLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.secondColourDescription',
      'default' => '#B4DBC0'
    ));
    $this->addOption('neutralColour', 'colour', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.neutralColourLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.neutralColourDescription',
      'default' => '#8D8E8A'
    ));

    // Header Bright/Dark
    $this->addOption('headerBright', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.headerBrightLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.headerBrightDescription',
      'options' => array(
        'bright' => 'plugins.themes.cedistheme.option.cedisTheme.headerBrightBright',
        'dark' => 'plugins.themes.cedistheme.option.cedisTheme.headerBrightDark'
      )
    ));

    // Logo as header background
    $this->addOption('headerBackground', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.headerBackgroundLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.headerBackgroundDescription',
      'options' => array(
        'logo' => 'plugins.themes.cedistheme.option.cedisTheme.headerBackgroundLogo',
        'banner' => 'plugins.themes.cedistheme.option.cedisTheme.headerBackgroundBanner'
      )
    ));

    // Hero Option
    $this->addOption('hero', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.heroLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.heroDescription',
      'options' => array(
          'enabled' => 'plugins.themes.cedistheme.option.cedisTheme.heroEnabled',
          'disabled' => 'plugins.themes.cedistheme.option.cedisTheme.heroDisabled'
      )
    ));
    $this->addOption('heroClaim', 'text', array(
        'label' => 'plugins.themes.cedistheme.option.cedisTheme.heroClaimLabel',
        'description' => 'plugins.themes.cedistheme.option.cedisTheme.heroClaimDescription'
    ));
    $this->addOption('heroClaimColour', 'colour', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.heroClaimColourLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.heroClaimColourDescription',
      'default' => '#FFF'
    ));
    $this->addOption('heroSize', 'text', array (
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.heroSizeLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.heroSizeDescription',
      'default' => '350px'
    ));

    // Journal Description Position Option
    $this->addOption('jourdescription', 'radio', array(
        'label' => 'plugins.themes.cedistheme.option.cedisTheme.jourdescriptionLabel',
        'description' => 'plugins.themes.cedistheme.option.cedisTheme.jourdescriptionDescription',
        'options' => array(
            'above' => 'plugins.themes.cedistheme.option.cedisTheme.jourdescriptionAbove',
            'below' => 'plugins.themes.cedistheme.option.cedisTheme.jourdescriptionBelow',
            'off' => 'plugins.themes.cedistheme.option.cedisTheme.jourdescriptionOff'
        )
    ));

    // Sidebar Position
    $this->addOption('sidebarPosition', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.sidebarPositionLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.sidebarPositionDescription',
      'options' => array(
        'right' => 'plugins.themes.cedistheme.option.cedisTheme.sidebarPositionRight',
        'left' => 'plugins.themes.cedistheme.option.cedisTheme.sidebarPositionLeft',
        //'off' => 'plugins.themes.cedistheme.option.cedisTheme.sidebarPositionOff'
      )
    ));

    // Journal Headling font
    $this->addOption('headlineFont', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontDescription',
      'options' => array(
        'Arial' => 'plugins.themes.cedistheme.option.cedisTheme.FontArial',
        'Georgia' => 'plugins.themes.cedistheme.option.cedisTheme.FontGeorgia',
        'NotoSans' => 'plugins.themes.cedistheme.option.cedisTheme.FontNotoSans',
        'NotoSerif' => 'plugins.themes.cedistheme.option.cedisTheme.FontNotoSerif',
        'FiraSans' => 'plugins.themes.cedistheme.option.cedisTheme.FontFiraSans',
        'SourceSansPro' => 'plugins.themes.cedistheme.option.cedisTheme.FontSourceSansPro',
        'Merriweather' => 'plugins.themes.cedistheme.option.cedisTheme.FontMerriweather',
        'MerriweatherSans' => 'plugins.themes.cedistheme.option.cedisTheme.FontMerriweatherSans'
      )
    ));

    // Journal Body font
    $this->addOption('bodyFont', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontDescription',
      'options' => array(
        'Arial' => 'plugins.themes.cedistheme.option.cedisTheme.FontArial',
        'Georgia' => 'plugins.themes.cedistheme.option.cedisTheme.FontGeorgia',
        'NotoSans' => 'plugins.themes.cedistheme.option.cedisTheme.FontNotoSans',
        'NotoSerif' => 'plugins.themes.cedistheme.option.cedisTheme.FontNotoSerif',
        'FiraSans' => 'plugins.themes.cedistheme.option.cedisTheme.FontFiraSans',
        'SourceSansPro' => 'plugins.themes.cedistheme.option.cedisTheme.FontSourceSansPro',
        'Merriweather' => 'plugins.themes.cedistheme.option.cedisTheme.FontMerriweather',
        'MerriweatherSans' => 'plugins.themes.cedistheme.option.cedisTheme.FontMerriweatherSans'
      )
    ));

    // Base size
    $this->addOption('baseSize', 'text', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.baseSizeLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.baseSizeDescription',
      'default' => '10px'
    ));

    // Border Styles
    $this->addOption('structureStyle', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.borderStylesLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.borderStylesDescription',
      'options' => array(
        'clean' => 'plugins.themes.cedistheme.option.cedisTheme.borderStylesOff',
        'horizontalBorders' => 'plugins.themes.cedistheme.option.cedisTheme.borderStylesHorizontal',
        'blocks' => 'plugins.themes.cedistheme.option.cedisTheme.borderStylesDefault'
      )
    ));

    // Load jQuery from a CDN or, if CDNs are disabled, from a local copy.
    $min = Config::getVar('general', 'enable_minified') ? '.min' : '';
    $request = Application::getRequest();
    if (Config::getVar('general', 'enable_cdn')) {
      $jquery = '//ajax.googleapis.com/ajax/libs/jquery/' . CDN_JQUERY_VERSION . '/jquery' . $min . '.js';
      $jqueryUI = '//ajax.googleapis.com/ajax/libs/jqueryui/' . CDN_JQUERY_UI_VERSION . '/jquery-ui' . $min . '.js';
    } else {
      // Use OJS's built-in jQuery files
      $jquery = $request->getBaseUrl() . '/lib/pkp/lib/components/jquery/jquery' . $min . '.js';
      $jqueryUI = $request->getBaseUrl() . '/lib/pkp/lib/components/jquery-ui/jquery-ui' . $min . '.js';
    }

    $request = Application::getRequest();

    // Load jQuery from a CDN or, if CDNs are disabled, from a local copy.
		$min = Config::getVar('general', 'enable_minified') ? '.min' : '';
		if (Config::getVar('general', 'enable_cdn')) {
			$jquery = '//ajax.googleapis.com/ajax/libs/jquery/' . CDN_JQUERY_VERSION . '/jquery' . $min . '.js';
			$jqueryUI = '//ajax.googleapis.com/ajax/libs/jqueryui/' . CDN_JQUERY_UI_VERSION . '/jquery-ui' . $min . '.js';
		} else {
			// Use OJS's built-in jQuery files
			$jquery = $request->getBaseUrl() . '/lib/pkp/lib/components/jquery/jquery' . $min . '.js';
			$jqueryUI = $request->getBaseUrl() . '/lib/pkp/lib/components/jquery-ui/jquery-ui' . $min . '.js';
		}
		// Use an empty `baseUrl` argument to prevent the theme from looking for
		// the files within the theme directory
		$this->addScript('jQuery', $jquery, array('baseUrl' => ''));
		$this->addScript('jQueryUI', $jqueryUI, array('baseUrl' => ''));
		$this->addScript('jQueryTagIt', $request->getBaseUrl() . '/lib/pkp/js/lib/jquery/plugins/jquery.tag-it.js', array('baseUrl' => ''));
		// Load Bootsrap's dropdown
		$this->addScript('popper', 'js/lib/popper/popper.js');
		$this->addScript('bsUtil', 'js/lib/bootstrap/util.js');
		$this->addScript('bsDropdown', 'js/lib/bootstrap/dropdown.js');
		// Load custom JavaScript for this theme
    $this->addScript('default', 'js/main.js');
    
		// Add navigation menu areas for this theme
		$this->addMenuArea(array('primary', 'user'));


    // Load primary stylesheet
    $this->addStyle('stylesheet', 'styles/index.less');
    
    // Variable to hold Less variables
    $additionalLessVariables = array();

    $primColour = $this->getOption('mainColour');
    $secondColour = $this->getOption('secondaryColour');
    $neutColour = $this->getOption('neutralColour');
    $additionalLessVariables[] = '@highlightColour: ' . $primColour . ';';
    $additionalLessVariables[] = '@contrastColour: ' . $secondColour . ';';
    $additionalLessVariables[] = '@neutralColour: ' . $neutColour . ';';
    $additionalLessVariables[] = '@bg-base: ' . $primColour . ';';
    $additionalLessVariables[] = '@primary: ' . $primColour . ';';

    // Calculate mainColour's brightness and change menu font colour accordingly
    if (hexdec(substr($primColour, 1, 2)) + hexdec(substr($primColour, 3, 2)) + hexdec(substr($primColour, 5, 2)) > 430) {
      $additionalLessVariables[] = '@menuColour: #111;';
    } else {
      $additionalLessVariables[] = '@menuColour: #FFF;';
    }

    // Calculate neutralColour's brightness and change footer font colour accordingly
    if (hexdec(substr($primColour, 1, 2)) + hexdec(substr($neutColour, 3, 2)) + hexdec(substr($neutColour, 5, 2)) > 430) {
      $additionalLessVariables[] = '@footerColour: #111;';
    } else {
      $additionalLessVariables[] = '@footerColour: #FFF;';
    }

    $headerShade = $this->getOption('headerBright');
    if (empty($headerShade) || $headerShade === 'dark') {
      $additionalLessVariables[] = '@headerLight: false;';
    } else {
      $additionalLessVariables[] = 'headerLight: true;';
    }

    // READING LESS VARIABLES AND SETTING THEM COMES HERE
    // $additionalLessVariables[] = '@variableName' . $this->getOption('optionName') . ';'
    $currentJournal = $request->getJournal();
    $primLocale = $currentJournal->getPrimaryLocale();
    $pubFileManager = new PublicFileManager();
    $baseUrl = $request->getBaseUrl();
    $pubFilesUrl = $baseUrl . '/' . $pubFileManager->getJournalFilesPath($currentJournal->getId());
    $SysPubDir = Config::getVar('files', 'public_files_dir');
    $pubFilesDir = BASE_SYS_DIR . '/'. $SysPubDir . '/' . 'journals/' . $currentJournal->getId();
    $SysPubUrl = $baseUrl . '/' . $SysPubDir . '/';

    $additionalLessVariables[] = '@pubFiles: \'' . $SysPubUrl .'\';';

    if (file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.png') ||
        file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.jpg') ||
        file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.webp') ||
        file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.svg')) {
      $additionalLessVariables[] = '@headerHasLogo: true;';
      
    } else {
      $additionalLessVariables[] = '@headerHasLogo: false;';
    }

    $headerLogoState = $this->getOption('headerBackground');
    if (empty($headerLogoState) || $headerLogoState === 'logo') {
      $additionalLessVariables[] = '@headerLogoState: \'logo\';';
      $additionalLessVariables[] = '@headerBackground: \'none\';';
      
    } else {
      $additionalLessVariables[] = '@headerLogoState: \'banner\';';

      if (file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.png')) {
        $additionalLessVariables[] = '@headerBackground: url(\'' . $pubFilesUrl . '/pageHeaderLogoImage_' . $primLocale . '.png\');';
      } elseif (file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.jpg')) {
        $additionalLessVariables[] = '@headerBackground: url(\'' . $pubFilesUrl . '/pageHeaderLogoImage_' . $primLocale . '.jpg\');';
      } elseif (file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.webp')) {
        $additionalLessVariables[] = '@headerBackground: url(\'' . $pubFilesUrl . '/pageHeaderLogoImage_' . $primLocale . '.webp\');';
      } elseif (file_exists($pubFilesDir . '/pageHeaderLogoImage_' . $primLocale . '.svg')) {
        $additionalLessVariables[] = '@headerBackground: url(\'' . $pubFilesUrl . '/pageHeaderLogoImage_' . $primLocale . '.svg\');';
      }
    }


    $heroState = $this->getOption('hero');
    if (empty($heroState) || $heroState === 'disabled') {
      $additionalLessVariables[] = '@hero: false;';
    } else {
      if (file_exists($pubFilesDir . '/homepageImage_' . $primLocale . '.jpg')) {
        $additionalLessVariables[] = '@hero: true;';
        $additionalLessVariables[] = '@heroBackground: url(\'' . $pubFilesUrl . '/homepageImage_'  . $primLocale  . '.jpg\');';
      } elseif (file_exists($pubFilesDir . '/homepageImage_' . $primLocale . '.png')) {
        $additionalLessVariables[] = '@hero: true;';
        $additionalLessVariables[] = '@heroBackground: url(\'' . $pubFilesUrl . '/homepageImage_'  . $primLocale  . '.png\');';
      } elseif (file_exists($pubFilesDir . '/homepageImage_' . $primLocale . '.webp')) {
        $additionalLessVariables[] = '@hero: true;';
        $additionalLessVariables[] = '@heroBackground: url(\'' . $pubFilesUrl . '/homepageImage_'  . $primLocale  . '.webp\');';
      } elseif (file_exists($pubFilesDir . '/homepageImage_' . $primLocale . '.svg')) {
        $additionalLessVariables[] = '@hero: true;';
        $additionalLessVariables[] = '@heroBackground: url(\'' . $pubFilesUrl . '/homepageImage_'  . $primLocale  . '.svg\');';
      }
    }

    $heroClaimText = $this->getOption('heroClaim');
    if (!empty($heroClaimText)) {
      $additionalLessVariables[] = '@heroClaimText: \'' . $heroClaimText . '\';';
    } else {
      $additionalLessVariables[] = '@heroClaimText: \' \’;';
    }
    $heroColour = $this->getOption('heroClaimColour');
    if (!empty($heroColour)) {
      $additionalLessVariables[] = '@heroClaimColour: ' . $heroColour . ';';
    } else {
      $additionalLessVariables[] = '@heroClaimColour: #FFF;';
    }
    $heroSizeOpt = $this->getOption('heroSize');
    if (!empty($heroSizeOpt)) {
      $additionalLessVariables[] = '@heroSize: ' . $heroSizeOpt  . ';';
    } else {
      $additionalLessVariables[] = '@heroSize: 350px;';
    }
      
    $descriptionTextPosition = $this->getOption('jourdescription');
    if (empty($descriptionTextPosition) || $descriptionTextPosition === 'above') {
      $additionalLessVariables[] = '@descriptionTextState: \'above\';';
    } elseif ($descriptionTextPosition === 'below') {
      $additionalLessVariables[] = '@descriptionTextState: \'below\';';  
    } else {
      $additionalLessVariables[] = '@descriptionTextState: \'off\';';
    }

    $sidebarSetting = $this->getOption('sidebarPosition');
    if (empty($sidebarSetting) || $sidebarSetting === 'right') {
      $additionalLessVariables[] = '@sidebarPosition: \'right\';';
    } elseif ($sidebarSetting === 'left') {
      $additionalLessVariables[] = '@sidebarPosition: \'left\';';
    } else {
      $additionalLessVariables[] = '@sidebarPosition: \'off\';';
    }

    $headlineFontOpt = $this->getOption('headlineFont');
    //ChromePhp::log('$headlineFontOpt: ' . $headlineFontOpt);
    if (empty($headlineFontOpt) || $headlineFontOpt === 'MerriweatherSans') {
      $additionalLessVariables[] = '@headlineFont: \'MerriweatherSans\';';
    } elseif ($headlineFontOpt === 'Georgia') {
      $additionalLessVariables[] = '@headlineFont: \'Georgia\';';
    } elseif ($headlineFontOpt === 'NotoSans') {
      $additionalLessVariables[] = '@headlineFont: \'NotoSans\';';
    } elseif ($headlineFontOpt === 'NotoSerif') {
      $additionalLessVariables[] = '@headlineFont: \'NotoSerif\';';
    } elseif ($headlineFontOpt === 'FiraSans') {
      $additionalLessVariables[] = '@headlineFont: \'FiraSans\';';
    } elseif ($headlineFontOpt === 'SourceSansPro') {
      $additionalLessVariables[] = '@headlineFont: \'SourceSansPro\';';
    } elseif ($headlineFontOpt === 'Merriweather') {
      $additionalLessVariables[] = '@headlineFont: \'Merriweather\';';
    } else {
      $additionalLessVariables[] = '@headlineFont: \'Arial\';';
    }

    $bodyFontOpt = $this->getOption('bodyFont');
    //ChromePhp::log('$bodyFontOpt: ' . $bodyFontOpt);
    if (empty($headlineFontOpt) || $bodyFontOpt === 'MerriweatherSans') {
      $additionalLessVariables[] = '@bodyFont: \'MerriweatherSans\';';
    } elseif ($bodyFontOpt === 'Georgia') {
      $additionalLessVariables[] = '@bodyFont: \'Georgia\';';
    } elseif ($bodyFontOpt === 'NotoSans') {
      $additionalLessVariables[] = '@bodyFont: \'NotoSans\';';
    } elseif ($bodyFontOpt === 'NotoSerif') {
      $additionalLessVariables[] = '@bodyFont: \'NotoSerif\';';
    } elseif ($bodyFontOpt === 'FiraSans') {
      $additionalLessVariables[] = '@bodyFont: \'FiraSans\';';
    } elseif ($bodyFontOpt === 'SourceSansPro') {
      $additionalLessVariables[] = '@bodyFont: \'SourceSansPro\';';
    } elseif ($bodyFontOpt === 'Merriweather') {
      $additionalLessVariables[] = '@bodyFont: \'Merriweather\';';
    } else {
      $additionalLessVariables[] = '@bodyFont: \'Arial\';';
    }

    $baseSizeOpt = $this->getOption('baseSize');
    if (!empty($baseSizeOpt)) {
      $additionalLessVariables[] = '@base: ' . $baseSizeOpt . ';';
    }

    $structureStyleOpt = $this->getOption('structureStyle');
    if (empty($structureStyleOpt) || $structureStyleOpt === 'clean' ) {
      $additionalLessVariables[] = '@structureStyle: \'clean\';';
    } elseif ($structureStyleOpt === 'horizontalBorders') {
      $additionalLessVariables[] = '@structureStyle: \'horizontalBorders\';';
    } elseif ($structureStyleOpt === 'blocks') {
      $additionalLessVariables[] = '@structureStyle: \'blocks\';';
    }


    // ---
    // Pass additional LESS variables based on options
    // ---
    if (!empty($additionalLessVariables)) {
			$this->modifyStyle('stylesheet', array('addLessVariables' => join($additionalLessVariables)));
		}

  }
  function getContextSpecificPluginSettingsFile() {
    return $this->getPluginPath() . '/settings.xml';
  }
  function getInstallSitePluginSettingsFile() {
    return $this->getPluginPath() . '/settings.xml';
  }
  function getDisplayName() {
    return __('plugins.themes.cedistheme.name');
  }
  function getDescription() {
    return __('plugins.themes.cedistheme.description');
  }
}
?>
