<?php
	// Simple Multilingual Site
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

?><!DOCTYPE html>
<html lang="<?php print(SITE_LANG); ?>">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
		<title><?php print(htmlentities($page_title, ENT_COMPAT, "UTF-8")); ?></title>
		<link rel="canonical" href="<?php print(SITE_URL."/".SITE_LANG."/".$page_filename); ?>" />
		<?php
			for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
				if (SITE_LANG !== SITE_LANG_LIST[$i]) {
					print("<link rel=\"alternate\" href=\"".SITE_URL."/".SITE_LANG_LIST[$i]."/".$page_filename."\" hreflang=\"".SITE_LANG_LIST[$i]."\" />\n");
				}
			}
			if (! empty(SITE_LANG_DEFAULT)) {
				print("<link rel=\"alternate\" href=\"".SITE_URL."/".SITE_LANG_DEFAULT."/".$page_filename."\" hreflang=\"x-default\" />\n");
			}
			if (defined("APPLE_APP_ID") && (! empty(APPLE_APP_ID))) {
				print("<meta name=\"apple-itunes-app\" content=\"app-id=".APPLE_APP_ID."\" />\n");
			}
			if (defined("META_ROBOTS") && (! empty(META_ROBOTS))) {
				print("<META NAME=\"ROBOTS\" CONTENT=\"".META_ROBOTS."\">\n");
			}
			if (defined("FAVICON_URL") && (! empty(FAVICON_URL))) {
				print("<link rel=\"icon\" type=\"image/x-icon\" href=\"".FAVICON_URL."\">\n");
			}
		?>
	</head>
	<body>
		<header>
			<nav><a href="index.php">Home</a> <a href="page1.php">Page 1</a> <a href="page2.php">Page 2</a> <?php
				for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
					if (SITE_LANG !== SITE_LANG_LIST[$i]) {
						if (file_exists(__DIR__."/../img/flags/".strtolower(SITE_LANG_LIST[$i]).".png")) {
							print("<a href=\"../".SITE_LANG_LIST[$i]."/".$page_filename."\"><img src=\"../img/flags/".strtolower(SITE_LANG_LIST[$i]).".png\" class=\"flag\" alt=\"".strtoupper(SITE_LANG_LIST[$i])."\"></a> ");
						}
						else {
							print("<a href=\"../".SITE_LANG_LIST[$i]."/".$page_filename."\">".strtoupper(SITE_LANG_LIST[$i])."</a> ");
						}
					}
				}
			?></nav>
			<h1><?php
				print(htmlentities($page_title, ENT_COMPAT, "UTF-8"));
			?></h1>
		</header>
		<section><?php
			print($page_content);
		?></section>
		<footer>
			<p>&copy; <?php
				print(COPYRIGHT_FIRST_YEAR.((COPYRIGHT_FIRST_YEAR<date("Y"))?"-".date("Y"):""));
				if (! empty(COPYRIGHT_PUBLISHER_URL)) {
					print("<a href=\"".COPYRIGHT_PUBLISHER_URL."\">".COPYRIGHT_PUBLISHER_NAME."</a>");
				}
				else {
					print(COPYRIGHT_PUBLISHER_NAME);
				}
			?></p>
		</footer>
	</body>
</html>
