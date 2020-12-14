<?php

class Text
{
	// 'sv'/'en' as key
	private $languages;

	function Text()
	{
		$this->languages = array();
	}

	function add($lang, $text)
	{
		$this->languages[$lang] = $text;
	}

	function get($lang)
	{
		return (isset($this->languages[$lang])) ? $this->languages[$lang] : "";
	}
}

class ErrorURL_Error_ctx
{
	private $id;
	private $identifiers;
	private $header;
	private $body;

	function ErrorURL_Error_ctx($id)
	{
		$this->id = $id;
		$this->identifiers = array();
	}

	function add_identifier($identifier)
	{
		array_push($this->identifiers, $identifier);
	}

	function set_header($text)
	{
		$this->header = $text;
	}

	function set_body($text)
	{
		$this->body = $text;
	}

	function get_id()
	{
		return $this->id;
	}

	function get_identifiers()
	{
		return $this->identifiers;
	}

	function get_header($lang)
	{
		return $this->header->get($lang);
	}

	function get_body($lang)
	{
		return $this->body->get($lang);
	}
}

class ErrorURL_Error
{
	private $id;
	private $header;
	private $body;
	private $ctx;

	function ErrorURL_Error($id)
	{
		$this->id = $id;
		$this->ctx = array();
	}

	function set_header($text)
	{
		$this->header = $text;
	}

	function set_body($text)
	{
		$this->body = $text;
	}

	function get_id()
	{
		return $this->id;
	}

	function get_header($lang)
	{
		return $this->header->get($lang);
	}

	function get_body($lang)
	{
		return $this->body->get($lang);
	}

	function add_ctx($id, $ctx)
	{
		$this->ctx[$id] = $ctx;
	}

	function get_ctx()
	{
		return $this->ctx;
	}
}

$basic_info = array();

// basic_info->logo
$text = new Text();
$text->add('sv', $basic_info_logo_sv);
$text->add('en', $basic_info_logo_en);
$basic_info['logo'] = $text;

// basic_info->lang_flag
$text = new Text();
$text->add('sv', $basic_info_lang_flag_sv);
$text->add('en', $basic_info_lang_flag_en);
$basic_info['lang_flag'] = $text;

// basic_info->lang_select
$text = new Text();
$text->add('sv', $basic_info_lang_select_sv);
$text->add('en', $basic_info_lang_select_en);
$basic_info['lang_select'] = $text;

// basic_info->contact_information
$text = new Text();
$text->add('sv', $basic_info_contact_information_sv);
$text->add('en', $basic_info_contact_information_en);
$basic_info['contact_information'] = $text;

// basic_info->technical_information
$text = new Text();
$text->add('sv', $basic_info_technical_information_sv);
$text->add('en', $basic_info_technical_information_en);
$basic_info['technical_information'] = $text;

// basic_info->footer
$text = new Text();
$text->add('sv', $basic_info_footer_sv);
$text->add('en', $basic_info_footer_en);
$basic_info['footer'] = $text;

$errorurl_errors = array();

// ERRORURL_CODE
$errorurl_error = new ErrorURL_Error('ERRORURL_CODE');

$text = new Text();
$text->add('sv', $ee_errorurl_code_header_sv);
$text->add('en', $ee_errorurl_code_header_en);
$errorurl_error->set_header($text);

$text = new Text();
$text->add('sv', $ee_errorurl_code_body_sv);
$text->add('en', $ee_errorurl_code_body_en);
$errorurl_error->set_body($text);

$errorurl_errors[$errorurl_error->get_id()] = $errorurl_error;

// IDENTIFICATION_FAILURE
$errorurl_error = new ErrorURL_Error('IDENTIFICATION_FAILURE');

$text = new Text();
$text->add('sv', $ee_identification_failure_header_sv);
$text->add('en', $ee_identification_failure_header_en);
$errorurl_error->set_header($text);

$text = new Text();
$text->add('sv', $ee_identification_failure_body_sv);
$text->add('en', $ee_identification_failure_body_en);
$errorurl_error->set_body($text);

$errorurl_errors[$errorurl_error->get_id()] = $errorurl_error;

// AUTHENTICATION_FAILURE
$errorurl_error = new ErrorURL_Error('AUTHENTICATION_FAILURE');

$text = new Text();
$text->add('sv', $ee_authentication_failure_header_sv);
$text->add('en', $ee_authentication_failure_header_en);
$errorurl_error->set_header($text);

