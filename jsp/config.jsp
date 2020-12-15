<%@ page trimDirectiveWhitespaces="true" %>
<%@ page pageEncoding="UTF-8" %>
<%@ page import="java.util.*" %>
<%

String default_lang = "sv";
LinkedList<String> languages = new LinkedList();
languages.add("sv");
languages.add("en");

String basic_info_logo_sv = "logo.png";
String basic_info_logo_en = "logo.png";

String basic_info_lang_flag_sv = "swedish.png";
String basic_info_lang_flag_en = "english.png";

String basic_info_lang_select_sv = "På svenska";
String basic_info_lang_select_en = "In English";

String basic_info_contact_information_sv = "Supporten för din organisation, DISPLAYNAME, kan nås via EMAIL.";
String basic_info_contact_information_en = "The support of your organisation, DISPLAYNAME, can be reached at EMAIL.";

String basic_info_technical_information_sv = "Teknisk information";
String basic_info_technical_information_en = "Technical information";

String basic_info_footer_sv = "<hr>";
String basic_info_footer_en = "<hr>";

String ee_errorurl_code_header_sv = "Problem vid inloggning";
String ee_errorurl_code_header_en = "Login failed";

String ee_errorurl_code_body_sv = "" +
	"<p>Inloggning till tjänsten misslyckades. Se nedan för möjliga orsaker och åtgärder.\n" +
	"";

String ee_errorurl_code_body_en = "" +
	"<p>Login failed at the service you tried to access. Please see below for possible reasons and actions.\n" +
	"";

String ee_identification_failure_header_sv = "Attribut saknas";
String ee_identification_failure_header_en = "Identification failed";

String ee_identification_failure_body_sv = "" +
	"<p>Tjänsten du försökte nå fick inte de attribut den behöver för att identifiera dig eller för att personanpassa tjänsten.\n" +
	"<p>Detta kan bero på att din organisation saknar dessa uppgifter om dig eller att organisationens inloggningstjänst inte är konfigurerat för att skicka attributen till tjänsten du försökte nå.\n" +
	"<p>Kontakta din organisation och ange vilken tjänst du försökte nå, vilka attribut som saknades om du vet vilka dessa är (tjänsten kan ha berättat detta för er) samt, om möjligt, en skärmdump med eventuella felmeddelanden som tjänsten gav dig inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_identification_failure_body_en = "" +
	"<p>The service that you tried to access did not get all required attributes for identification and/or personalization.\n" +
	"<p>This may be because your institution is missing those attributes or that your institution is not configured to release those attributes to the service you tried to access.\n" +
	"<p>Please contact support at your institution and include the name of the service you tried to access, any missing attributes if you know what they are (the service may have informed you) and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";

String ee_authentication_failure_header_sv = "Inloggning misslyckades";
String ee_authentication_failure_header_en = "Authentication error";

String ee_authentication_failure_body_sv = "" +
	"<p>Ett fel uppstod i tjänsten du försökte nå i samband med inloggning.\n" +
	"<p>Detta kan bero på att ytterligare steg krävs vid inloggning, till exempel användning av tvåfaktorsinloggning. Vänligen försök igen.\n" +
	"<p>Om du inte lyckas lösa problemet, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_authentication_failure_body_en = "" +
	"<p>The service you tried to access failed during the authentication stage\n" +
	"<p>This may be because it requires additional steps which did not occur during login (such as using a second factor). Please try again.\n" +
	"<p>If you cannot resolve the issue yourself, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";

String ee_authorization_failure_header_sv = "Behörighet saknas";
String ee_authorization_failure_header_en = "Insufficient privileges";

String ee_authorization_failure_body_sv = "" +
	"<p>Du saknar behörighet till tjänsten du försökte nå.\n" +
	"<p>Typiska behörighetskrav:\n" +
	"\n" +
	"<p><b>En <i>bekräftad</i> användare, även kallad SWAMID AL2</b>\n" +
	"<br>Identiteter bekräftas oftast genom besök i organisationens servicedesk eller motsvarande under uppvisande av legitimation.\n" +
	"\n" +
	"<p><b>Association till organisationen (även kallat affiliation)</b>\n" +
	"<br>Din <i>affiliation</i> beskriver din relation till din organisation. Vanliga <i>affiliations</i> inkluderar <b>student</b> och <b>employee</b>. Om du exempelvis är en student och tjänsten du försökte nå inte fick <i>affiliation</i> <b>student</b> så behöver du kontakta din organisation för att lösa detta.\n" +
	"\n" +
	"<p><b>En specifik behörighet (även kallat entitlement)</b>\n" +
	"<br><i>Entitlements</i> är specifika behörigheter till specifika tjänster. Om du saknar <i>entitlements</i> du anser att du ska ha (d.v.s. att du skall kunna använda tjänsten du försökte nå) så behöver du kontakta din organisation för att rätta till detta.\n" +
	"\n" +
	"<p>Om du anser att du ska ha behörighet till tjänsten, kontakta din organisation och ange vilken tjänst du försökte nå, vilka behörigheter du anser du ska ha, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_authorization_failure_body_en = "" +
	"<p>The service that you tried to access requires privileges that you do not have.\n" +
	"<p>Typical requirements include:\n" +
	"\n" +
	"<p><b>A <i>confirmed</i> user account, or \"high\" <i>identity assurance level</i> (AL)</b>\n" +
	"<br>To confirm your user account, you need to visit IT Service Desk and identify yourself using your national ID card or passport.\n" +
	"\n" +
	"<p><b>Affiliation</b>\n" +
	"<br>Your <i>affiliation</i> describes your relationship with the Blue Star University. The set of attributes include for example <i>student</i> and <i>employee</i>. If you are a student and the service you tried to access did not receive the <i>student</i> affiliation, please contact IT Service Desk to correct this.\n" +
	"\n" +
	"<p><b>Some specific entitlements</b>\n" +
	"<br>Entitlements are specific privileges at specific services. If you are missing entitlements that you think you should have (e.g. you should be able to access this service), please contact IT Service Desk to resolve this.\n" +
	"\n" +
	"<p>If you think you should have access, please contact support at your institution and include the name of the service you tried to access, any privileges that were noted as missing and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";

