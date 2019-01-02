<p align="center">
    <a href="https://www.mangoweb.cz/en/" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/38423357?s=200&v=4"/>
    </a>
</p>
<h1 align="center">ČSOB Payment Gateway Plugin</h1>

## Features

* Card payments as supported by ČSOB
  * Czechia: https://platebnibrana.csob.cz
  * Slovakia: https://www.csob.sk/podnikatelia-firmy/platby-pre-eshopy
* Fully integrated as Sylius payment method
* Using more different gateways at once or per channel

<p align="center">
	<img src="https://raw.githubusercontent.com/mangoweb-sylius/SyliusCsobPaymentGatewayPlugin/master/doc/admin.png"/>
</p>

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-csob-payment-gateway-plugin`.
2. Register `\MangoSylius\CsobPaymentGatewayPlugin\MangoSyliusCsobPaymentGatewayPlugin` in your Kernel.

## Usage

* <b>Create CSOB payment type</b><br>in Sylius admin panel<br>
* <b>Insert client SANDBOX key</b><br>put the key into the file `/config/csobKeys/clientKeys/sandbox/{Key file name}`
* <b>Insert client PRODUCTION key</b><br>put the key into the file `/config/csobKeys/clientKeys/prod/{Key file name}`

Name of the file with the key is not important, just keep it the same for sandbox and production and remember to put the same filename (without its path) into the "Key file name" field. Recpect lowercas and uppercase characters.

## Development

### Usage

- Create symlink from .env.dist to .env or create your own .env file
- Develop your plugin in `/src`
- See `bin/` for useful commands

### Testing

After your changes you must ensure that the tests are still passing.
* Easy Coding Standard
  ```bash
  bin/ecs.sh
  ```
* PHPStan
  ```bash
  bin/phpstan.sh
  ```
License
-------
This library is under the MIT license.

Credits
-------
Developed by [manGoweb](https://www.mangoweb.eu/).
