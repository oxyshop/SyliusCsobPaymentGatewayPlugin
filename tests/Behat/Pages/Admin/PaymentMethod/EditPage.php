<?php

declare(strict_types=1);

namespace Tests\MangoSylius\CsobPaymentGatewayPlugin\Behat\Pages\Admin\PaymentMethod;

use Sylius\Behat\Page\Admin\Channel\UpdatePage as BaseUpdatePage;

final class EditPage extends BaseUpdatePage implements EditPageInterface
{
	public function setCsobMerchantNumber(string $value): void
	{
		$this->getDocument()->fillField('sylius_payment_method_gatewayConfig_config_merchantId', $value);
	}

	public function setCsobKey(string $value): void
	{
		$this->getDocument()->fillField('sylius_payment_method_gatewayConfig_config_keyPrivate', $value);
	}
}
