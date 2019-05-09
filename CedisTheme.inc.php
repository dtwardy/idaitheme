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
      'default' => '#1E6292'
    ));
    $this->addOption('secondColour', 'colour', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.secondColourLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.secondColourDescription',
      'default' => '#1E6292'
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

    // Journal Headling font
    $this->addOption('headlineFont', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontDescription',
      'options' => array(
        'font1' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontFont1',
        'font2' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontFont2',
        'font3' => 'plugins.themes.cedistheme.option.cedisTheme.headlineFontFont3'
      )
    ));

    // Journal Body font
    $this->addOption('bodyFont', 'radio', array(
      'label' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontLabel',
      'description' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontDescription',
      'options' => array(
        'font1' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontFont1',
        'font2' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontFont2',
        'font3' => 'plugins.themes.cedistheme.option.cedisTheme.bodyFontFont3'
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

    // READING LESS VARIABLES AND SETTING THEM COMES HERE
    // $additionalLessVariables[] = '@variableName' . $this->getOption('optionName') . ';'

    $heroState = $this->getOption('hero');
    if (empty($heroState) || $heroState === 'disabled') {
      $additionalLessVariables[] = '@hero: false;';
    } else {
      $additionalLessVariables[] = '@hero: true;';
    }
     
    $descriptionTextPosition = $this->getOption('jourdescription');
    if (empty($descriptionTextPosition) || $descriptionTextPosition === 'above') {
      $additionalLessVariables[] = '@descriptionTextAbove: true;';
    } else {
      $additionalLessVariables[] = '@descriptionTextAbove: false;';  
    }

    // Pass additional LESS variables based on options
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
