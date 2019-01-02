<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin\Action;

use MangoSylius\CsobPaymentGatewayPlugin\Api\CsobApiInterface;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\GatewayAwareTrait;
use Payum\Core\Model\PaymentInterface;
use Payum\Core\Request\Convert;

class ConvertPaymentAction implements ActionInterface
{
	use GatewayAwareTrait;

	/**
	 * @param mixed $request
	 */
	public function execute($request): void
	{
		RequestNotSupportedException::assertSupports($this, $request);

		/** @var PaymentInterface $payment */
		$payment = $request->getSource();

		$details = ArrayObject::ensureArrayObject($payment->getDetails());

		$details['totalAmount'] = $payment->getTotalAmount();
		$details['currencyCode'] = $payment->getCurrencyCode();
		$details['extOrderId'] = $payment->getNumber();
		$details['description'] = $payment->getDescription();
		$details['clientId'] = $payment->getClientId();
		$details['status'] = CsobApiInterface::CREATED;

		$request->setResult((array) $details);
	}

	/**
	 * @param mixed $request
	 */
	public function supports($request): bool
	{
		return
			$request instanceof Convert &&
			$request->getSource() instanceof PaymentInterface &&
			$request->getTo() === 'array';
	}
}
