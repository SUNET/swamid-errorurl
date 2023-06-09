<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page pageEncoding="UTF-8" %>
<%@ page trimDirectiveWhitespaces="true" %>
<%@ page import="java.util.*" %>
<%@ page import="java.net.*" %>
<%@ page import="java.time.*" %>
<%@ page import="java.time.format.*" %>
<%@ include file = "parse_config.jsp" %>
<%!

String print_header(LinkedHashMap<String, LinkedHashMap<String, String>> basic_info_lang, LinkedHashMap<String, String> basic_info, LinkedList<String> languages, LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String lang, String errorurl_code, String errorurl_rp, String errorurl_ts, String errorurl_tid, String errorurl_ctx, String entityid)
{
	String title = get_errorcode_header(errorurl_errors, errorurl_code, errorurl_ctx);
	String logo = basic_info.get("logo");
	String output = "";

	output += "" +
		"<html>\n" +
		"<head>\n" +
		"<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" integrity=\"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh\" crossorigin=\"anonymous\">\n" +
		"<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\" integrity=\"sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6\" crossorigin=\"anonymous\"></script>\n" +
		"<title>" + title + "</title>\n" +
		"</head>\n" +
		"<body class=\"mt-4\">\n" +
		"<div class=\"container\">\n" +
		"<div class=\"page-header\">\n" +
		"  <img src=\"" + logo + "\">\n" +
		"</div>\n" +
		"<p class=\"text-right\">\n" +
		"";

	Boolean first = true;
	for (String l : languages) {
		if (l.equals(lang)) {
			continue;
		}

		if (!first) {
			output += " | ";
		}
		first = false;

		output += "" +
			"<a href=\"?" + 
			"lang=" + l +
			((!entityid.isEmpty()) ? "&entityid=" + entityid : "") +
			((!errorurl_code.isEmpty()) ? "&errorurl_code=" + errorurl_code : "") +
			((!errorurl_ts.isEmpty()) ? "&errorurl_ts=" + URLEncoder.encode(errorurl_ts) : "") +
			((!errorurl_rp.isEmpty()) ? "&errorurl_rp=" + URLEncoder.encode(errorurl_rp) : "") +
			((!errorurl_tid.isEmpty()) ? "&errorurl_tid=" + URLEncoder.encode(errorurl_tid) : "") +
			((!errorurl_ctx.isEmpty()) ? "&errorurl_ctx=" + URLEncoder.encode(errorurl_ctx) : "") +
			"\">" +
			"<img src=\"" + basic_info_lang.get(l).get("langFlag") + "\" alt=\"\"> " +
			"<span>" + basic_info_lang.get(l).get("langSelect") + "</span>" + 
			"</a>\n";
	}

	output += "<h1>" + title + "</h1>\n";

	return output;
}

String get_errorcode_header(LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String errorurl_code, String errorurl_ctx)
{
	ErrorURL_Error errorurl_error = errorurl_errors.get(errorurl_code);

	String text = "";
	Boolean ctx_found = false;
	if (!errorurl_ctx.isEmpty() && errorurl_error.get_ctx().size() != 0) {
		for (Map.Entry<String, ErrorURL_Error_ctx> entry : errorurl_error.get_ctx().entrySet()) {
			String id = entry.getKey();
			ErrorURL_Error_ctx errorurl_error_ctx = entry.getValue();
			for (String identifier : errorurl_error_ctx.get_identifiers()) {
				if (errorurl_ctx.indexOf(identifier) != -1) {
					text = errorurl_error_ctx.get_header();
					ctx_found = true;
					break;
				}
			}
			if (ctx_found) {
				break;
			}
		}
	}
	if (text.isEmpty()) {
		text = errorurl_error.get_header();
	}

	return text;
}

LinkedList<String> get_errorcode_body(LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String errorurl_code, String errorurl_ctx)
{
	ErrorURL_Error errorurl_error = errorurl_errors.get(errorurl_code);

	LinkedList<String> text = null;
	Boolean ctx_found = false;
	if (!errorurl_ctx.isEmpty() && errorurl_error.get_ctx().size() != 0) {
		for (Map.Entry<String, ErrorURL_Error_ctx> entry : errorurl_error.get_ctx().entrySet()) {
			String id = entry.getKey();
			ErrorURL_Error_ctx errorurl_error_ctx = entry.getValue();
			for (String identifier : errorurl_error_ctx.get_identifiers()) {
				if (errorurl_ctx.indexOf(identifier) != -1) {
					text = errorurl_error_ctx.get_body();
					ctx_found = true;
					break;
				}
			}
			if (ctx_found) {
				break;
			}
		}
	}
	if (text == null) {
		text = errorurl_error.get_body();
	}

	return text;
}

