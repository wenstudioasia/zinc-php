# How to run tests

1. Start ZincSearch server
2. Load sample data

```shell
curl -L https://github.com/zinclabs/zinc/releases/download/v0.1.1/olympics.ndjson.gz -o olympics.ndjson.gz
gzip -d  olympics.ndjson.gz
curl http://localhost:4080/api/_bulk -i -u admin:Complexpass#123  --data-binary "@olympics.ndjson"
```

3. Install source code dependencies

```shell
composer install
```

4. Run tests

```shell
./vendor/bin/phpunit tests/Test*.php
```
