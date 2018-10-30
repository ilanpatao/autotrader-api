# autotrader-api

Description:
REST API which pulls all vehicles (used, new and certified) for sale with full details from AutoTrader.com

Technical:
PHP CURL XHR request to AutoTrader.com requesting listings of all Used, New and Certified vehicles listed for sale in real-time. Full vehicle details returned includes year, make, model, trim, color, VIN, condition, seller's name, seller's e-mail, seller's phone number, listing ID and vehicle images. You can even obtain the average price for all vehicles as well as the high and low listed prices among all results.

Usage ideas:
Web apps and/or sites that wish to display AutoTrader data on their platform.
Automatically obtain custom vehicle sale lists that exist within AutoTrader.
Widgetize and include AutoTrader vehicle listings into your apps or site.
Build and initiate calculation on vehicle sales in your developments.
Automate/Data capture, or scrape; and quickly find vehicles for sale and contact the owners direct.

October 2018 Update:
AutoTrader revised the API endpoint along with some new nested object structure which caused the previous script to skip parsing certain vehicle listing details. As of today, 10/30/2018 the code has been updated and is now working again as expected. Note: AutoTrader periodically makes changes to their API, while I don't check for them if you see any issues feel free to contact me and I will update the code.

Demo:
http://dangerstudio.com/api/autotrader-api/ (updated)

https://autotrader-api.herokuapp.com/ (no longer supported)

Author:
Ilan Patao (ilan@dangerstudio.com)
