# Germania KG · Coupons

**PHP interfaces, traits and classes for working with coupons.**

[![Packagist](https://img.shields.io/packagist/v/germania-kg/coupons.svg?style=flat)](https://packagist.org/packages/germania-kg/coupons)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/coupons.svg)](https://packagist.org/packages/germania-kg/coupons)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Coupons.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Coupons)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Coupons/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Coupons/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Coupons/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Coupons/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Coupons/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Coupons/build-status/master)



## Installation with Composer

```bash
$ composer require germania-kg/coupons
```


## Development

```bash
$ git clone https://github.com/GermaniaKG/Coupons.git
$ cd Coupons
$ composer install
```

## Unit tests

Copy `phpunit.xml.dist` to `phpunit.xml`. The current settings will work fine in most cases; feel free to edit your XML file according to your needs. For using the database tests, edit the development database credentials in the `php` section. For testing, go to package root directory and issue `phpunit`. These packages for testing come via Composer:

- Kitamura Satoshi's PHP client library for Coveralls API: [php-coveralls/php-coveralls](https://packagist.org/packages/php-coveralls/php-coveralls)
- Sebastian Bergmann's PHPUnit [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit)
