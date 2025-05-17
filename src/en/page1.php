<?php
	// Simple Multilingual Site
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

	require_once(__DIR__."/__local_settings-dist.inc.php");
	require_once(__DIR__."/../__common_settings-dist.inc.php");

	// *****************************************
	// * Fill this variables with your content *
	// *****************************************

	$page_title = "Page 1 in ".SITE_LANG;
	$page_content = <<<HTML
<article>
	<p>First page</p>
<article>
HTML;
	$page_template = DEFAULT_PAGE_TEMPLATE;
	$page_filename = "page1.php";

	// *****************************************

	if (file_exists($page_template)) {
		require_once($page_template);
	}
	else {
		require_once(__DIR__."/404.php");
	}
