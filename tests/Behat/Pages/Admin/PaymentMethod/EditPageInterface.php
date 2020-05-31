<?php

declare(strict_types=1);

namespace Tests\MangoSylius\CsobPaymentGatewayPlugin\Behat\Pages\Admin\PaymentMethod;

use Sylius\Behat\Page\Admin\Channel\UpdatePageInterface as BaseUpdatePageInterface;

interface EditPageInterface extends BaseUpdatePageInterface
{
	public function setCsobMerchantNumber(string $value): void;

	public function setCsobKey(string $value): void;
}
