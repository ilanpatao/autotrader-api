# autotrader-api

## Description

REST API which pulls all vehicles (used, new and certified) for sale with full details from AutoTrader.com

## Technical

PHP CURL XHR request to AutoTrader.com requesting listings of all Used, New and Certified vehicles listed for sale in real-time. Full vehicle details returned includes year, make, model, trim, color, VIN, condition, seller's name, seller's e-mail, seller's phone number, listing ID and vehicle images. You can even obtain the average price for all vehicles as well as the high and low listed prices among all results.

## Developer Setup

### Prequisites

#### Composer

Make sure you have Composer installed

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
```

#### Dependencies

Install dependencies via Composer

```
composer install
```

### Running Locally

```
composer start # website will be served on localhost:9000
```

## Usage ideas

Web apps and/or sites that wish to display AutoTrader data on their platform.
Automatically obtain custom vehicle sale lists that exist within AutoTrader.
Widgetize and include AutoTrader vehicle listings into your apps or site.
Build and initiate calculation on vehicle sales in your developments.
Automate/Data capture, or scrape; and quickly find vehicles for sale and contact the owners direct.

## Demo

http://dangerstudio.com/api/autotrader-api/ (updated)
https://autotrader-api.herokuapp.com/ (no longer supported)

## Author

Ilan Patao (ilan@dangerstudio.com)
