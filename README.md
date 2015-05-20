# Zalando PHP API Wrapper

## Installation

### Composer

Add php-zalando in your composer.json or create a new composer.json:

```js
{
    "require": {
        "cschalenborgh/php-zalando": "dev-master"
    }
}
```

Now tell composer to download the library by running the command:

``` bash
$ php composer.phar install
```

Composer will generate the autoloader file automaticly. So you only have to include this.
Typically its located in the vendor dir and its called autoload.php

## Basic Usage:
This library is using the PSR-0 standard: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
So you can use any autoloader which fits into this standard.

## API Docs:
https://github.com/zalando/shop-api-documentation

## API Demo:
http://zalando.github.io/shop-api-demo/