String ee_authorization_failure_ctx_verified_header_sv = "Verifierad användare krävs";
String ee_authorization_failure_ctx_verified_header_en = "Verified user account required";

String ee_authorization_failure_ctx_verified_body_sv = "" +
	"<p>Tjänsten du försökte nå kräver en <i>verifierad</i> användare, även kallad SWAMID AL3.\n" +
	"<p>Identiteter verifieras oftast genom besök i organisationens servicedesk eller motsvarande under uppvisande av legitimation. Vid inloggning behöver sedan även tvåfaktorsinloggning användas.\n" +
	"<p>Kontakta din organisation för att verifiera din användare och försök igen. Om du redan är verifierade, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_authorization_failure_ctx_verified_body_en = "" +
	"<p>The service you tried to access requires a <i>verified</i> user account, also known as SWAMID AL3.\n" +
	"<p>Identities are often verified by visiting the IT service desk of your institution and identifying yourself using your national ID card or passwport. In addition to this two-factor authentication is required during login.\n" +
	"<p>Please contact support at your institution, verify your user account and try again. If you already are verified, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";

String ee_authorization_failure_ctx_confirmed_header_sv = "Bekräftad användare krävs";
String ee_authorization_failure_ctx_confirmed_header_en = "Confirmed user account required";

String ee_authorization_failure_ctx_confirmed_body_sv = "" +
	"<p>Tjänsten du försökte nå kräver en <i>bekräftad</i> användare, även kallad SWAMID AL2.\n" +
	"<p>Identiteter bekräftas oftast genom besök i organisationens servicedesk eller motsvarande under uppvisande av legitimation.\n" +
	"<p>Kontakta din organisation för att bekräfta din användare och försök igen. Om du redan är bekräftad, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_authorization_failure_ctx_confirmed_body_en = "" +
	"<p>The service you tried to access requires a <i>confirmed</i> user account, also known as SWAMID AL2.\n" +
	"<p>Identities are often confirmed by visiting the IT service desk of your institution and identifying yourself using your national ID card or passwport.\n" +
	"<p>Please contact support at your institution, confirm your user account and try again. If you already are confirmed, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";

String ee_authorization_failure_ctx_non_confirmed_header_sv = "SWAMID basnivå krävs";
String ee_authorization_failure_ctx_non_confirmed_header_en = "SWAMID base level user account required";

String ee_authorization_failure_ctx_non_confirmed_body_sv = "" +
	"<p>Tjänsten du försökte nå kräver en användare som uppfyller SWAMID:s </i>basnivå</i>, även kallad SWAMID AL1.\n" +
	"<p>Din användare uppfyller sannolikt detta men din organisations inloggningstjänst kanske inte är konfigurerad att skicka den informationen till tjänsten du försökte nå.\n" +
	"<p>Kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_authorization_failure_ctx_non_confirmed_body_en = "" +
	"<p>The service you tried to access requires a user account fulfulling the base level of SWAMID, also known as SWAMID AL1.\n" +
	"<p>Your user account most likely fulfills this but your institution may not be configured to release this to the service you tried to access.\n" +
	"<p>Please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";
String ee_other_error_header_sv = "Inloggningsproblem";
String ee_other_error_header_en = "Access error";

String ee_other_error_body_sv = "" +
	"<p>Ett fel uppstod vid inloggning i tjänsten.\n" +
	"<p>Om du tror att du ska kunna använda tjänsten, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelanden du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.\n" +
	"";
String ee_other_error_body_en = "" +
	"<p>An error occurred when accessing the service.\n" +
	"<p>If you think you should be able to access the service, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.\n" +
	"";

%>
