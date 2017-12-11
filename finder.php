<?php

/*
		[mod_head]
		Picks up the page response code and interprets.
		By default, Any return code other than 404 is interpreted as a white page.

		[mod_body]
		Takes specific string from the page and interprets.
		It is necessary to configure the non-existent page-specific string.
		By default, The string is "Not found".

		[mod_title]
		Picks up the page title and interprets.
		It is necessary to configure the title string.
		By default, The title string is "404".

*/

## ---## ---## ---## ---## ---## SETUP ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---##
$list = "list.txt"; 	#  <--	{!wordlist!}							 									 #
$response = "404"; 		#  <--	{!mod_head not found code!}				 									 #
$string_body = 'Sorry, we could not find the page you were looking for, please ensure you have typed the right address.';	 #  <--	{!mod_body 404 page string!} #
$string_title = 'Internal Server Error';	 						 #  <--	{!mod_title 404 page title!} #
## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---## ---##











#------------------------------------------------------ split screen
if (empty($argv[3])) {
echo
'
F1NDIN 1.0 by pablo verlly
https://github.com/pabloverlly

	OPTIONS:
	mod_head  <-> search using invalid page return code
	mod_body  <-> search using common text from invalid pages
	mod_title <-> search using invalid page title

	USAGE:
	php F1NDIN.php ["http://www.target.com/"] [asp/php/any] [mod_head/mod_body/mod_title]


	DEMOS:
	php finder.php "http://formsus.datasus.gov.br/" php mod_body
	php finder.php "http://formsus.datasus.gov.br/" php mod_head
	php finder.php "http://formsus.datasus.gov.br/" php mod_title

					!!! CONFIGURE THE SCRIPT BEFORE !!!
';
exit();
}
#---------------------------------------------------------------------





/* **** */					/* **** */					/* **** */
$host=$argv[1];
$ext=$argv[2];
$mod=$argv[3];
$list = explode("\n", file_get_contents($list));

/* **** */					/* **** */					/* **** */







/* **** */					/* **** */					/* **** */
 function getTitle($url) {
 	
 	$data  = file_get_contents($url);
    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
    return $title;
}
/* **** */					/* **** */					/* **** */






/* **** */					/* **** */					/* **** */
function mod_head($host, $word, $response) {

	$url = $host.$word."/";
	$headers = @get_headers($url);


	if(strpos($headers[0],'403') == true) {
			echo "\n\033[33m$url : FORBIDEN\033[0m"; //orange
		}

	elseif(strpos($headers[0],$response) === false) {
		  echo "\n\033[32m$url\033[0m";
		}

	else {
		  echo "\n\033[31m$url\033[0m";
		}
}
/* **** */					/* **** */					/* **** */







/* **** */					/* **** */					/* **** */
function mod_body($host, $word, $string_body){

	$url = $host.$word."/";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);

	if(strpos($output,$string_body) === false)
		{
		  echo "\n\033[32m$url\033[0m";
		}
	else
		{
		  echo "\n\033[31m$url\033[0m";
		}
}
/* **** */					/* **** */					/* **** */







/* **** */					/* **** */					/* **** */
function mod_title($host,$ext,$word,$string_title) {

	$url = $host.$word."/";
	$headers = @get_headers($url);

	if(strpos($headers[0],'403') == true)
		{
			echo "\n\033[33m$url : FORBIDEN\033[0m"; //orange
		}

	elseif (strpos($headers[0],'Not Found') == true)
		{
			echo "\n\033[31m$url\033[0m"; //red
		}

	else
		{
			$title = getTitle($url);

			if(strpos($title,$string_title) == true)
				{
				  echo "\n\033[31m$url\033[0m"; //red
				}

			else
				{
				  echo "\n\033[32m$url\033[0m"; //green
				}
		}
}
/* **** */					/* **** */					/* **** */




/* **** */					/* **** */					/* **** */
function modFtype($host, $word, $response, $ext){

	$url = $host.$word.".".$ext;
	$headers = @get_headers($url);


	if(strpos($headers[0],'403') == true) {
			echo "\n\033[33m$url : FORBIDEN\033[0m"; //orange
		}

	elseif(strpos($headers[0],$response) === false) {
		  echo "\n\033[32m$url\033[0m";
		}

	else {
		  echo "\n\033[31m$url\033[0m";
		}

}
/* **** */					/* **** */					/* **** */



					




/* **** */					/* **** */					/* **** */
if ($mod=="mod_head") {
	foreach ($list as $word) {
		mod_head($host,$word,$response);
	}

	echo "\n\nMORE ONE OTHER TEST..\n";

	foreach ($list as $word) {
		modFtype($host,$word,$response, $ext);
	}

	echo "\n!!!DONE!!!\n\n";
}


elseif($mod=="mod_body") {
	foreach ($list as $word) {
		mod_body($host,$word,$string_body);
	}
	echo "\n!!!DONE!!!\n\n";
}


elseif($mod=="mod_title") {
	foreach ($list as $word) {
		mod_title($host,$ext,$word,$string_title);
	}
	echo "\n!!!DONE!!!\n\n";
}

/* **** */					/* **** */					/* **** */
?>
