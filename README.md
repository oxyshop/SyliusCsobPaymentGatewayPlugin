<p align="center">
    <a href="https://www.mangoweb.cz/en/" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/38423357?s=200&v=4"/>
    </a>
</p>
<h1 align="center">
ČSOB Payment Gateway Plugin
<br />
        <a href="https://packagist.org/packages/mangoweb-sylius/sylius-csob-payment-gateway-plugin" title="License" target="_blank">
            <img src="https://img.shields.io/packagist/l/mangoweb-sylius/sylius-csob-payment-gateway-plugin.svg" />
        </a>
        <a href="https://packagist.org/packages/mangoweb-sylius/sylius-csob-payment-gateway-plugin" title="Version" target="_blank">
            <img src="https://img.shields.io/packagist/v/mangoweb-sylius/sylius-csob-payment-gateway-plugin.svg" />
        </a>
        <a href="https://travis-ci.org/mangoweb-sylius/SyliusCsobPaymentGatewayPlugin" title="Build status" target="_blank">
            <img src="https://img.shields.io/travis/mangoweb-sylius/SyliusCsobPaymentGatewayPlugin/master.svg" />
        </a>
</h1>

## Features

* Card payments as supported by ČSOB
  * Czechia: https://platebnibrana.csob.cz
  * Slovakia: https://www.csob.sk/podnikatelia-firmy/platby-pre-eshopy
* Fully integrated as Sylius payment method
* Using more different gateways at once or per channel

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-csob-payment-gateway-plugin`.
2. Register `\MangoSylius\CsobPaymentGatewayPlugin\MangoSyliusCsobPaymentGatewayPlugin` in your Kernel.

## Usage

* <b>Create CSOB payment type</b><br>in Sylius admin panel<br>

## Development

### Usage

- Develop your plugin in `/src`
- See `bin/` for useful commands

### Testing

After your changes you must ensure that the tests are still passing.

```bash
$ composer install
$ bin/console doctrine:schema:create -e test
$ bin/behat
$ bin/phpstan.sh
$ bin/ecs.sh
```

License
-------
This library is under the MIT license.

Credits
-------
Developed by [manGoweb](https://www.mangoweb.eu/).
