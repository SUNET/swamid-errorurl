<?php

include("config.php");
include("../helpdesks.php");

$entityid = "";
$errorurl = $default_errorurl;
if (isset($_GET['entityid']) && $_GET['entityid']) {
	$entityid = $_GET['entityid'];
	if ($entityid == "example") {
		$errorurl = $example_errorurl['example']['errorurl'];
	} else if (isset($helpdesks[$entityid]) && isset($helpdesks[$entityid]['errorurl'])) {
		$errorurl = $helpdesks[$entityid]['errorurl'];
	} else {
		$entityid = "UNKNOWN_ENTITYID";
		$errorurl = "UNKNOWN_ENTITYID";
	}
}

?>
<html>
<head>
<title>errorURL tester</title>
</head>
<frameset rows="100,100%">
  <frame name="up" src="errorurl-form.php?entityid=<?= urlencode($entityid) ?>" scrolling=auto>
  <frameset cols="350,100%">
    <frame name="left" src="links.php?entityid=<?= urlencode($entityid) ?>" scrolling=auto>
    <frame name="right" src="<?= $errorurl ?>" scrolling=auto>
  </frameset>
</frameset>
</html>
