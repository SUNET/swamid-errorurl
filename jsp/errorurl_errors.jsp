<%@ page trimDirectiveWhitespaces="true" %>
<%@ page import="java.util.*" %>
<%@ include file = "config.jsp" %>
<%!

class Text
{
	// 'sv'/'en' as key
	LinkedHashMap<String, String> languages;

	public Text()
	{
		this.languages = new LinkedHashMap();
	}

	public void add(String lang, String new_text)
	{
		this.languages.put(lang, new_text);
	}

	public String get(String lang)
	{
		return (this.languages.get(lang) != null) ? this.languages.get(lang) : "";
	}
}

class ErrorURL_Error_ctx
{
	private String id;
	LinkedList<String> identifiers;
	private Text header;
	private Text body;

	public ErrorURL_Error_ctx(String id)
	{
		this.id = id;
		this.identifiers = new LinkedList();
	}

	public void add_identifier(String identifier)
	{
		this.identifiers.add(identifier);
	}

	public void set_header(Text new_text)
	{
		this.header = new_text;
	}

	public void set_body(Text new_text)
	{
		this.body = new_text;
	}

	public String get_id()
	{
		return this.id;
	}

	public LinkedList<String> get_identifiers()
	{
		return this.identifiers;
	}

	public String get_header(String lang)
	{
		return this.header.get(lang);
	}

	public String get_body(String lang)
	{
		return this.body.get(lang);
	}
}

class ErrorURL_Error
{
	private String id;
	private Text header;
	private Text body;
	private LinkedHashMap<String, ErrorURL_Error_ctx> ctx;

	public ErrorURL_Error(String id)
	{
		this.id = id;
		this.ctx = new LinkedHashMap();
	}

	public void add_ctx(String id, ErrorURL_Error_ctx ctx)
	{
		this.ctx.put(id, ctx);
	}

	public void set_header(Text new_text)
	{
		this.header = new_text;
	}

	public void set_body(Text new_text)
	{
		this.body = new_text;
	}

	public String get_id()
	{
		return this.id;
	}

	public LinkedHashMap<String, ErrorURL_Error_ctx> get_ctx()
	{
		return this.ctx;
	}

	public String get_header(String lang)
	{
		return this.header.get(lang);
	}

	public String get_body(String lang)
	{
		return this.body.get(lang);
	}
}

%>
<%

LinkedHashMap<String, Text> basic_info = new LinkedHashMap();

// Temporary
Text new_text;

// basic_info logo
new_text = new Text();
new_text.add("sv", basic_info_logo_sv);
new_text.add("en", basic_info_logo_en);
basic_info.put("logo", new_text);

// basic_info lang_flag
new_text = new Text();
new_text.add("sv", basic_info_lang_flag_sv);
new_text.add("en", basic_info_lang_flag_en);
basic_info.put("lang_flag", new_text);

// basic_info lang_select
new_text = new Text();
new_text.add("sv", basic_info_lang_select_sv);
new_text.add("en", basic_info_lang_select_en);
basic_info.put("lang_select", new_text);

// basic_info contact_information
new_text = new Text();
new_text.add("sv", basic_info_contact_information_sv);
new_text.add("en", basic_info_contact_information_en);
basic_info.put("contact_information", new_text);

// basic_info technical_information
new_text = new Text();
new_text.add("sv", basic_info_technical_information_sv);
new_text.add("en", basic_info_technical_information_en);
basic_info.put("technical_information", new_text);

// basic_info footer
new_text = new Text();
new_text.add("sv", basic_info_footer_sv);
new_text.add("en", basic_info_footer_en);
basic_info.put("footer", new_text);

LinkedHashMap<String, ErrorURL_Error> errorurl_errors = new LinkedHashMap();

// Temporary
ErrorURL_Error new_errorurl_error;
ErrorURL_Error_ctx new_errorurl_error_ctx;

// ERRORURL_CODE
new_errorurl_error = new ErrorURL_Error("ERRORURL_CODE");

new_text = new Text();
new_text.add("sv", ee_errorurl_code_header_sv);
new_text.add("en", ee_errorurl_code_header_en);
new_errorurl_error.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_errorurl_code_body_sv);
new_text.add("en", ee_errorurl_code_body_en);
new_errorurl_error.set_body(new_text);

errorurl_errors.put(new_errorurl_error.get_id(), new_errorurl_error);

// IDENTIFICATION_FAILURE
new_errorurl_error = new ErrorURL_Error("IDENTIFICATION_FAILURE");

new_text = new Text();
new_text.add("sv", ee_identification_failure_header_sv);
new_text.add("en", ee_identification_failure_header_en);
new_errorurl_error.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_identification_failure_body_sv);
new_text.add("en", ee_identification_failure_body_en);
new_errorurl_error.set_body(new_text);

