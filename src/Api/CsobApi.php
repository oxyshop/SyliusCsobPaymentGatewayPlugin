<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin\Api;

use SlevomatCsobGateway\Api\ApiClient;
use SlevomatCsobGateway\Api\Driver\CurlDriver;
use SlevomatCsobGateway\Api\HttpMethod;
use SlevomatCsobGateway\Call\PaymentStatus;
use SlevomatCsobGateway\Call\PayMethod;
use SlevomatCsobGateway\Call\PayOperation;
use SlevomatCsobGateway\Cart;
use SlevomatCsobGateway\Crypto\CryptoService;
use SlevomatCsobGateway\Currency;
use SlevomatCsobGateway\Language;
use SlevomatCsobGateway\RequestFactory;
use Sylius\Component\Core\Context\ShopperContextInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Translation\TranslatorInterface;

class CsobApi implements CsobApiInterface
{
	/** @var ShopperContextInterface */
	protected $shopperContext;

	/** @var TranslatorInterface */
	protected $translator;

	/** @var KernelInterface */
	protected $kernel;

	public function __construct(
		KernelInterface $kernel,
		TranslatorInterface $translator,
		ShopperContextInterface $shopperContext
	) {
		$this->kernel = $kernel;
		$this->translator = $translator;
		$this->shopperContext = $shopperContext;
	}

	private function createApi(bool $sandbox, string $keyName): ApiClient
	{
		$kernelDir = $this->kernel->getRootDir();

		$clientCert = $sandbox
			? $kernelDir . '/../config/csobKeys/clientKeys/sandbox/' . $keyName
			: $kernelDir . '/../config/csobKeys/clientKeys/prod/' . $keyName;

		$serverCert = $sandbox
			? __DIR__ . '/../Resources/keys/serverKeys/sandbox/mips_platebnibrana.csob.cz.pub'
			: __DIR__ . '/../Resources/keys/serverKeys/prod/mips_platebnibrana.csob.cz.pub';

		$apiEndpoint = $sandbox
			? 'https://iapi.iplatebnibrana.csob.cz/api/v1.7'
			: 'https://api.platebnibrana.csob.cz/api/v1.7';

		return new ApiClient(
			new CurlDriver(),
			new CryptoService($clientCert, $serverCert),
			$apiEndpoint
		);
	}

	public function create(array $order, string $merchantId, bool $sandbox, string $keyName): array
	{
		$apiClient = $this->createAPI($sandbox, $keyName);
		$requestFactory = new RequestFactory($merchantId);

		$cart = new Cart(Currency::get($order['currency']));
		$cart->addItem(
			$this->translator->trans('mango-sylius.csob_plugin.itemText'),
			1,
			$order['amount']
		);

		$locale = $localeCode = $this->shopperContext->getLocaleCode();
		if ($locale === 'cs') {
			$language = Language::get(Language::CZ);
		} else {
			$language = Language::get(strtoupper($locale));
		}
		$clientId = isset($order['clientId']) ? (string) ($order['clientId']) : null;

		$paymentResponse = $requestFactory->createInitPayment(
			$order['orderNumber'],
			PayOperation::get(PayOperation::PAYMENT),
			PayMethod::get(PayMethod::CARD),
			true,
			$order['returnUrl'],
			HttpMethod::get(HttpMethod::POST),
			$cart,
			$order['description'],
			null,
			$clientId,
			$language
		)->send($apiClient);

		$payId = $paymentResponse->getPayId();
		$processPaymentResponse = $requestFactory->createProcessPayment($payId)->send($apiClient);

		return [
			'orderId' => $order['orderNumber'],
			'gatewayLocationUrl' => $processPaymentResponse->getGatewayLocationUrl(),
			'payId' => $payId,
		];
	}

	public function retrieve(string $merchantId, bool $sandbox, string $keyName): string
	{
		$apiClient = $this->createAPI($sandbox, $keyName);
		$requestFactory = new RequestFactory($merchantId);
		$paymentResponse = $requestFactory->createReceivePaymentRequest()->send($apiClient, $_POST);
		if ($paymentResponse->getPaymentStatus() !== null
			&& $paymentResponse->getPaymentStatus()->equalsValue(PaymentStatus::S7_AWAITING_SETTLEMENT)) {
			return CsobApiInterface::PAID;
		}

		return CsobApiInterface::CANCELED;
	}
}