$text = new Text();
$text->add('sv', $ee_authentication_failure_body_sv);
$text->add('en', $ee_authentication_failure_body_en);
$errorurl_error->set_body($text);

$errorurl_errors[$errorurl_error->get_id()] = $errorurl_error;

// AUTHORIZATION_FAILURE
$errorurl_error = new ErrorURL_Error('AUTHORIZATION_FAILURE');

$text = new Text();
$text->add('sv', $ee_authorization_failure_header_sv);
$text->add('en', $ee_authorization_failure_header_en);
$errorurl_error->set_header($text);

$text = new Text();
$text->add('sv', $ee_authorization_failure_body_sv);
$text->add('en', $ee_authorization_failure_body_en);
$errorurl_error->set_body($text);

// AUTHORIZATION_FAILURE verified
$errorurl_error_ctx = new ErrorURL_Error_ctx('verified');

$text = new Text();
$text->add('sv', $ee_authorization_failure_ctx_verified_header_sv);
$text->add('en', $ee_authorization_failure_ctx_verified_header_en);
$errorurl_error_ctx->set_header($text);

$text = new Text();
$text->add('sv', $ee_authorization_failure_ctx_verified_body_sv);
$text->add('en', $ee_authorization_failure_ctx_verified_body_en);
$errorurl_error_ctx->set_body($text);

$errorurl_error_ctx->add_identifier('http://www.swamid.se/policy/assurance/al3');
$errorurl_error_ctx->add_identifier('https://refeds.org/assurance/IAP/high');
$errorurl_error_ctx->add_identifier('https://refeds.org/assurance/profile/espresso');

$errorurl_error->add_ctx($errorurl_error_ctx->get_id(), $errorurl_error_ctx);

// AUTHORIZATION_FAILURE confirmed
$errorurl_error_ctx = new ErrorURL_Error_ctx('confirmed');

$text = new Text();
$text->add('sv', $ee_authorization_failure_ctx_confirmed_header_sv);
$text->add('en', $ee_authorization_failure_ctx_confirmed_header_en);
$errorurl_error_ctx->set_header($text);

$text = new Text();
$text->add('sv', $ee_authorization_failure_ctx_confirmed_body_sv);
$text->add('en', $ee_authorization_failure_ctx_confirmed_body_en);
$errorurl_error_ctx->set_body($text);

$errorurl_error_ctx->add_identifier('http://www.swamid.se/policy/assurance/al2');
$errorurl_error_ctx->add_identifier('https://refeds.org/assurance/IAP/medium');
$errorurl_error_ctx->add_identifier('https://refeds.org/assurance/profile/cappuccino');

$errorurl_error->add_ctx($errorurl_error_ctx->get_id(), $errorurl_error_ctx);

// AUTHORIZATION_FAILURE non-confirmed
$errorurl_error_ctx = new ErrorURL_Error_ctx('non_confirmed');

$text = new Text();
$text->add('sv', $ee_authorization_failure_ctx_non_confirmed_header_sv);
$text->add('en', $ee_authorization_failure_ctx_non_confirmed_header_en);
$errorurl_error_ctx->set_header($text);

$text = new Text();
$text->add('sv', $ee_authorization_failure_ctx_non_confirmed_body_sv);
$text->add('en', $ee_authorization_failure_ctx_non_confirmed_body_en);
$errorurl_error_ctx->set_body($text);

$errorurl_error_ctx->add_identifier('http://www.swamid.se/policy/assurance/al1');
$errorurl_error_ctx->add_identifier('https://refeds.org/assurance/IAP/low');

$errorurl_error->add_ctx($errorurl_error_ctx->get_id(), $errorurl_error_ctx);

$errorurl_errors[$errorurl_error->get_id()] = $errorurl_error;

// OTHER_ERROR
$errorurl_error = new ErrorURL_Error('OTHER_ERROR');

$text = new Text();
$text->add('sv', $ee_other_error_header_sv);
$text->add('en', $ee_other_error_header_en);
$errorurl_error->set_header($text);

$text = new Text();
$text->add('sv', $ee_other_error_body_sv);
$text->add('en', $ee_other_error_body_en);
$errorurl_error->set_body($text);

$errorurl_errors[$errorurl_error->get_id()] = $errorurl_error;

?>
