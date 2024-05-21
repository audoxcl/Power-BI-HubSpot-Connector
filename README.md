# Power BI HubSpot Connector

## Description

The purpose of this connector is to access HubSpot data from Power BI so you can create more advanced reports.

This connector can also be used to extract data from HubSpot with any other purpose, i.e. you can extract data to load it into a database.

## Instructions

1. Copy files to your server so you can access it via url like:
https://yourdomain.com/Power-BI-HubSpot-Connector/index.php
2. Edit file auth.php to restrict access to this connector giving authorization only to valid tokens
3. Start your Power BI report using our template available at:
https://github.com/audoxcl/Power-BI-Examples/blob/main/HubSpot.pbix

In Power BI Desktop you should set all these parameters (in the Power Query Editor window):

1. **url:** the url where the connector is installed.
2. **token:** the token used to use the connector. See auth.php file to change the way this token is validated. The token 'FREETOKEN' will work until you edit auth.php file. Also, you can add multiple tokens in auth.php file.
3. **hapikey_token:** the token to access HubSpot data. To create a token you have to create first a Private App at Settings -> Integrations -> 'Private Apps'.
4. **account_id:** the id used in Power BI report to create the url link to each record inside your HubSpot account. The account id is located in your HubSpot account in the popup window once you click on your avatar image top right.

This connector might be limited due to HubSpot API rate limitations.

## Contact Us:

- info@audox.com
- www.audox.com
- www.audox.mx
- www.audox.es
- www.audox.cl
