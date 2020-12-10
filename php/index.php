<?php

require("config.php");
require("helpdesks.php");

function safe_get($param)
{
	return (isset($_GET[$param]) ? htmlentities($_GET[$param], ENT_QUOTES) : "");
}

function trim_ws($param)
{
	return trim(preg_replace('/^[ \t]*/m', '', $param));
}

function print_header($lang, $errorurl_code, $errorurl_rp, $errorurl_ts, $errorurl_tid, $errorurl_ctx)
{
	global $languages;
	global $errorurl_errors;
	global $logo;
	global $entityid;

	$title = get_errorcode_text($lang, $errorurl_code, $errorurl_ctx, 'header');

if (!isset($helpdesks[$entityid])) {
	$entityid = '';
}

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
<div class="page-header">
  <img src="<?= $logo ?>">
</div>
<p class="text-right">
<?php

	$first = true;
	foreach ($languages as $l => $values) {
		if ($l == $lang) {
			continue;
		}

		if (!$first) {
			print " | ";
		}
		$first = false;

?>
<a href="?lang=<?= $l ?><?= ($entityid) ? "&entityid=$entityid" : "" ?><?= ($errorurl_code) ? "&errorurl_code=$errorurl_code" : "" ?><?= ($errorurl_ts) ? "&errorurl_ts=$errorurl_ts" : "" ?><?= ($errorurl_rp) ? "&errorurl_rp=$errorurl_rp" : "" ?><?= ($errorurl_tid) ? "&errorurl_tid=$errorurl_tid" : "" ?><?= ($errorurl_ctx) ? "&errorurl_ctx=$errorurl_ctx" : "" ?>"><img src="<?= $values['logo'] ?>" alt=""> <span><?= $values['select'] ?></span></a>
<?php

	}

?>
<h1><?= $title ?></h1>
<?php

}

function get_error_header($lang, $errorurl_code)
{
	global $errorurl_errors;
	return trim_ws($errorurl_errors[$errorurl_code][$lang]['header']);
}

function get_errorcode_text($lang, $errorurl_code, $errorurl_ctx, $text_id)
{
	global $errorurl_errors;

	$errorurl_error = $errorurl_errors[$errorurl_code][$lang];

	$text = '';
	$ctx_found = false;
	if ($errorurl_ctx && isset($errorurl_error['ctx'])) {
		foreach ($errorurl_error['ctx'] as $type => $values) {
			foreach ($values['identifiers'] as $identifier) {
				if (strpos($errorurl_ctx, $identifier) !== false) {
					if (isset($values[$text_id])) {
						$text = trim_ws($values[$text_id]);
					}
					$ctx_found = true;
					break;
				}
			}
			if ($ctx_found) {
				break;
			}
		}
	}
	if ($text == '') {
		$text = trim_ws($errorurl_error[$text_id]);
	}

	return $text;
}

function print_error($lang, $print_sub_header, $entityid, $errorurl_code, $errorurl_ts, $errorurl_rp, $errorurl_tid, $errorurl_ctx)
{
	global $texts;
	global $errorurl_errors;

	$errorurl_error = $errorurl_errors[$errorurl_code][$lang];

	$header = get_errorcode_text($lang, $errorurl_code, $errorurl_ctx, 'header');
	$body = get_errorcode_text($lang, $errorurl_code, $errorurl_ctx, 'body');

	if ($print_sub_header) {
?>
<h2><?= $header ?></h2>
<?php

	}

?>
<?= $body ?>

<?php

	if (isset($helpdesks[$entityid][$lang]['displayname']) && $helpdesks[$entityid][$lang]['displayname'] &&
	    isset($helpdesks[$entityid]['contactperson_email']) && $helpdesks[$entityid]['contactperson_email']) {
		$displayname = $helpdesks[$entityid][$lang]['displayname'];
		$contactperson_email = $helpdesks[$entityid]['contactperson_email'];
		$contact_text = preg_replace(array(
				'/DISPLAYNAME/',
				'/EMAIL/'
			), array(
				'<b>' . $displayname . '</b>',
				'<a href="mailto:' . $contactperson_email . '">' . $contactperson_email . '</a>',
			), $texts[$lang]['contact_information']);

?>
	<p><?= $contact_text ?>

<?php

	}

	if ($errorurl_ctx && $errorurl_ctx != 'ERRORURL_CTX') {

?>
<p><?= $texts[$lang]['technical_information'] ?>:<br>
<p class="ml-4">
<code>
ERRORURL_TS:  <?= $errorurl_ts ?><?= (is_numeric($errorurl_ts)) ? ' (' . date(DATE_ATOM, $errorurl_ts) . ')' : '' ?><br>
ERRORURL_RP:  <?= $errorurl_rp ?><br>
ERRORURL_TID: <?= $errorurl_tid ?><br>
ERRORURL_CTX: <?= $errorurl_ctx ?>

</code>
</p>
<?php

	}
}

$lang		= safe_get('lang');
$entityid 	= safe_get('entityid');
$errorurl_code	= safe_get('errorurl_code');
$errorurl_ts	= safe_get('errorurl_ts');
$errorurl_rp	= safe_get('errorurl_rp');
$errorurl_tid	= safe_get('errorurl_tid');
$errorurl_ctx	= safe_get('errorurl_ctx');

if (!isset($languages[$lang])) {
	$lang = $default_lang;
}

if (!in_array($errorurl_code, array('IDENTIFICATION_FAILURE', 'AUTHENTICATION_FAILURE', 'AUTHORIZATION_FAILURE', 'OTHER_ERROR'))) {
	$errorurl_code = 'ERRORURL_CODE';
}

if (in_array($errorurl_code, array('IDENTIFICATION_FAILURE', 'AUTHENTICATION_FAILURE', 'AUTHORIZATION_FAILURE', 'OTHER_ERROR'))) {
	print_header($lang, $errorurl_code, $errorurl_rp, $errorurl_ts, $errorurl_tid, $errorurl_ctx);
	print_error($lang, $print_sub_header = false, $entityid, $errorurl_code, $errorurl_ts, $errorurl_rp, $errorurl_tid, $errorurl_ctx);
} else {
	print_header($lang, $errorurl_code, $errorurl_rp, $errorurl_ts, $errorurl_tid, $errorurl_ctx);

?>
<?= trim_ws($errorurl_errors[$errorurl_code][$lang]['body']) ?>

<?php

	foreach ($errorurl_errors as $errorurl_code => $definition) {
		if ($errorurl_code == "ERRORURL_CODE") {
			continue;
		}
		print_error($lang, $print_sub_header = true, $entityid, $errorurl_code, $errorurl_ts, $errorurl_rp, $errorurl_tid, $errorurl_ctx);
	}

}

?>
<?= $texts[$lang]['footer'] ?>

</div>
</body>
</html>
