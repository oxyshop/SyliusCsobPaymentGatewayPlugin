<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MangoSyliusCsobPaymentGatewayPlugin extends Bundle
{
	use SyliusPluginTrait;
}