String print_error(LinkedHashMap<String, String> basic_info, LinkedHashMap <String, ErrorURL_Error> errorurl_errors, Boolean print_sub_header, String entityid, String errorurl_code, String errorurl_ts, String errorurl_rp, String errorurl_tid, String errorurl_ctx)
{
	ErrorURL_Error errorurl_error = errorurl_errors.get(errorurl_code);

	String header = get_errorcode_header(errorurl_errors, errorurl_code, errorurl_ctx);
	LinkedList<String> body_paragraphs = get_errorcode_body(errorurl_errors, errorurl_code, errorurl_ctx);

	String contactInformation = basic_info.get("contactInformation");
	String technicalInformation = basic_info.get("technicalInformation");

	String output = "";

	if (print_sub_header) {

		output += "<h2>" + header + "</h2>\n";

	}
	
	for (String body_paragraph : body_paragraphs) {
		output += "<p>" + body_paragraph + "\n";
	}

	output += "<p>" + contactInformation + "\n";

	String readable_date = "";
	if (errorurl_ts.matches("\\d+")) {
		ZoneOffset timeZoneOffset = ZoneOffset.UTC;
		LocalDateTime localdatetime = LocalDateTime.ofEpochSecond(Long.parseLong(errorurl_ts), 0, timeZoneOffset);
		readable_date = " (" + DateTimeFormatter.ofPattern("yyyy-MM-dd'T'HH:mm:ss'Z'").format(localdatetime) + ")";
	}

	if (!errorurl_ctx.isEmpty() && !errorurl_ctx.equals("ERRORURL_CTX")) {

		output += "<p>" + technicalInformation + ":<br>\n" +
			"<p class=\"ml-4\">\n" +
			"<code>\n" +
			"ERRORURL_TS:  " + safeHtml(errorurl_ts) + readable_date + "<br>\n" +
			"ERRORURL_RP:  " + safeHtml(errorurl_rp) + "<br>\n" +
			"ERRORURL_TID: " + safeHtml(errorurl_tid) + "<br>\n" +
			"ERRORURL_CTX: " + safeHtml(errorurl_ctx) + "\n" +
			"</code>\n" +
			"</p>\n" +
			"";

	}

	return output;
}

String safeHtml(String param)
{
	if (param != null) {
		return param.replace("&", "&amp;").replace("<", "&lt;").replace(">", "&gt;").replace("\"", "&quot;").replace("'", "&apos;");
	} else {
		return "";
	}
}

%>
<%

String lang		= (request.getParameter("lang")          != null) ? request.getParameter("lang") : "";
String entityid 	= (request.getParameter("entityid")      != null) ? request.getParameter("entityid") : "";
String errorurl_code	= (request.getParameter("errorurl_code") != null) ? request.getParameter("errorurl_code") : "";
String errorurl_ts	= (request.getParameter("errorurl_ts")   != null) ? request.getParameter("errorurl_ts") : "";
String errorurl_rp	= (request.getParameter("errorurl_rp")   != null) ? request.getParameter("errorurl_rp") : "";
String errorurl_tid	= (request.getParameter("errorurl_tid")  != null) ? request.getParameter("errorurl_tid") : "";
String errorurl_ctx	= (request.getParameter("errorurl_ctx")  != null) ? request.getParameter("errorurl_ctx") : "";

if (!languages.contains(lang)) {
	lang = default_lang;
}

LinkedHashMap<String, String> basic_info = basic_info_lang.get(lang);
LinkedHashMap<String, ErrorURL_Error> errorurl_errors = errorurl_errors_lang.get(lang);

if (!Arrays.asList("IDENTIFICATION_FAILURE", "AUTHENTICATION_FAILURE", "AUTHORIZATION_FAILURE", "OTHER_ERROR").contains(errorurl_code)) {
	errorurl_code = "ERRORURL_CODE";
}

if (Arrays.asList("IDENTIFICATION_FAILURE", "AUTHENTICATION_FAILURE", "AUTHORIZATION_FAILURE", "OTHER_ERROR").contains(errorurl_code)) {
	out.print(print_header(basic_info_lang, basic_info, languages, errorurl_errors, lang, errorurl_code, errorurl_rp, errorurl_ts, errorurl_tid, errorurl_ctx, entityid));
	out.print(print_error(basic_info, errorurl_errors, false, entityid, errorurl_code, errorurl_ts, errorurl_rp, errorurl_tid, errorurl_ctx));
} else {
	out.print(print_header(basic_info_lang, basic_info, languages, errorurl_errors, lang, errorurl_code, errorurl_rp, errorurl_ts, errorurl_tid, errorurl_ctx, entityid));

	LinkedList<String> body_paragraphs = get_errorcode_body(errorurl_errors, errorurl_code, errorurl_ctx);
	for (String body_paragraph : body_paragraphs) {
		out.print("<p>" + body_paragraph + "\n");
	}

	for (Map.Entry<String, ErrorURL_Error> entry : errorurl_errors.entrySet()) {
		String id = entry.getKey();
		ErrorURL_Error errorurl_error = entry.getValue();
		if (errorurl_error.get_id().equals("ERRORURL_CODE")) {
			continue;
		}
		out.print(print_error(basic_info, errorurl_errors, true, entityid, errorurl_error.get_id(), errorurl_ts, errorurl_rp, errorurl_tid, errorurl_ctx));
	}

}

out.println("<hr>");

out.println(basic_info.get("footer"));

%>
</div>
</body>
</html>
