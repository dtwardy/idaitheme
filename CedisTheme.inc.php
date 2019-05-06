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
    $this->addOption('hero', 'checkbox', array(
      'label' => 'plugins.themes.cedistheme.options.cedisTheme.label',
      'description' => 'plugins.themes.cedistheme.options.cedisTheme.description'
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

    // Use an empty `baseUrl` argument to prevent the theme from looking for
    // the files within the theme directory
    /* $this->addScript('jQuery', $jquery, array('baseUrl' => ''));
    $this->addScript('jQueryUI', $jqueryUI, array('baseUrl' => ''));
    $this->addScript('jQueryTagIt', $request->getBaseUrl() . '/lib/pkp/js/lib/jquery/plugins/jquery.tag-it.js', array('baseUrl' => ''));*/

    // Load primary stylesheet
		$this->addStyle('stylesheet', 'styles/index.less');
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
