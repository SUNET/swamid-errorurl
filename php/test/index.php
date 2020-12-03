<?php

include("config.php");

function safe_get($param)
{
	return (isset($_GET[$param]) ? htmlentities($_GET[$param], ENT_QUOTES) : "");
}

$errorurl = safe_get('errorurl');
if (!$errorurl) {
	$errorurl = $default_errorurl;
}

?>
<html>
<head>
<title>errorURL tester</title>
</head>
<frameset rows="80,100%">
  <frame name="up" src="errorurl-form.php?errorurl=<?= urlencode($errorurl) ?>" scrolling=auto>
  <frameset cols="350,100%">
    <frame name="left" src="links.php?errorurl=<?= urlencode($errorurl) ?>" scrolling=auto>
    <frame name="right" src="<?= $errorurl ?>" scrolling=auto>
  </frameset>
</frameset>
</html>
