<?php
	// Simple Multilingual Site
	// (c) 2026 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Simple-Multilingual-Site

	if (! function_exists('getNewIdString')) {
		function getNewIdString($size = 10) {
			$id = "";
			while (strlen($id) < $size) {
				$num = mt_rand(1, 10+26+26)-1;
				if ($num < 10) {
					$id .= chr(ord('0')+$num);
				}
				else if ($num < 10+26) {
					$id .= chr(ord('a')+$num-10);
				}
				else if ($num < 10+26+26) {
					$id .= chr(ord('A')+$num-10-26);
				}
			}
			return $id;
		}
	}

	require_once(__DIR__."/__common_settings-dist.inc.php");

	$IndexNowFilePath = __DIR__."/data-2gh4df5gfhj/indexnow.json";
	if ((! file_exists($IndexNowFilePath)) || (false === ($json = file_get_contents($IndexNowFilePath))) || (false === ($IndexNow = json_decode($json))) || (! is_object($IndexNow))) {
		$IndexNow = new StdClass;
		$IndexNow->TimeStamp = time()-24*60*60; // pourra envoyer les URL modifiées depuis 24 heures
		$IndexNow->Key = getNewIdString(mt_rand(20,100));
		file_put_contents($IndexNowFilePath, json_encode($IndexNow));
		file_put_contents(__DIR__."/IndexNow-".$IndexNow->Key.".txt", $IndexNow->Key);
	}
	// print($IndexNow->TimeStamp."<br>");
	$urls = array();
	for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
		$path = __DIR__."/".SITE_LANG_LIST[$i];
		if (false !== ($files = scandir($path))) {
			// var_dump($files);exit;
			for ($j = 0; $j < count($files); $j++) {
				if (("." !== substr($files[$j],0,1)) && (false === strpos(strtolower($files[$j]),".inc.php")) && ($files[$j] !== "404-filenotfound.php") && (is_file($path."/".$files[$j])) && (filemtime($path."/".$files[$j]) >= $IndexNow->TimeStamp)) {
					$urls[] = SITE_URL."/".SITE_LANG_LIST[$i]."/".$files[$j];
				}
				// print($path."/".$files[$j]." : ".filemtime($path."/".$files[$j])."<br>");
			}
		}
	}

	// var_dump($urls);exit;

	if (count($urls) > 0) {

		// Documentation : https://www.indexnow.org/documentation
		// Chez Bing : https://www.bing.com/indexnow/getstarted
		
		$param = new stdClass();
		$param->host = substr(SITE_URL, strpos(SITE_URL, "//")+2);
		$param->key = $IndexNow->Key;
		$param->urlList = $urls;
		$param->keyLocation = GetAbsoluteURL("/IndexNow-".$IndexNow->Key.".txt");

		try {
			$curl = curl_init(_IndexNowSearchEngine);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($param));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json; charset=utf-8"]);

			curl_exec($curl);

			if (curl_errno($curl)) {
				throw new Exception(curl_error($curl));
			}
			else {
				$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				if (200 === $httpCode) { // url(s) accepted
					$IndexNow->TimeStamp = time();
					file_put_contents($IndexNowFilePath, json_encode($IndexNow));
				}
				else if (202 === $httpCode) { // key validation pending
					throw new Exception("Pending for index now key validation");
				}
				else {
					throw new Exception("HTTP Error ".$httpCode." \n\n".var_export($param,true));
				}
			}
		}
		finally {
			curl_close($curl);
		}
	}
