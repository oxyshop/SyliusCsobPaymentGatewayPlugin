<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin\Api;

interface CsobApiInterface
{
	public const CREATED = 'CREATED';

	public const PAID = 'PAID';

	public const CANCELED = 'CANCELED';

	/**
	 * @param array<mixed> $order
	 *
	 * @return array<mixed>
	 */
	public function create(array $order, string $merchantId, bool $sandbox, string $keyPrivate): array;

	public function retrieve(string $merchantId, bool $sandbox, string $keyPrivate, string $externalPaymentId): string;
}
