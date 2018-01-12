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
  * [Authors](#authors)
  * [License](#license)

## Requirements

* PHP 7.0 or higher
* [Composer](https://getcomposer.org/)

## Installation

The recommended way to install this libarary is with Composer. Composer is a dependency management 
tool for PHP that allows you to declare the dependencies your project needs and installs them into 
your project.

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

You can add this library as a dependency using following command:

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

## Authors

[Tarmo Leppänen](https://github.com/tarlepp)

## License

[The MIT License (MIT)](LICENSE)

Copyright (c) 2018 Protacon
