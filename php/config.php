<?php

$logo = 'logo.png';

date_default_timezone_set('UTC');

$default_lang = 'sv';
$languages = array(
	'sv' => array(
		'logo' => 'swedish.png',
		'select' => 'På svenska',
	),
	'en' => array(
		'logo' => 'english.png',
		'select' => 'In English',
	),
);

$texts = array(
	'sv' => array(
		'contact_information' => 'Supporten för din organisation, DISPLAYNAME, kan nås via EMAIL.',
		'technical_information' => 'Teknisk information',
		'footer' => '<hr><i>Detta är en generell felsida för federerad inloggning (errorURL) inom <a href="https://www.swamid.se/">SWAMID</a>. Varje organisation kan skapa en egen felsida. Använd gärna denna sida som inspiration. Kontakta operations@swamid.se för mer information om errorURL i SWAMID.</i>',
	),
	'en' => array(
		'contact_information' => 'The support of your organisation, DISPLAYNAME, can be reached at EMAIL.',
		'technical_information' => 'Technical information',
		'footer' => '<hr><i>This is a generic error page for federated login (errorURL) within <a href="https://www.swamid.se/">SWAMID</a>. Every organisation in SWAMID may design and publish their own error page. Feel free to use this page as inspiration. Please contact operations@swamid.se for more information regarding errorURL in SWAMID.</i>',
	),
);

