# Cups generator

[![Build Status](https://travis-ci.org/xafardero/cups-generator.svg?branch=master)](https://travis-ci.org/xafardero/cups-generator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xafardero/cups-generator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xafardero/cups-generator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xafardero/cups-generator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xafardero/cups-generator/?branch=master)

Generador aleatorio de CUPS

## Usage

```sh
docker build --no-cache -t "cups-generator" ./
docker run -v "`pwd`:/code" cups-generator composer install
docker run -v "`pwd`:/code" cups-generator vendor/bin/phpunit
```
