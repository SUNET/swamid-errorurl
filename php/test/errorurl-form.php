<?php

include("config.php");
include("../helpdesks.php");

$errorurl = $default_errorurl;
if (isset($_POST['errorurl'])) {
	$errorurl = $_POST['errorurl'];
} else if (isset($_GET['entityid']) && $_GET['entityid']) {
	$entityid = $_GET['entityid'];
	if ($entityid == "example") {
		$errorurl = $example_errorurl['example']['errorurl'];
	} else if (isset($helpdesks[$entityid])) {
		if (isset($helpdesks[$entityid]['errorurl'])) {
			$errorurl = $helpdesks[$entityid]['errorurl'];
		} else {
			$errorurl = "NO_ERRORURL_FOR_ENTITYID $entityid";
		}
	} else {
		$errorurl = "UNKNOWN_ENTITYID";
	}
}

?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style type="text/css">

input[type="text"] {
     width: 100%;
     box-sizing: border-box;
     -webkit-box-sizing:border-box;
     -moz-box-sizing: border-box;
}

</style>
</head>
<body>
errorURL to test:
<form name=errorurl method=POST target="left" action="links.php">
<input type=text style="width=100%; font-size:small" name=errorurl value="<?= $errorurl ?>"><br>
<input type=submit value="Set errorURL"> <a href="idp-list.php" target=_top>SWAMID IdP errorURL list</a>
</form>
</
