# swamid-errorurl

This is the SWAMID errorURL template, implementing the [SAML V2.0 Metadata Deployment Profile for errorURL Version 1.0](https://refeds.org/specifications/saml-v2-0-metadata-deployment-profile-for-errorurl-version-1-0).

Feel free to clone this repository, modify for you own needs and publish as the errorURL of your own Identity Provider.

Please contact operations@swamid.se on any questions regarding this template.

## Installation

### The HTML version

In the `html` directory

1. Replace `logo.png` with your own logo
1. Update at least `DISPLAYNAME` and `EMAIL` in all html files
1. Upload the contents of `html` to, for example, `https://saml-error.example.com`
1. Tell your federation operator to set the errorURL of your Identity Provider to `https://saml-error.example.com/ERRORURL_CODE.html`

### The PHP version

In the `php` directory

1. Replace `logo.png` with your own logo
1. Update at least `DISPLAYNAME` and `EMAIL` in `texts.*.json`
1. Upload the contents of `php` to, for example, `https://saml-error.example.com`
1. Tell your federation operator to set the errorURL of your Identity Provider to `https://saml-error.example.com/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX`

### The JSP version

In the `jsp` directory

#### Shibboleth IdP v4 (Jetty)

1. Replace `webapp/logo.png` with your own logo
1. Update at least `DISPLAYNAME` and `EMAIL` in `webapp/WEB-INF/resources/texts.*.json`
1. Download json.org from https://github.com/stleary/JSON-java and save to `webapp/WEB-INF/lib/`
1. Create `error.war` file
    ````
    jar cf error.war -C webapp .
    ````
1. Copy `error.war` to `jetty-base`
    ```
    cp error.war /opt/jetty/jetty-base/
    ```
1. Add `error.xml` to Jetty
    ```
    cp jetty/error.xml /opt/jetty/jetty-base/webapps/
    ```
1. Tell your federation operator to set the errorURL of your Identity Provider to `https://saml-error.example.com/error/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX`

#### Clean Jetty

1. Replace `webapp/logo.png` with your own logo
1. Update at least `DISPLAYNAME` and `EMAIL` in `webapp/WEB-INF/resources/texts.*.json`
1. Download json.org from https://github.com/stleary/JSON-java and save to webapp/WEB-INF/lib/
1. Create `error.war` file
    ```
    jar cf error.war -C webapp .
    ```
1. Download and unpack Jetty from https://www.eclipse.org/jetty/download.php
    ```
    mkdir /tmp/jetty
    cd /tmp/jetty
    wget https://repo1.maven.org/maven2/org/eclipse/jetty/jetty-home/11.0.0/jetty-home-11.0.0.tar.gz
    tar xzf jetty-home-11.0.0.tar.gz
    ```
1. Set JETTY_HOME
    ```
    export JETTY_HOME=/tmp/jetty/jetty-home-11.0.0
    ```
1. Initialize `jetty-base`
    ```
    mkdir /tmp/jetty-base
    cd /tmp/jetty-base
    java -jar $JETTY_HOME/start.jar --add-module=server,http,deploy,jsp
    ```
1. Deploy `error.war`
    ```
    cp error.war /tmp/jetty-base/webapps
    ```
1. Start Jetty
    ```
    cd /tmp/jetty-base
    java -jar $JETTY_HOME/start.jar
    ```
1. Tell your federation operator to set the errorURL of your Identity Provider to `http://saml-error.example.com:8080/error/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX`

#### Apache Tomcat

1. Replace `webapp/logo.png` with your own logo
1. Update at least `DISPLAYNAME` and `EMAIL` in `webapp/WEB-INF/resources/texts.*.json`
1. Download json.org from https://github.com/stleary/JSON-java and save to webapp/WEB-INF/lib/
1. Create `error.war` file
    ```
    jar cf error.war -C webapp .
    ```
1. Copy `error.war` to `/opt/tomcat/webapps`
    ```
    cp error.war /opt/tomcat/webapps
    ```
1. Tell your federation operator to set the errorURL of your Identity Provider to `https://saml-error.example.com/error/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX`

### The .Net Core version

In the `dotnetapp` directory

1. Replace `wwwroot/images/logo.png` with your own logo
1. Update at least `DISPLAYNAME` and `EMAIL` in `texts.*.json`
1. Upload the published version of dotnetapp to, for example, https://saml-error.example.com
1. Tell your federation operator to set the errorURL of your Identity Provider to `https://saml-error.example.com/?errorurl_code=ERRORURL_CODE&errorurl_ts=ERRORURL_TS&errorurl_rp=ERRORURL_RP&errorurl_tid=ERRORURL_TID&errorurl_ctx=ERRORURL_CTX`

## License

Copyright (c) 2019 - 2020, SUNET (BSD 2-clause license)

See LICENSE for more info.
