<?php
	// Simple Multilingual Site
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

	require_once(__DIR__."/__common_settings-dist.inc.php");

	$lang_to_use = "";

	if (empty($lang_to_use) && isset($_GET) && isset($_GET["lng"])) {
		$lng = strtolower(substr(trim($_GET["lng"]),0,2));
		for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
			if ($lng == SITE_LANG_LIST[$i]) {
				$lang_to_use = $lng;
				break;
			}
		}
	}

	if (empty($lang_to_use) && isset($_SERVER) && isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
		$tab = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
		for ($j = 0; $j < count($tab); $j++) {
			$lng = strtolower(substr(trim($tab[$j]),0,2));
			for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
				if ($lng == SITE_LANG_LIST[$i]) {
					$lang_to_use = $lng;
					break;
				}
			}
			if (! empty($lang_to_use))
				break;
		}
	}

	if (empty($lang_to_use) && (! empty(SITE_LANG_DEFAULT))) {
		$lang_to_use = SITE_LANG_DEFAULT;
	}

	if (empty($lang_to_use)) {
		require_once(__DIR__."/404.php");
	}
	else {
		http_response_code(403);
		header("location: ./".$lang_to_use."/");
	}
