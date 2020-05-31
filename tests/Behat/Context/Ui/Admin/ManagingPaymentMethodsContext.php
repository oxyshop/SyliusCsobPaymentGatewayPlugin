<?php

declare(strict_types=1);

namespace Tests\MangoSylius\CsobPaymentGatewayPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Tests\MangoSylius\CsobPaymentGatewayPlugin\Behat\Pages\Admin\PaymentMethod\EditPageInterface;

final class ManagingPaymentMethodsContext implements Context
{
	/** @var EditPageInterface */
	private $updatePage;

	public function __construct(
		EditPageInterface $updatePage
	) {
		$this->updatePage = $updatePage;
	}

	/**
	 * @When I configure it with test CSOB credentials
	 */
	public function iConfigureItWithTestCsobCredentials()
	{
		$this->updatePage->setCsobMerchantNumber('TEST');
		$this->updatePage->setCsobKey('TEST');
	}
}
