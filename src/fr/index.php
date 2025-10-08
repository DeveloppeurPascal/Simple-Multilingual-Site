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

	$page_title = "Site multilingue simple";
	$page_content = <<<HTML
<article>
	<p>Contenu de cette page en tant que text HTML.</p>
<article>
HTML;
	$page_template = DEFAULT_PAGE_TEMPLATE;
	$page_filename = "index.php";

	// *****************************************

	if (file_exists($page_template)) {
		require_once($page_template);
	}
	else {
		require_once(__DIR__."/404-filenotfound.php");
	}
