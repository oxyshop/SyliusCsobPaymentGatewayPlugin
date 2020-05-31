<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin\Action;

use MangoSylius\CsobPaymentGatewayPlugin\Api\CsobApiInterface;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\GetStatusInterface;

class StatusAction implements ActionInterface
{
	/**
	 * {@inheritdoc}
	 *
	 * @param GetStatusInterface $request
	 */
	public function execute($request): void
	{
		RequestNotSupportedException::assertSupports($this, $request);

		$model = ArrayObject::ensureArrayObject($request->getModel());
		$status = $model['csobStatus'] ?? null;

		if ($status === null || $status === CsobApiInterface::CREATED) {
			$request->markNew();

			return;
		}

		if ($status === CsobApiInterface::CANCELED) {
			$request->markCanceled();

			return;
		}

		if ($status === CsobApiInterface::PAID) {
			$request->markCaptured();

			return;
		}

		$request->markUnknown();
	}

	/**
	 * {@inheritdoc}
	 */
	public function supports($request)
	{
		return
			$request instanceof GetStatusInterface &&
			$request->getModel() instanceof \ArrayAccess
		;
	}
}
