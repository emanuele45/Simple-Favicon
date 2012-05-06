<?php
/**
 * Simple Favicon (SFI)
 *
 * @package SFI
 * @author emanuele
 * @copyright 2012, Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 0.1.0
 */

if (!defined('SMF'))
	die('Hacking attempt...');

function sfi_add_settings($config_vars)
{
	global $context, $txt, $sourcedir, $boardurl;

	loadLanguage('SimpleFavicon');

	$config_vars[] = array('text', 'sfi_set_new_favicon');

	if (isset($_GET['save']))
	{
		if (!empty($_POST['sfi_set_new_favicon']))
		{
			require_once($sourcedir . '/Subs-Package.php');
			// Let's see, just a small trick to see if it exists:
			// if it starts with http:// it's a url
			if (substr($_POST['sfi_set_new_favicon'], 0, 7) == 'http://')
			{
				$data = fetch_web_data($_POST['sfi_set_new_favicon']);

				if (empty($data))
					unset($_POST['sfi_set_new_favicon']);
			}
		}
	}
}

function sfi_add_favicon ()
{
	global $context, $modSettings;

	$context['html_headers'] .= '
	<link rel="shortcut icon" href="' . (!empty($modSettings['sfi_set_new_favicon']) ? $modSettings['sfi_set_new_favicon'] : '/favicon.ico') . '" />';
}

?>