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
					print("<link rel=\"alternate\" href=\"".SITE_URL."/".SITE_LANG_LIST[$i]."/".$page_filename."\" hreflang=\"".SITE_LANG_LIST[$i]."\" />");
				}
			}
			if (! empty(SITE_LANG_DEFAULT)) {
				print("<link rel=\"alternate\" href=\"".SITE_URL."/".SITE_LANG_DEFAULT."/".$page_filename."\" hreflang=\"x-default\" />");
			}
		?>
	</head>
	<body>
		<header>
			<nav><a href="index.php">Home</a> <a href="page1.php">Page 1</a> <a href="page2.php">Page 2</a> <?php
				$HasSlash = (substr(SITE_URL,strlen(SITE_URL)-1,1) == "/");
				for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
					if (SITE_LANG !== SITE_LANG_LIST[$i]) {
						if ($HasSlash) {
							print("<a href=\"".SITE_URL.SITE_LANG_LIST[$i]."/".$page_filename."\">".strtoupper(SITE_LANG_LIST[$i])."</a>");
						}
						else {
							print("<a href=\"".SITE_URL."/".SITE_LANG_LIST[$i]."/".$page_filename."\">".strtoupper(SITE_LANG_LIST[$i])."</a>");
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
