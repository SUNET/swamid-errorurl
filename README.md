# swamid-errorurl

This is the SWAMID errorURL template, implementing the [SAML V2.0 Metadata Deployment Profile for errorURL Version 1.0](https://refeds.org/specifications/saml-v2-0-metadata-deployment-profile-for-errorurl-version-1-0).

Feel free to clone this repository, modify for you own needs and publish as the errorURL of your own Identity Provider.

Please contact operations@swamid.se on any questions regarding this template.

## Installation

The PHP version:

1. Replace logo.png with your own logo
1. Update at least DISPLAYNAME and EMAIL in config.php
1. Upload the contents of php to, for example, https://saml-error.example.com
1. Tell your federation operator to set the errorURL of your Identity Provider to https://saml-error.example.com/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX

The JSP version:

1. Replace logo.png with your own logo
1. Update at least DISPLAYNAME and EMAIL in config.jsp
1. Upload the contents of jsp to, for example, https://saml-error.example.com
1. Tell your federation operator to set the errorURL of your Identity Provider to https://saml-error.example.com/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX

## License

Copyright (c) 2019 - 2020, SUNET (BSD 2-clause license)

See LICENSE for more info.
