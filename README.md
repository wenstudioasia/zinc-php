# zinc-php

PHP SDK for [ZincSearch](https://docs.zincsearch.com/).

This package was first developed for private usage.

Development environment:

- OS : Arch Linux
- PHP: v7.2
- Composer: v2.4.1
- ZincSearch server: v0.3.1
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

## NOTICE

All interfaces are not stable, most likely would be changed in the future.
