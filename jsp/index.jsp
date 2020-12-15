<%@ page contentType="text/html; charset=UTF-8" %>
<%@ page pageEncoding="UTF-8" %>
<%@ page trimDirectiveWhitespaces="true" %>
<%@ page import="java.util.*" %>
<%@ page import="java.net.*" %>
<%@ page import="java.time.*" %>
<%@ page import="java.time.format.*" %>
<%@ include file = "errorurl_errors.jsp" %>
<%!

String print_header(LinkedHashMap<String, Text> basic_info, LinkedList<String> languages, LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String lang, String errorurl_code, String errorurl_rp, String errorurl_ts, String errorurl_tid, String errorurl_ctx, String entityid)
{
	String title = get_errorcode_header(errorurl_errors, lang, errorurl_code, errorurl_ctx);
	String logo = basic_info.get("logo").get(lang);
	String output = "";

	output += "" +
		"<html>\n" +
		"<head>\n" +
		"<script src=\"https://code.jquery.com/jquery-3.4.1.slim.min.js\" integrity=\"sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n\" crossorigin=\"anonymous\"></script>\n" +
		"<script src=\"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js\" integrity=\"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo\" crossorigin=\"anonymous\"></script>\n" +
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
			"<img src=\"" + basic_info.get("lang_flag").get(l) + "\" alt=\"\"> " +
			"<span>" + basic_info.get("lang_select").get(l) + "</span>" + 
			"</a>\n";
	}

	output += "<h1>" + title + "</h1>\n";

	return output;
}

String get_errorcode_header(LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String lang, String errorurl_code, String errorurl_ctx)
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
					text = errorurl_error_ctx.get_header(lang);
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
		text = errorurl_error.get_header(lang);
	}

	return text;
}

String get_errorcode_body(LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String lang, String errorurl_code, String errorurl_ctx)
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
					text = errorurl_error_ctx.get_body(lang);
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
		text = errorurl_error.get_body(lang);
	}

	return text;
}

String print_error(LinkedHashMap<String, Text> basic_info, LinkedHashMap <String, ErrorURL_Error> errorurl_errors, String lang, Boolean print_sub_header, String entityid, String errorurl_code, String errorurl_ts, String errorurl_rp, String errorurl_tid, String errorurl_ctx)
{
	ErrorURL_Error errorurl_error = errorurl_errors.get(errorurl_code);

	String header = get_errorcode_header(errorurl_errors, lang, errorurl_code, errorurl_ctx);
	String body = get_errorcode_body(errorurl_errors, lang, errorurl_code, errorurl_ctx);

	String contact_information = basic_info.get("contact_information").get(lang);
	String technical_information = basic_info.get("technical_information").get(lang);

	String output = "";

	if (print_sub_header) {

		output += "<h2>" + header + "</h2>\n";

	}
	
	output += body;

	output += "<p>" + contact_information + "\n";

	String readable_date = "";
	if (errorurl_ts.matches("\\d+")) {
		ZoneOffset timeZoneOffset = ZoneOffset.UTC;
		LocalDateTime localdatetime = LocalDateTime.ofEpochSecond(Long.parseLong(errorurl_ts), 0, timeZoneOffset);
		readable_date = " (" + DateTimeFormatter.ofPattern("yyyy-MM-dd'T'HH:mm:ss'Z'").format(localdatetime) + ")";
	}


	if (!errorurl_ctx.isEmpty() && !errorurl_ctx.equals("ERRORURL_CTX")) {

		output += "<p>" + technical_information + ":<br>\n" +
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

String lang		= request.getParameter("lang");
String entityid 	= request.getParameter("entityid");
String errorurl_code	= request.getParameter("errorurl_code");
String errorurl_ts	= request.getParameter("errorurl_ts");
String errorurl_rp	= request.getParameter("errorurl_rp");
String errorurl_tid	= request.getParameter("errorurl_tid");
String errorurl_ctx	= request.getParameter("errorurl_ctx");

if (!languages.contains(lang)) {
	lang = default_lang;
}

if (!Arrays.asList("IDENTIFICATION_FAILURE", "AUTHENTICATION_FAILURE", "AUTHORIZATION_FAILURE", "OTHER_ERROR").contains(errorurl_code)) {
	errorurl_code = "ERRORURL_CODE";
}

if (Arrays.asList("IDENTIFICATION_FAILURE", "AUTHENTICATION_FAILURE", "AUTHORIZATION_FAILURE", "OTHER_ERROR").contains(errorurl_code)) {
	out.print(print_header(basic_info, languages, errorurl_errors, lang, errorurl_code, errorurl_rp, errorurl_ts, errorurl_tid, errorurl_ctx, entityid));
	out.print(print_error(basic_info, errorurl_errors, lang, false, entityid, errorurl_code, errorurl_ts, errorurl_rp, errorurl_tid, errorurl_ctx));
} else {
	out.print(print_header(basic_info, languages, errorurl_errors, lang, errorurl_code, errorurl_rp, errorurl_ts, errorurl_tid, errorurl_ctx, entityid));

	out.print(errorurl_errors.get(errorurl_code).get_body(lang));

	for (Map.Entry<String, ErrorURL_Error> entry : errorurl_errors.entrySet()) {
		String id = entry.getKey();
		ErrorURL_Error errorurl_error = entry.getValue();
		if (errorurl_error.get_id().equals("ERRORURL_CODE")) {
			continue;
		}
		out.print(print_error(basic_info, errorurl_errors, lang, true, entityid, errorurl_error.get_id(), errorurl_ts, errorurl_rp, errorurl_tid, errorurl_ctx));
	}

}

out.println(basic_info.get("footer").get(lang));

%>
</div>
</body>
</html>
