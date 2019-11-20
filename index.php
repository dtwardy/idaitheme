<?php
/**********************************************************************/
/* @file plugins/themes/idaitheme/index.php ***************************/
/**********************************************************************/
/* Copyright (c) 2019 German Archaeological Institute *****************/
/* Developed by Dennis Twardy (dennistwardy86@gmail.com) **************/
/* Distributed under the GNU GPL v3. For full terms see LICENSE. ******/
/**********************************************************************/
/* Based on PKP's code (see github.com/pkp/ojs) by John Willinsky and */
/* Simon Fraser University ********************************************/
/**********************************************************************/
/* @ingroup plugins_themes_idaitheme **********************************/
/* @brief wrapper for IDaiTheme plugin ********************************/
/**********************************************************************/

  require_once('IDaiTheme.inc.php');
  return new IDaiTheme();
?>
