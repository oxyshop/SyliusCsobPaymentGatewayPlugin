<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin\Api;

interface CsobApiInterface
{
	public const CREATED = 'CREATED';
	public const PAID = 'PAID';
	public const CANCELED = 'CANCELED';

	public function create(array $order, string $merchantId, bool $sandbox, string $keyName): array;

	public function retrieve(string $merchantId, bool $sandbox, string $keyName): string;
}
