# Germania KG · Coupons

**PHP interfaces, traits and classes for working with coupons.**

## Installation

```bash
$ composer require germania-kg/coupons
```


## Development and Testing

### Grab Repo

```bash
$ git clone git@bitbucket.org:germania-kg/coupons.git
```

### Testing

Copy `phpunit.xml.dist` to `phpunit.xml`. The current settings will work fine in most cases; feel free to edit your XML file according to your needs. For using the database tests, edit the development database credentials in the `php` section. For testing, go to package root directory and issue `phpunit`. These packages for testing come via Composer:

- Kitamura Satoshi's PHP client library for Coveralls API: [php-coveralls/php-coveralls](https://packagist.org/packages/php-coveralls/php-coveralls)
- Sebastian Bergmann's PHPUnit [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit)
