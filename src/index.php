<?php
	// Simple Multilingual Site
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

	function PageNotFound($lang_to_use = "") {
		if (! empty($lang_to_use)) {
			header("location: ".SITE_URL."/".$lang_to_use."/404-filenotfound.php");
			die();
		}
		else {
			http_response_code(404);
			die("Page not found");
		}
	}

	require_once(__DIR__."/__common_settings-dist.inc.php");

	// ********************************************************************************
	// What language to use ?

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
		PageNotFound();
	}

	// ********************************************************************************
	// What page to show ?

	$page = "";
	if ((! isset($_SERVER["REQUEST_URI"])) || empty($_SERVER["REQUEST_URI"]) || (false !== strrpos(SITE_URL, $_SERVER["REQUEST_URI"])) || (false !== strrpos(SITE_URL."/", $_SERVER["REQUEST_URI"]))) {
		$page = "index.php";
	}
	else if ((($lng=$lang_to_use."/") == substr($_SERVER["REQUEST_URI"],0,strlen($lng))) || (($lng="/".$lang_to_use."/") == substr($_SERVER["REQUEST_URI"],0,strlen($lng)))) {
		$page = ""; // file in a language subfolder not found
	}
	else if ("/" == substr($_SERVER["REQUEST_URI"],0,1)) {
		$page = substr($_SERVER["REQUEST_URI"],1);
	}
	else {
		$page = $_SERVER["REQUEST_URI"];
	}

	// var_dump($page);exit;
	// var_dump($_SERVER["REQUEST_URI"]);exit;
	// var_dump(_IsLocal);exit;

	if (empty($page)) {
		PageNotFound();
	}
	else {
		http_response_code(301);
		header("location: ".SITE_URL."/".$lang_to_use."/".$page);
	}
