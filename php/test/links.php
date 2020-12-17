<?php

include("config.php");

if (isset($_POST['errorurl'])) {
	$errorurl = $_POST['errorurl'];
} else if (isset($_GET['errorurl'])) {
	$errorurl = $_GET['errorurl'];
} else {
	$errorurl = $default_errorurl;
}

function set_code($errorurl, $errorurl_code)
{
	return preg_replace(array(
				'/ERRORURL_CODE/',
			), array(
				$errorurl_code,
			),
			$errorurl);
}

function errorurl_replace($errorurl, $errorurl_code, $errorurl_ctx)
{
	if ($errorurl_code) {
		$errorurl = preg_replace(array(
				'/ERRORURL_CODE/',
			), array(
				$errorurl_code,
			),
			$errorurl);
	}

	if ($errorurl_ctx) {
		$errorurl = preg_replace(array(
				'/ERRORURL_TS/',
				'/ERRORURL_RP/',
				'/ERRORURL_TID/',
				'/ERRORURL_CTX/',
			), array(
				 1607969220, // time(),
				'https://www.student.ladok.se/student-sp',
				'error-' . '5fd7a9c448086', //uniqid(),
				urlencode($errorurl_ctx),
			),
			$errorurl);
	}

	return $errorurl;
}

function wrap_errorurl($errorurl)
{
	return preg_replace('/([?&])/', '<br>\\1', $errorurl);
}

?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<p>
<b>IdP errorURL</b><br>
<code>
<small>
<?= wrap_errorurl($errorurl) ?>
</small>
</code>
<?php

$errorurls = array(
	'ERRORURL_CODE' => array(
		'no-code'		=> errorurl_replace($errorurl, $errorurl_code = 'ERRORURL_CODE', $errorurl_ctx = ''),
	),

	'IDENTIFICATION_FAILURE' => array(
		'no-ctx'		=> errorurl_replace($errorurl, $errorurl_code = 'IDENTIFICATION_FAILURE', $errorurl_ctx = ''),

		'no-eppn'		=> errorurl_replace($errorurl, $errorurl_code = 'IDENTIFICATION_FAILURE',
					   $errorurl_ctx = 'eduPersonPrincipalName http://www.geant.net/uri/dataprotection-code-of-conduct/v1 http://refeds.org/category/research-and-scholarship'),

		'no-orcid'		=> errorurl_replace($errorurl, $errorurl_code = 'IDENTIFICATION_FAILURE',
					   $errorurl_ctx = 'eduPersonOrcid http://www.geant.net/uri/dataprotection-code-of-conduct/v1'),
	),

	'AUTHENTICATION_FAILURE' => array(
		'no-ctx'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHENTICATION_FAILURE', $errorurl_ctx = ''),

		'no-mfa'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHENTICATION_FAILURE',
					   $errorurl_ctx = 'https://refeds.org/profile/mfa'),
	),

	'AUTHORIZATION_FAILURE' => array(
		'no-ctx'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE', $errorurl_ctx = ''),

		'student'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'affiliation=student'),

		'AL1'			=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'http://www.swamid.se/policy/assurance/al1'),

		'RAF-low'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'https://refeds.org/assurance/IAP/low'),

		'AL2'			=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'http://www.swamid.se/policy/assurance/al2'),

		'RAF-medium'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'https://refeds.org/assurance/IAP/medium'),

		'RAF-cappuccino'	=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'https://refeds.org/assurance/profile/cappuccino'),

		'AL3'			=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'http://www.swamid.se/policy/assurance/al3'),

		'RAF-high'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'https://refeds.org/assurance/IAP/high'),

		'RAF-espresso'		=> errorurl_replace($errorurl, $errorurl_code = 'AUTHORIZATION_FAILURE',
					   $errorurl_ctx = 'https://refeds.org/assurance/profile/espresso'),
	),
			
	'OTHER_ERROR' => array(
		'no-ctx'		=> errorurl_replace($errorurl, $errorurl_code = 'OTHER_ERROR', $errorurl_ctx = ''),

		'ctx'			=> errorurl_replace($errorurl, $errorurl_code = 'OTHER_ERROR',
					   $errorurl_ctx = 'An error occurred'),
	),

);

$this_url_base = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . ((($_SERVER['REQUEST_SCHEME'] == 'http' && $_SERVER['SERVER_PORT'] != '80') || ($_SERVER['REQUEST_SCHEME'] == 'https' && $_SERVER['SERVER_PORT'] != '443')) ? ":" . $_SERVER['SERVER_PORT'] : "");

// errorurltest - open in new tab/window, but reuse same tab/window on all links
$target = (strpos($errorurl, $this_url_base) === 0) ? "right" : "errorurltest";

foreach ($errorurls as $code => $codedef) {
	print "<p><b>$code</b><br>\n";
	foreach ($codedef as $desc => $errorurl_link) {
		$errorurl_link_en = $errorurl_link . "&lang=en";

		$errorurl_link_wrapped = wrap_errorurl($errorurl_link);
		$errorurl_link_en_wrapped = wrap_errorurl($errorurl_link_en);

?>
<a target="<?= $target ?>" href="<?= $errorurl_link ?>" onclick="document.getElementById('resulting_errorurl').innerHTML='<?= $errorurl_link_wrapped ?>';"><?= $desc ?></a>
(<a target="<?= $target ?>" href="<?= $errorurl_link_en ?>" onclick="document.getElementById('resulting_errorurl').innerHTML='<?= $errorurl_link_en_wrapped ?>';">lang=en</a>)<br>
<?php

	}

}

?>
<p>
<b>Resulting errorURL</b><br>
<code>
<small>
<span id="resulting_errorurl"><?= wrap_errorurl($errorurl) ?></span>
</small>
</code>
</body>
</html>
