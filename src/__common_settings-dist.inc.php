<?php
	// Simple Multilingual Site
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// !!! NEVER CHANGE THIS FILE ON YOUR SITES !!!
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	// This file contains the default settings of the software.
	// It will be overwritten each time the code repository is
	// updated when there are changes in default values or new
	// settings. Never modify it directly.
	//
	// For localhost server, copy your defines in a "./__common_settings-localhost.inc.php" file.
	//
	// For real domaine or IP, copy your defines in a "./__common_settings-web.inc.php" file.

	if (("127.0.0.1" == $_SERVER["SERVER_ADDR"]) || ("::1" == $_SERVER["SERVER_ADDR"])) {
		// parameters for a localhost web site (dev, debug, test)
		@include_once(__DIR__."/__common_settings-localhost.inc.php");
	} else {
		// parameters for a real domain name or IP (release)
		@include_once(__DIR__."/__common_settings-web.inc.php");
	}

	// *************************************************
	// * Parameters you can define in your config file *
	// *************************************************

	// First year to show in the copyright texts as "(c) FIRSTYEAR" or "(c) FIRSTYEAR-CURRENTYEAR"
	if (!defined("COPYRIGHT_FIRST_YEAR"))
		define("COPYRIGHT_FIRST_YEAR", 2005);

	// Your URL to show as this site publisher in copyright texts
	if (!defined("COPYRIGHT_PUBLISHER_URL"))
		define("COPYRIGHT_PUBLISHER_URL", "");

	// Your name to show as this site publisher in copyright texts
	if (!defined("COPYRIGHT_PUBLISHER_NAME"))
		define("COPYRIGHT_PUBLISHER_NAME", "Your Publisher Name");

	// Your name to show as this site publisher in copyright texts
	if (!defined("DEFAULT_PAGE_TEMPLATE"))
		define("DEFAULT_PAGE_TEMPLATE", __DIR__."/theme/default.php");

	// Available languages for this website
	if (!defined("SITE_LANG_LIST"))
		define("SITE_LANG_LIST", ["fr","en","de"]);

	// Default language to use for this website
	if (!defined("SITE_LANG_DEFAULT"))
		define("SITE_LANG_DEFAULT", "en");

	// Absolute URL of your website
	if (!defined("SITE_URL"))
		define("SITE_URL", "http://localhost/Simple-Multilingual-Site/src");
		// define("SITE_URL", "https://mywebsite.zorglub.web");
		// define("SITE_URL", "https://mywebsite.zorglub.web/InAFolder/");
