# zinc-php

PHP SDK for [ZincSearch](https://docs.zincsearch.com/).

This package was first developed for private usage.

Development environment:

- OS : Arch Linux 64bit Kernal v6.3.6
- PHP: v7.2
- Composer: v2.5.8
- ZincSearch server: v0.4.7
- Editor: VSCode

## Install

```shell
composer require wenstudioasia/zinc-php
```

## Usage

@see /tests || @see source files in /src || @see official document

A piece of quite simple code:

```php
use Wenstudio\ZincPhp\Zinc;

// client
$client = new Zinc('http://localhost:4080', 'admin', '123456');

$client->index_create('member');
$client->doc_create('member',['name'=>'Joe', 'age'=>20, 'role'=>'solider']);
$client->doc_create_with_id('address', 201, ['location'=>'somewhere']);
$client->search('test', 'Joe');
```

## Test

```shell
# install zincsearch 0.4.7 (latest today)
# go to https://github.com/zincsearch/zincsearch/releases

# start zincsearch
cd /path/to/zincsearch
mkdir data
ZINC_FIRST_ADMIN_USER=admin ZINC_FIRST_ADMIN_PASSWORD=aa123456 ./zincsearch

cd /path/to/zinc-php
# install dependencies
# should pre-install needed php extensions like php-tokenizer php-dom(unittest)
composer update
ln -s vendor/phpunit/phpunit/phpunit phpunit

# make some modifications to Test*.php
./phpunit tests/TestApi.php
```

## NOTICE

All interfaces are not stable, most likely would be changed in the future.
