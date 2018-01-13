# What is this

[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE)
[![Build Status](https://travis-ci.org/protacon/vf-rest.png?branch=master)](https://travis-ci.org/protacon/vf-rest)
[![Latest Stable Version](https://poser.pugx.org/protacon/vf-rest/v/stable)](https://packagist.org/packages/protacon/vf-rest)
[![Total Downloads](https://poser.pugx.org/protacon/vf-rest/downloads)](https://packagist.org/packages/protacon/vf-rest)
[![Latest Unstable Version](https://poser.pugx.org/protacon/vf-rest/v/unstable)](https://packagist.org/packages/protacon/vf-rest)

Simple library for [ValueFrame REST API](https://www.valueframe.fi/help/lisapalvelut/rest/).

Basically this is a wrapper for [guzzlehttp/guzzle](http://docs.guzzlephp.org/en/stable/) - this library
just adds necessary headers to each request.

## Table of Contents

* [What is this?](#what-is-this)
  * [Table of Contents](#table-of-contents)
  * [Requirements](#requirements)
  * [Installation](#installation)
  * [Usage](#usage)
  * [Development](#development)
    * [IDE](#ide)
    * [PHP Code Sniffer](#php-code-sniffer)
    * [Testing](#testing)
    * [Metrics](#metrics)
  * [Authors](#authors)
  * [License](#license)

## Requirements

* PHP 7.0 or higher
* [Composer](https://getcomposer.org/)

## Installation

The recommended way to install this library is with Composer. Composer is a dependency management 
tool for PHP that allows you to declare the dependencies your project needs and installs them into 
your project.

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

You can add this library as a dependency to your project using following command:

```bash
composer require protacon/vf-rest
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Usage

First of all you should read [official documentation](https://www.valueframe.fi/help/lisapalvelut/rest/) 
about [ValueFrame](https://www.valueframe.com/) REST API.

Simple usage example:

```php
<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$customer = 'asiakas';            // X-VF-REST-USER , see docs
$token    = 'siirtoavain';        // {SIIRTOAVAIN} , see docs
$resource = 'tehtavan_kommentti'; // {REST_resurssi} , see docs

$client = \ValueFrame\Rest\Factory::build($customer, $token, $resource);

try {
    $response = $client->get('');

    \var_dump($response->getStatusCode());
    \var_dump(\json_decode($response->getBody()->getContents()));
} catch (\GuzzleHttp\Exception\BadResponseException $exception) {
    \var_dump($exception->getResponse()->getStatusCode());
    \var_dump(\json_decode($exception->getResponse()->getBody()->getContents()));
}
```

## Development

* [PSR-2: Coding Style Guide](http://www.php-fig.org/psr/psr-2/)

### IDE

I highly recommend that you use "proper"
[IDE](https://en.wikipedia.org/wiki/Integrated_development_environment)
to development your application. Below is short list of some popular IDEs that
you could use.

* [PhpStorm](https://www.jetbrains.com/phpstorm/)
* [NetBeans](https://netbeans.org/)
* [Sublime Text](https://www.sublimetext.com/)
* [Visual Studio Code](https://code.visualstudio.com/)

### PHP Code Sniffer

It's highly recommended that you use this tool while doing actual development
to application. PHP Code Sniffer is added to project `dev` dependencies, so
all you need to do is just configure it to your favorite IDE. So the `phpcs`
command is available via following example command.

```bash
./vendor/bin/phpcs -i
```

If you're using [PhpStorm](https://www.jetbrains.com/phpstorm/) following links
will help you to get things rolling.

* [Using PHP Code Sniffer Tool](https://www.jetbrains.com/help/phpstorm/10.0/using-php-code-sniffer-tool.html)
* [PHP Code Sniffer in PhpStorm](https://confluence.jetbrains.com/display/PhpStorm/PHP+Code+Sniffer+in+PhpStorm)

### Testing

Library uses [PHPUnit](https://phpunit.de/) for testing. You can run all tests
by following command:

```bash
./vendor/bin/phpunit
```

Or you could easily configure your IDE to run those for you.

### Metrics

Library uses
[PhpMetrics](https://github.com/phpmetrics/phpmetrics)
to make static analyze of its code. You can run this by following command:

```
./vendor/bin/phpmetrics --junit=build/logs/junit.xml --report-html=build/phpmetrics .
```

And after that open `build/phpmetrics/index.html` with your favorite browser.

## Authors

[Tarmo Leppänen](https://github.com/tarlepp)

## License

[The MIT License (MIT)](LICENSE)

Copyright (c) 2018 Protacon
