<?php

#DISPLAY ERRORS (use when developing)
ini_set('display_errors','Off'); // On or Off 


#USER DEFINED
date_default_timezone_set('America/Los_Angeles'); 


#APP CORE INFO (hardsetting recommended)
define('LWAF_HOST'	,	$_SERVER['HTTP_HOST']); //defines the apps host/domain name
define('LWAF_DOCROOT'	,	$_SERVER['DOCUMENT_ROOT']); //defines the apps document root



#APP DEFINITIONS (no need to touch)
define('LWAF_SECUREPROTOCOL',	'https://');
define('LWAF_PROTOCOL'		,	'http://');
define('LWAF_STATICROOT'	,	LWAF_DOCROOT.'/static/');
define('LWAF_ADDINROOT'	,	LWAF_DOCROOT.'/addins/');
define('LWAF_PAGEROOT'		,	LWAF_DOCROOT.'/pages/');
define('LWAF_LIBROOT'		,	LWAF_DOCROOT.'/libs/');
define('LWAF_FUNCROOT'	,	LWAF_DOCROOT.'/functions/');


?>
