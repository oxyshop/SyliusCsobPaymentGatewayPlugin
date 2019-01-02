<p align="center">
    <a href="https://www.mangoweb.cz/en/" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/38423357?s=200&v=4"/>
    </a>
</p>
<h1 align="center">CSOB payment plugin</h1>

## Features

xxxx

* xxxxx

## Installation

1. Run `$ composer require mangoweb-sylius/sylius-csob-payment-gateway-plugin`.
2. Register `\MangoSylius\CsobPaymentGatewayPlugin\MangoSyliusCsobPaymentGatewayPlugin` in your Kernel.

## Usage

* <b>Create CSOB payment type</b><br>in administration<br>
* <b>Insert client SANDBOX key</b><br>insert key file to `/config/csobKeys/clientKeys/sandbox/{Key file name}`"
* <b>Insert client PRODUCTION key</b><br>insert key file to `/config/csobKeys/clientKeys/prod/{Key file name}`"

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
