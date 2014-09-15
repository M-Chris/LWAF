<?php 

$errorType = (!empty($_SERVER['REDIRECT_STATUS']) ? $_SERVER['REDIRECT_STATUS'] : '404');
$requestedURI = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo (!empty($_CONFIG['site_name']) ? $_CONFIG['site_name'].' ' : '').$errorType; ?> Error</title>
</head>

<body id="mainBody">		


<br /><br /><br />
<div style="width:600px; margin:auto;">

<div class="cbox" style="padding:10px;">
<div class="cbox_head"><h2 style="font-size:20px;"><?php if($errorType==405){ echo 'Security'; }else{ echo $errorType; } echo' Error '; if($errorType==404){ echo 'Page Not Found'; } ?></h2></div>
<div class="cbox_body">

<?php 



	switch($errorType){
		case $errorType==400:
		 echo 'The Page you Requested "<i>http://'.$_SERVER['HTTP_HOST'].$requestedURI.'</i>" <br /> <b>Was A Bad Request</b>';
		 break;
		case $errorType==401:
		 echo 'The Page you Requested "<i>http://'.$_SERVER['HTTP_HOST'].$requestedURI.'</i>" <br /><b>Requires Authorization</b>';
		 break;
		case $errorType==403:
		 echo '<b>The Request You Made Is FORBIDDEN</b>';
		 break;
		case $errorType==404:
		 echo '<br><br>"<i>The page you are looking for: http://'.$_SERVER['HTTP_HOST'].$requestedURI.'</i>"<hr/>';
		 echo '<br><br>Has either been removed or does not exist.';
		 break;
		case $errorType==405:
		 echo '<br /><b>The Request Method You Made Is Not Allowed</b><br /><br /><br />If you were submitting a form please go back,<br /> then refresh the page before submitting the form again. <br /><br /><i>If prompted to resubmit the form by your browser, <br />please navigate away from the page and then back to the form later</i> or <a href="'.OPUS_APP_HOST.'">Click Here</a>.';
		 break;
		case $errorType==406:
		 echo '<b>The Request You Made Is Not Acceptable</b>';
		 break;
		case $errorType==409:
		 echo '<b>The Request You Made has Conflicting Results</b>';
		 break;
		case $errorType==413:
		 echo '<b>The Request Entity You Made Is Too Long</b>';
		 break;
		case $errorType==414:
		 echo '<b>The Request URI You Made Is Too Long</b>';
		 break;
		case $errorType==500:
		 echo '<b>The Server Has Had An Eternal Error. Please Try Again Later.</b>';
		 break;
		case $errorType==501:
		 echo '<b>The Server Does Not Implement This Yet. Please Try Again Later.</b>';
		 break;
		default:
		 echo 'The Page you Requested <b>Was Not Found</b>';
		 break;
	}
?>
</div>
</div>
</div>
</body>
</html>
