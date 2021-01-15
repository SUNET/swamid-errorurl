<?php

require("config.php");

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

	function get_header()
	{
		return $this->header;
	}

	function get_body()
	{
		return $this->body;
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

	function get_header()
	{
		return $this->header;
	}

	function get_body()
	{
		return $this->body;
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

$basic_info_lang = array();
$errorurl_errors_lang = array();

foreach ($language_files as $language_file) {
	if (!$json = file_get_contents($language_file)) {
		print "Failed to open $language_file";
		exit(0);
	}
	
	if (!$parsed_json = json_decode($json, true)) {
		print "Failed to parse json from $language_file";
		exit(0);
	}

	$lang = $parsed_json['common']['lang'];

	$basic_info_lang[$lang] = array();
	$errorurl_errors_lang[$lang] = array();

	$basic_info_lang[$lang]['lang'] = $lang;
	$basic_info_lang[$lang]['langFlag'] = $parsed_json['common']['langFlag'];
	$basic_info_lang[$lang]['langSelect'] = $parsed_json['common']['langSelect'];
	$basic_info_lang[$lang]['logo'] = $parsed_json['common']['logo'];
	$basic_info_lang[$lang]['contactInformation'] = $parsed_json['common']['contactInformation'];
	$basic_info_lang[$lang]['technicalInformation'] = $parsed_json['common']['technicalInformation'];
	$basic_info_lang[$lang]['footer'] = $parsed_json['common']['footer'];

	foreach ($parsed_json['errors'] as $error) {
		$errorurl_error = new ErrorURL_Error($error['type']);
		$errorurl_error->set_header($error['header']);
		$errorurl_error->set_body($error['body']);

		if (isset($error['context'])) {
			foreach ($error['context'] as $context) {
				$errorurl_error_ctx = new ErrorURL_Error_ctx($context['type']);

				foreach ($context['identifiers'] as $identifier) {
					$errorurl_error_ctx->add_identifier($identifier);
				}

				$errorurl_error_ctx->set_header($context['header']);
				$errorurl_error_ctx->set_body($context['body']);

				$errorurl_error->add_ctx($errorurl_error_ctx->get_id(), $errorurl_error_ctx);
			}
		}

		$errorurl_errors_lang[$lang][$errorurl_error->get_id()] = $errorurl_error;
	}
}

?>
