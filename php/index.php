<?php

require("parse_config.php");

require("helpdesks.php");

function safe_get($param)
{
	return (isset($_GET[$param]) ? $_GET[$param] : "");
}

function print_header($lang, $errorurl_code, $errorurl_rp, $errorurl_ts, $errorurl_tid, $errorurl_ctx)
{
	global $languages;
	global $basic_info;
	global $basic_info_lang;
	global $errorurl_errors;
	global $entityid;
	global $helpdesks;

	$title = get_errorcode_header($errorurl_code, $errorurl_ctx);
	$logo = $basic_info['logo'];

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
	foreach ($languages as $l) {
		if ($l == $lang) {
			continue;
		}

		if (!$first) {
			print " | ";
		}
		$first = false;

?>
<a href="?lang=<?= $l ?><?= ($entityid) ? "&entityid=" . urlencode($entityid) : "" ?><?= ($errorurl_code) ? "&errorurl_code=" . urlencode($errorurl_code) : "" ?><?= ($errorurl_ts) ? "&errorurl_ts=" . urlencode($errorurl_ts) : "" ?><?= ($errorurl_rp) ? "&errorurl_rp=" . urlencode($errorurl_rp) : "" ?><?= ($errorurl_tid) ? "&errorurl_tid=" . urlencode($errorurl_tid) : "" ?><?= ($errorurl_ctx) ? "&errorurl_ctx=" . urlencode($errorurl_ctx) : "" ?>"><img src="<?= $basic_info_lang[$l]['langFlag'] ?>" alt=""> <span><?= $basic_info_lang[$l]['langSelect'] ?></span></a>
<?php

	}

?>
<h1><?= $title ?></h1>
<?php

}

function get_errorcode_header($errorurl_code, $errorurl_ctx)
{
	global $errorurl_errors;

	$errorurl_error = $errorurl_errors[$errorurl_code];

	$text = '';
	$ctx_found = false;
	if ($errorurl_ctx && count($errorurl_error->get_ctx())) {
		foreach ($errorurl_error->get_ctx() as $errorurl_error_ctx) {
			foreach ($errorurl_error_ctx->get_identifiers() as $identifier) {
				if (strpos($errorurl_ctx, $identifier) !== false) {
					$text = $errorurl_error_ctx->get_header();
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
		$text = $errorurl_error->get_header();
	}

	return $text;
}

function get_errorcode_body($errorurl_code, $errorurl_ctx)
{
	global $errorurl_errors;

	$errorurl_error = $errorurl_errors[$errorurl_code];

	$text = '';
	$ctx_found = false;
	if ($errorurl_ctx && count($errorurl_error->get_ctx())) {
		foreach ($errorurl_error->get_ctx() as $errorurl_error_ctx) {
			foreach ($errorurl_error_ctx->get_identifiers() as $identifier) {
				if (strpos($errorurl_ctx, $identifier) !== false) {
					$text = $errorurl_error_ctx->get_body();
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
		$text = $errorurl_error->get_body();
	}

	return $text;
}

function print_error($print_sub_header, $entityid, $errorurl_code, $errorurl_ts, $errorurl_rp, $errorurl_tid, $errorurl_ctx)
{
	global $basic_info;
	global $errorurl_errors;
	global $helpdesks;
	global $lang;

	$errorurl_error = $errorurl_errors[$errorurl_code];

	$header = get_errorcode_header($errorurl_code, $errorurl_ctx);
	$body_paragraphs = get_errorcode_body($errorurl_code, $errorurl_ctx);

	$contactInformation = $basic_info['contactInformation'];
	$technicalInformation = $basic_info['technicalInformation'];

	if ($print_sub_header) {
?>
<h2><?= $header ?></h2>
<?php

	}

	foreach ($body_paragraphs as $body_paragraph) {

?>
<p><?= $body_paragraph ?>

<?php

	}

	if (isset($helpdesks[$entityid]['displayname'][$lang]) && $helpdesks[$entityid]['displayname'][$lang] &&
	    isset($helpdesks[$entityid]['contactperson_email']) && $helpdesks[$entityid]['contactperson_email']) {
		$displayname = $helpdesks[$entityid]['displayname'][$lang];
		$contactperson_email = $helpdesks[$entityid]['contactperson_email'];
		$contactInformation_replaced = preg_replace(array(
				'/DISPLAYNAME/',
				'/EMAIL/',
			), array(
				'<b>' . $displayname . '</b>',
				$contactperson_email,
			), $contactInformation);

?>
<p><?= $contactInformation_replaced ?>

<?php

	}

	if ($errorurl_ctx && $errorurl_ctx != 'ERRORURL_CTX') {

?>
<p><?= $technicalInformation ?>:<br>
<p class="ml-4">
<code>
ERRORURL_TS:  <?= htmlentities($errorurl_ts, ENT_QUOTES) ?><?= (is_numeric($errorurl_ts)) ? ' (' . date(DATE_ATOM, $errorurl_ts) . ')' : '' ?><br>
ERRORURL_RP:  <?= htmlentities($errorurl_rp, ENT_QUOTES) ?><br>
ERRORURL_TID: <?= htmlentities($errorurl_tid, ENT_QUOTES) ?><br>
ERRORURL_CTX: <?= htmlentities($errorurl_ctx, ENT_QUOTES) ?>

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

if (!in_array($lang, $languages)) {
	$lang = $default_lang;
}

$errorurl_errors = $errorurl_errors_lang[$lang];
$basic_info = $basic_info_lang[$lang];

if (!in_array($errorurl_code, array('IDENTIFICATION_FAILURE', 'AUTHENTICATION_FAILURE', 'AUTHORIZATION_FAILURE', 'OTHER_ERROR'))) {
	$errorurl_code = 'ERRORURL_CODE';
}

if (in_array($errorurl_code, array('IDENTIFICATION_FAILURE', 'AUTHENTICATION_FAILURE', 'AUTHORIZATION_FAILURE', 'OTHER_ERROR'))) {
	print_header($lang, $errorurl_code, $errorurl_rp, $errorurl_ts, $errorurl_tid, $errorurl_ctx);
	print_error($print_sub_header = false, $entityid, $errorurl_code, $errorurl_ts, $errorurl_rp, $errorurl_tid, $errorurl_ctx);
} else {
	print_header($lang, 'ERRORURL_CODE', $errorurl_rp, $errorurl_ts, $errorurl_tid, $errorurl_ctx);

	foreach ($errorurl_errors['ERRORURL_CODE']->get_body() as $body_paragraph) {

?>
<p><?= $body_paragraph ?>

<?php

	}

	foreach ($errorurl_errors as $errorurl_error) {
		if ($errorurl_error->get_id() == "ERRORURL_CODE") {
			continue;
		}
		print_error($print_sub_header = true, $entityid, $errorurl_error->get_id(), $errorurl_ts, $errorurl_rp, $errorurl_tid, $errorurl_ctx);
	}

}

?>
<hr>
<?= $basic_info['footer'] ?>

</div>
</body>
</html>
