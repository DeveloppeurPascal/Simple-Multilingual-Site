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
	// For localhost server, copy your defines in a "./__local_settings-localhost.inc.php" file.
	//
	// For real domaine or IP, copy your defines in a "./__local_settings-web.inc.php" file.

	if (("127.0.0.1" == $_SERVER["SERVER_ADDR"]) || ("::1" == $_SERVER["SERVER_ADDR"])) {
		// parameters for a localhost web site (dev, debug, test)
		@include_once(__DIR__."/__local_settings-localhost.inc.php");
	} else {
		// parameters for a real domain name or IP (release)
		@include_once(__DIR__."/__local_settings-web.inc.php");
	}

	// *************************************************
	// * Parameters you can define in your config file *
	// *************************************************

	// database server name or IP (localhost or other)
	if (!defined("SITE_LANG"))
		define("SITE_LANG", "fr");
