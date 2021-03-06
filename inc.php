<?php // This file is part of LibreQR, which is distributed under the GNU AGPLv3+ license

// ----- This file is included everywhere -----

require "config.inc.php";

define("DEFAULT_REDUNDANCY", "high");
define("DEFAULT_MARGIN", NULL);
define("DEFAULT_SIZE", NULL);
define("DEFAULT_BGCOLOR", "FFFFFF");
define("DEFAULT_MAINCOLOR", "000000");

$libreqrVersion = "1.4.0dev";

// Defines the locale to be used
if ($forceLocale == false AND isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
  $clientLocales = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
  $clientLocales = preg_replace("#[A-Z0-9]|q=|;|-|\.#", "", $clientLocales);
  $clientLocales = explode(',', $clientLocales);
  $availableLocales = array('en', 'fr', 'oc', 'template');
  foreach ($clientLocales as $clientLocale) {
    if (in_array($clientLocale, $availableLocales)) {
      $locale = $clientLocale;
      break;
    }
  }
}
require "locales/" . $locale . ".php";

// Defines the root URL
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
  $protocol = "https";
else
  $protocol = "http";
$rootPath = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$rootPath = preg_replace('#\?.*$#', '', $rootPath);
$rootPath = preg_replace('#(manifest|opensearch|index).php$#i', '', $rootPath);

require "themes/" . $theme . "/theme.php"; // Load theme