errorurl_errors.put(new_errorurl_error.get_id(), new_errorurl_error);

// AUTHENTICATION_FAILURE
new_errorurl_error = new ErrorURL_Error("AUTHENTICATION_FAILURE");

new_text = new Text();
new_text.add("sv", ee_authentication_failure_header_sv);
new_text.add("en", ee_authentication_failure_header_en);
new_errorurl_error.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_authentication_failure_body_sv);
new_text.add("en", ee_authentication_failure_body_en);
new_errorurl_error.set_body(new_text);

errorurl_errors.put(new_errorurl_error.get_id(), new_errorurl_error);

// AUTHORIZATION_FAILURE
new_errorurl_error = new ErrorURL_Error("AUTHORIZATION_FAILURE");

new_text = new Text();
new_text.add("sv", ee_authorization_failure_header_sv);
new_text.add("en", ee_authorization_failure_header_en);
new_errorurl_error.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_authorization_failure_body_sv);
new_text.add("en", ee_authorization_failure_body_en);
new_errorurl_error.set_body(new_text);

// AUTHORIZATION_FAILURE verified
new_errorurl_error_ctx = new ErrorURL_Error_ctx("verified");

new_text = new Text();
new_text.add("sv", ee_authorization_failure_ctx_verified_header_sv);
new_text.add("en", ee_authorization_failure_ctx_verified_header_en);
new_errorurl_error_ctx.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_authorization_failure_ctx_verified_body_sv);
new_text.add("en", ee_authorization_failure_ctx_verified_body_en);
new_errorurl_error_ctx.set_body(new_text);

new_errorurl_error_ctx.add_identifier("http://www.swamid.se/policy/assurance/al3");
new_errorurl_error_ctx.add_identifier("https://refeds.org/assurance/IAP/high");
new_errorurl_error_ctx.add_identifier("https://refeds.org/assurance/profile/espresso");

new_errorurl_error.add_ctx(new_errorurl_error_ctx.get_id(), new_errorurl_error_ctx);

// AUTHORIZATION_FAILURE confirmed
new_errorurl_error_ctx = new ErrorURL_Error_ctx("confirmed");

new_text = new Text();
new_text.add("sv", ee_authorization_failure_ctx_confirmed_header_sv);
new_text.add("en", ee_authorization_failure_ctx_confirmed_header_en);
new_errorurl_error_ctx.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_authorization_failure_ctx_confirmed_body_sv);
new_text.add("en", ee_authorization_failure_ctx_confirmed_body_en);
new_errorurl_error_ctx.set_body(new_text);

new_errorurl_error_ctx.add_identifier("http://www.swamid.se/policy/assurance/al2");
new_errorurl_error_ctx.add_identifier("https://refeds.org/assurance/IAP/medium");
new_errorurl_error_ctx.add_identifier("https://refeds.org/assurance/profile/cappuccino");

new_errorurl_error.add_ctx(new_errorurl_error_ctx.get_id(), new_errorurl_error_ctx);

// AUTHORIZATION_FAILURE non-confirmed
new_errorurl_error_ctx = new ErrorURL_Error_ctx("non_confirmed");

new_text = new Text();
new_text.add("sv", ee_authorization_failure_ctx_non_confirmed_header_sv);
new_text.add("en", ee_authorization_failure_ctx_non_confirmed_header_en);
new_errorurl_error_ctx.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_authorization_failure_ctx_non_confirmed_body_sv);
new_text.add("en", ee_authorization_failure_ctx_non_confirmed_body_en);
new_errorurl_error_ctx.set_body(new_text);

new_errorurl_error_ctx.add_identifier("http://www.swamid.se/policy/assurance/al1");
new_errorurl_error_ctx.add_identifier("https://refeds.org/assurance/IAP/low");

new_errorurl_error.add_ctx(new_errorurl_error_ctx.get_id(), new_errorurl_error_ctx);

errorurl_errors.put(new_errorurl_error.get_id(), new_errorurl_error);

// OTHER_ERROR
new_errorurl_error = new ErrorURL_Error("OTHER_ERROR");

new_text = new Text();
new_text.add("sv", ee_other_error_header_sv);
new_text.add("en", ee_other_error_header_en);
new_errorurl_error.set_header(new_text);

new_text = new Text();
new_text.add("sv", ee_other_error_body_sv);
new_text.add("en", ee_other_error_body_en);
new_errorurl_error.set_body(new_text);

errorurl_errors.put(new_errorurl_error.get_id(), new_errorurl_error);

%>
