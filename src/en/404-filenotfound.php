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

	$page_title = "File not found";
	$page_text_top = <<<HTML
<p>This page doesn't exist.</p>
HTML;
	$page_template = DEFAULT_PAGE_TEMPLATE;
	$page_filename = "404-filenotfound.php";
	http_response_code(404);

	// *****************************************

	if (file_exists($page_template)) {
		require_once($page_template);
	}
	else {
		require_once(_DIR_."/../404-filenotfound.php");
	}