$errorurl_errors = array(
	'ERRORURL_CODE' => array(
		'sv' => array(
			'header' => '
				Problem vid inloggning
				',
			'body' => '
				<p>Inloggning till tjänsten misslyckades. Se nedan för möjliga orsaker och åtgärder.
				',
		),
		'en' => array(
			'header' => '
				Login failed
				',
			'body' => '
				<p>Login failed at the service you tried to access. Please see below for possible reasons and actions.
				',
		),
	),

	'IDENTIFICATION_FAILURE' => array(
		'sv' => array(
			'header' => '
				Attribut saknas
				',
			'body' => '
				<p>Tjänsten du försökte nå fick inte de attribut den behöver för att identifiera dig eller för att personanpassa tjänsten.
				<p>Detta kan bero på att din organisation saknar dessa uppgifter om dig eller att organisationens inloggningstjänst inte är konfigurerat för att skicka attributen till tjänsten du försökte nå.
				<p>Kontakta din organisation och ange vilken tjänst du försökte nå, vilka attribut som saknades om du vet vilka dessa är (tjänsten kan ha berättat detta för er) samt, om möjligt, en skärmdump med eventuella felmeddelanden som tjänsten gav dig inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
				',
		),
		'en' => array(
			'header' => '
				Identification failed
				',
			'body' => '
				<p>The service that you tried to access did not get all required attributes for identification and/or personalization.
				<p>This may be because your institution is missing those attributes or that your institution is not configured to release those attributes to the service you tried to access.
				<p>Please contact support at your institution and include the name of the service you tried to access, any missing attributes if you know what they are (the service may have informed you) and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
				',
		),
	),

	'AUTHENTICATION_FAILURE' => array(
		'sv' => array(
			'header' => '
				Inloggning misslyckades
				',
			'body' => '
				<p>Ett fel uppstod i tjänsten du försökte nå i samband med inloggning.
				<p>Detta kan bero på att ytterligare steg krävs vid inloggning, till exempel användning av tvåfaktorsinloggning. Vänligen försök igen.
				<p>Om du inte lyckas lösa problemet, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
				',
		),
		'en' => array(
			'header' => '
				Authentication error
				',
			'body' => '
				<p>The service you tried to access failed during the authentication stage
				<p>This may be because it requires additional steps which did not occur during login (such as using a second factor). Please try again.
				<p>If you cannot resolve the issue yourself, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
				',
		),
	),

	'AUTHORIZATION_FAILURE' => array(
		'sv' => array(
			'header' => '
				Behörighet saknas
				',
			'body' => '
				<p>Du saknar behörighet till tjänsten du försökte nå.
				<p>Typiska behörighetskrav:

				<p><b>En <i>bekräftad</i> användare, även kallad SWAMID AL2</b>
				<br>Identiteter bekräftas oftast genom besök i organisationens servicedesk eller motsvarande under uppvisande av legitimation.

				<p><b>Association till organisationen (även kallat affiliation)</b>
				<br>Din <i>affiliation</i> beskriver din relation till din organisation. Vanliga <i>affiliations</i> inkluderar <b>student</b> och <b>employee</b>. Om du exempelvis är en student och tjänsten du försökte nå inte fick <i>affiliation</i> <b>student</b> så behöver du kontakta din organisation för att lösa detta.

				<p><b>En specifik behörighet (även kallat entitlement)</b>
				<br><i>Entitlements</i> är specifika behörigheter till specifika tjänster. Om du saknar <i>entitlements</i> du anser att du ska ha (d.v.s. att du skall kunna använda tjänsten du försökte nå) så behöver du kontakta din organisation för att rätta till detta.

				<p>Om du anser att du ska ha behörighet till tjänsten, kontakta din organisation och ange vilken tjänst du försökte nå, vilka behörigheter du anser du ska ha, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
				',
			'ctx' => array(
				'verified' => array(
					'identifiers' => array(
						'http://www.swamid.se/policy/assurance/al3',
						'https://refeds.org/assurance/IAP/high',
						'https://refeds.org/assurance/profile/espresso',
					),
					'header' => '
						Verifierad användare krävs
						',
					'body' => '
						<p>Tjänsten du försökte nå kräver en <i>verifierad</i> användare, även kallad SWAMID AL3.
						<p>Identiteter verifieras oftast genom besök i organisationens servicedesk eller motsvarande under uppvisande av legitimation. Vid inloggning behöver sedan även tvåfaktorsinloggning användas.
						<p>Kontakta din organisation för att verifiera din användare och försök igen. Om du redan är verifierade, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
					',
				),

				'confirmed' => array(
					'identifiers' => array(
						'http://www.swamid.se/policy/assurance/al2',
						'https://refeds.org/assurance/IAP/medium',
						'https://refeds.org/assurance/profile/cappuccino',
					),
					'header' => '
						Bekräftad användare krävs
						',
					'body' => '
						<p>Tjänsten du försökte nå kräver en <i>bekräftad</i> användare, även kallad SWAMID AL2.
						<p>Identiteter bekräftas oftast genom besök i organisationens servicedesk eller motsvarande under uppvisande av legitimation.
						<p>Kontakta din organisation för att bekräfta din användare och försök igen. Om du redan är bekräftad, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
					',
				),

				'non-confirmed' => array(
					'identifiers' => array(
						'http://www.swamid.se/policy/assurance/al1',
						'https://refeds.org/assurance/IAP/low',
					),
					'header' => '
						SWAMID basnivå krävs
						',
					'body' => '
						<p>Tjänsten du försökte nå kräver en användare som uppfyller SWAMID:s </i>basnivå</i>, även kallad SWAMID AL1.
						<p>Din användare uppfyller sannolikt detta men din organisations inloggningstjänst kanske inte är konfigurerad att skicka den informationen till tjänsten du försökte nå.
						<p>Kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelande du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
					',
				),
			),
		),
		'en' => array(
			'header' => '
				Insufficient privileges
				',
			'body' => '
				<p>The service that you tried to access requires privileges that you do not have.
				<p>Typical requirements include:

				<p><b>A <i>confirmed</i> user account, or "high" <i>identity assurance level</i> (AL)</b>
				<br>To confirm your user account, you need to visit IT Service Desk and identify yourself using your national ID card or passport.

				<p><b>Affiliation</b>
				<br>Your <i>affiliation</i> describes your relationship with the Blue Star University. The set of attributes include for example <i>student</i> and <i>employee</i>. If you are a student and the service you tried to access did not receive the <i>student</i> affiliation, please contact IT Service Desk to correct this.

				<p><b>Some specific entitlements</b>
				<br>Entitlements are specific privileges at specific services. If you are missing entitlements that you think you should have (e.g. you should be able to access this service), please contact IT Service Desk to resolve this.


				<p>If you think you should have access, please contact support at your institution and include the name of the service you tried to access, any privileges that were noted as missing and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
				',
			'ctx' => array(
				'verified' => array(
					'identifiers' => array(
						'http://www.swamid.se/policy/assurance/al3',
						'https://refeds.org/assurance/IAP/high',
						'https://refeds.org/assurance/profile/espresso',
					),
					'header' => '
						Verified user account required
						',
					'body' => '
						<p>The service you tried to access requires a <i>verified</i> user account, also known as SWAMID AL3.
						<p>Identities are often verified by visiting the IT service desk of your institution and identifying yourself using your national ID card or passwport. In addition to this two-factor authentication is required during login.
						<p>Please contact support at your institution, verify your user account and try again. If you already are verified, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
					',
				),

				'confirmed' => array(
					'identifiers' => array(
						'http://www.swamid.se/policy/assurance/al2',
						'https://refeds.org/assurance/IAP/medium',
						'https://refeds.org/assurance/profile/cappuccino',
					),
					'header' => '
						Confirmed user account required
						',
					'body' => '
						<p>The service you tried to access requires a <i>confirmed</i> user account, also known as SWAMID AL2.
						<p>Identities are often confirmed by visiting the IT service desk of your institution and identifying yourself using your national ID card or passwport.
						<p>Please contact support at your institution, confirm your user account and try again. If you already are confirmed, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
					',
				),

				'non-confirmed' => array(
					'identifiers' => array(
						'http://www.swamid.se/policy/assurance/al1',
						'https://refeds.org/assurance/IAP/low',
					),
					'header' => '
						SWAMID base level user account required
						',
					'body' => '
						<p>The service you tried to access requires a user account fulfulling the base level of SWAMID, also known as SWAMID AL1.
						<p>Your user account most likely fulfills this but your institution may not be configured to release this to the service you tried to access.
						<p>Please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
					',
				),
			),
		),
	),

	'OTHER_ERROR' => array(
		'sv' => array(
			'header' => '
				Inloggningsproblem
				',
			'body' => '
				<p>Ett fel uppstod vid inloggning i tjänsten.
				<p>Om du tror att du ska kunna använda tjänsten, kontakta din organisation och ange vilken tjänst du försökte nå, eventuella felmeddelanden du fick samt, om möjligt, en skärmdump med felmeddelandena inklusive webbadressen högst upp i webbläsaren och motsvarande från denna sida.
				',
		),
		'en' => array(
			'header' => '
				Access error
				',
			'body' => '
				<p>An error occurred when accessing the service.
				<p>If you think you should be able to access the service, please contact support at your institution and include the name of the service you tried to access, any error information given by the service and, if possible, a screenshot of the error message at the service (including the address bar at the top of the web browser) and also of this message.
				',
		),
	),
);

?>
