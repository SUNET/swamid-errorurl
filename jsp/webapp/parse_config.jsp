<%@ page trimDirectiveWhitespaces="true" %>
<%@ page import="java.io.*" %>
<%@ page import="org.json.*" %>
<%@ include file = "config.jsp" %>
<%!

class ErrorURL_Error_ctx
{
	private String id;
	LinkedList<String> identifiers;
	private String header;
	private LinkedList<String> body;

	public ErrorURL_Error_ctx(String id)
	{
		this.id = id;
		this.identifiers = new LinkedList();
	}

	public void add_identifier(String identifier)
	{
		this.identifiers.add(identifier);
	}

	public void set_header(String header)
	{
		this.header = header;
	}

	public void set_body(LinkedList<String> body)
	{
		this.body = body;
	}

	public String get_id()
	{
		return this.id;
	}

	public LinkedList<String> get_identifiers()
	{
		return this.identifiers;
	}

	public String get_header()
	{
		return this.header;
	}

	public LinkedList<String> get_body()
	{
		return this.body;
	}
}

class ErrorURL_Error
{
	private String id;
	private String header;
	private LinkedList<String> body;
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

	public void set_header(String header)
	{
		this.header = header;
	}

	public void set_body(LinkedList<String> body)
	{
		this.body = body;
	}

	public String get_id()
	{
		return this.id;
	}

	public LinkedHashMap<String, ErrorURL_Error_ctx> get_ctx()
	{
		return this.ctx;
	}

	public String get_header()
	{
		return this.header;
	}

	public LinkedList<String> get_body()
	{
		return this.body;
	}
}

%>
<%

LinkedHashMap<String, LinkedHashMap<String, String>> basic_info_lang = new LinkedHashMap();
LinkedHashMap<String, LinkedHashMap<String, ErrorURL_Error>> errorurl_errors_lang = new LinkedHashMap();

for (String language_file : language_files) {
	// Read language_file from classpath into String json
	ClassLoader classLoader = getClass().getClassLoader();
	InputStream inputStream = classLoader.getResourceAsStream(language_file);
	InputStreamReader isReader = new InputStreamReader(inputStream);
	BufferedReader reader = new BufferedReader(isReader);
	StringBuffer sb = new StringBuffer();
	String str;
	while((str = reader.readLine()) != null) {
		 sb.append(str);
	}
	String json = sb.toString();

	JSONObject jobject = new JSONObject(json);

	LinkedHashMap<String, String> basic_info = new LinkedHashMap();

	JSONObject common = jobject.getJSONObject("common");

	String lang = common.getString("lang");

	basic_info.put("lang", lang);
	basic_info.put("langFlag", common.getString("langFlag"));
	basic_info.put("langSelect", common.getString("langSelect"));
	basic_info.put("logo", common.getString("logo"));
	basic_info.put("contactInformation", common.getString("contactInformation"));
	basic_info.put("technicalInformation", common.getString("technicalInformation"));
	basic_info.put("footer", common.getString("footer"));

	basic_info_lang.put(lang, basic_info);

	LinkedHashMap<String, ErrorURL_Error> errorurl_errors = new LinkedHashMap();

	JSONArray errors = jobject.getJSONArray("errors");

	for(int i=0; i<errors.length(); i++) {
		ErrorURL_Error new_errorurl_error;
		ErrorURL_Error_ctx new_errorurl_error_ctx;

		new_errorurl_error = new ErrorURL_Error(errors.getJSONObject(i).getString("type"));

		new_errorurl_error.set_header(errors.getJSONObject(i).getString("header"));

		JSONArray body = errors.getJSONObject(i).getJSONArray("body");
		LinkedList<String> new_body = new LinkedList();
		for(int j=0; j<body.length(); j++) {
			new_body.add(body.getString(j));
		}
		new_errorurl_error.set_body(new_body);

		if (errors.getJSONObject(i).has("context")) {
			JSONArray context = errors.getJSONObject(i).getJSONArray("context");
			for(int j=0; j<context.length(); j++) {
				new_errorurl_error_ctx = new ErrorURL_Error_ctx(context.getJSONObject(j).getString("type"));

				JSONArray identifiers = context.getJSONObject(j).getJSONArray("identifiers");
				for(int k=0; k<identifiers.length(); k++) {
					new_errorurl_error_ctx.add_identifier(identifiers.getString(k));
				}

				new_errorurl_error_ctx.set_header(context.getJSONObject(j).getString("header"));

				JSONArray context_body = context.getJSONObject(j).getJSONArray("body");
				LinkedList<String> new_context_body = new LinkedList();
				for(int k=0; k<context_body.length(); k++) {
					new_context_body.add(context_body.getString(k));
				}
				new_errorurl_error_ctx.set_body(new_context_body);

				new_errorurl_error.add_ctx(new_errorurl_error_ctx.get_id(), new_errorurl_error_ctx);
			}
		}

		errorurl_errors.put(new_errorurl_error.get_id(), new_errorurl_error);
	}
	errorurl_errors_lang.put(lang, errorurl_errors);
}

%>
