# Zalando PHP API Wrapper

[![Build Status](https://travis-ci.org/cschalenborgh/php-zalando.svg)](https://travis-ci.org/cschalenborgh/php-zalando)
[![Coverage Status](https://coveralls.io/repos/cschalenborgh/php-zalando/badge.svg?branch=master)](https://coveralls.io/r/cschalenborgh/php-zalando?branch=master)
[![Total Downloads](https://poser.pugx.org/cschalenborgh/php-zalando/d/total.svg)](https://packagist.org/packages/cschalenborgh/php-zalando)
[![License](https://poser.pugx.org/cschalenborgh/php-zalando/license.svg)](https://packagist.org/packages/cschalenborgh/php-zalando)

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

Composer will generate the autoloader file automatically. So you only have to include this.
Typically its located in the vendor dir and its called autoload.php

## Basic Usage:
This library is using the PSR-0 standard: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
So you can use any autoloader which fits into this standard.

## API Docs:
https://github.com/zalando/shop-api-documentation/wiki/

## API Demo:
http://zalando.github.io/shop-api-demo/

## Supported API methods:

- https://api.zalando.com/article-reviews
- https://api.zalando.com/article-reviews/{reviewId}
- https://api.zalando.com/article-reviews-summaries
- https://api.zalando.com/article-reviews-summaries/{articleModelId}
- https://api.zalando.com/articles
- https://api.zalando.com/articles/{articleId}
- https://api.zalando.com/articles/{articleId}/media
- https://api.zalando.com/articles/{articleId}/reviews
- https://api.zalando.com/articles/{articleId}/reviews-summary
- https://api.zalando.com/articles/{articleId}/units
- https://api.zalando.com/articles/{articleId}/units/{unitId}
- https://api.zalando.com/brands
- https://api.zalando.com/brands/{key}
- https://api.zalando.com/categories
- https://api.zalando.com/categories/{key}
- https://api.zalando.com/domains
- https://api.zalando.com/facets?{filters}
- https://api.zalando.com/filters
- https://api.zalando.com/filters/{name}
- https://api.zalando.com/recommendations/{articleIds}

## Multiple filter values

Since Zalando uses multiple filter values like this:
https://api.zalando.com/articles?brandFamily=nike&color=white&color=red&page=1&pageSize=2

We've chosen to accept comma seperated values for the filter setting. For example:
$articles->setColor('white,red');

Feel free to contribute.