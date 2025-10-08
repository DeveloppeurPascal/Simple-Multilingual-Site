<?php
	// Simple Multilingual Site
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

	require_once(__DIR__."/__common_settings-dist.inc.php");

	$pages = array();

	for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
		$path = __DIR__."/".SITE_LANG_LIST[$i];
		if (false !== ($files = scandir($path))) {
			// var_dump($files);exit;
			for ($j = 0; $j < count($files); $j++) {
				if (("." !== substr($files[$j],0,1)) && (false === strpos(strtolower($files[$j]),".inc.php")) && ($files[$j] !== "404-filenotfound.php") && (is_file($path."/".$files[$j]))) {
					$pages[] = SITE_LANG_LIST[$i]."/".$files[$j];
				}
			}
		}
	}
	// var_dump($pages);exit;
?><?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><?php
	for ($i = 0; $i < count($pages); $i++) {
		print("<url><loc>".SITE_URL."/".$pages[$i]."</loc><lastmod>".date("Y-m-d",filemtime(__DIR__."/".$pages[$i]))."</lastmod></url>");
	}
?></urlset>