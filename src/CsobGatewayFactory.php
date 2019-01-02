<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin;

use MangoSylius\CsobPaymentGatewayPlugin\Action\CaptureAction;
use MangoSylius\CsobPaymentGatewayPlugin\Action\ConvertPaymentAction;
use MangoSylius\CsobPaymentGatewayPlugin\Action\StatusAction;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

class CsobGatewayFactory extends GatewayFactory
{
	/**
	 * {@inheritdoc}
	 */
	protected function populateConfig(ArrayObject $config)
	{
		$config->defaults([
			'payum.factory_name' => 'csob',
			'payum.factory_title' => 'CSOB',

			'payum.action.capture' => new CaptureAction(),
			'payum.action.convert_payment' => new ConvertPaymentAction(),
			'payum.action.status' => new StatusAction(),
		]);

		if (!$config['payum.api']) {
			$config['payum.default_options'] = [
				'sandbox' => true,
				'keyName' => '',
				'merchantId' => '',
			];
			$config->defaults($config['payum.default_options']);
			$config['payum.required_options'] = ['merchantId', 'keyName'];

			$config['payum.api'] = function (ArrayObject $config) {
				$config->validateNotEmpty($config['payum.required_options']);

				$csobConfig = [
					'sandbox' => $config['sandbox'],
					'merchantId' => $config['merchantId'],
					'keyName' => $config['keyName'],
				];

				return $csobConfig;
			};
		}
	}
}
