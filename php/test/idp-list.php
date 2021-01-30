<?php

include("config.php");
include("../helpdesks.php");

function helpdesk_cmp($a, $b)
{
    if (isset($a['displayname']['sv']) && isset($b['displayname']['sv']) && $a['displayname']['sv'] != $b['displayname']['sv']) {
	    return ($a['displayname']['sv'] < $b['displayname']['sv']) ? -1 : 1;
    } else {
	    return ($a < $b) ? -1 : 1;
    }
}

uasort($helpdesks, "helpdesk_cmp");

$title = "IdP errorURL list";

?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<title><?= $title ?></title>
</head>
<body class="mt-4">
<div class="container">
<h1><?= $title ?></h1>
<?php

$example_errorurl = array(
	'' => array(
		'displayname' => array(
			'sv' => 'GitHub swamid-errorurl example',
			'en' => 'GitHub swamid-errorurl example',
		),
		'errorurl' => 'https://error.swamid.se/default/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX'
	)
);



foreach (array_merge($example_errorurl, $helpdesks) as $entityid => $data) {
	$descr = $entityid;
	if (isset($data['displayname']['sv'])) {
		$desc = $data['displayname']['sv'];
	} else if (isset($data['displayname']['en'])) {
		$desc = $data['displayname']['en'];
	}

	if (isset($data['errorurl'])) {
		$errorurl = $data['errorurl'];
	} else {
		$errorurl = $default_errorurl . "&entityid=$entityid";
	}

	$testurl = "https://error.swamid.se/test/?errorurl=" . urlencode($errorurl);

?>
<p><b><?= $desc ?></b><?= ($entityid) ? " (" . $entityid . ")" : "" ?><br>
errorURL: <code><?= $errorurl ?></code><br>
<a href="<?= $testurl ?>">Test errorURL</a>

<?php

}

?>
</div>
</body>
</html>
