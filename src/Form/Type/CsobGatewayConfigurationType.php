<?php

declare(strict_types=1);

namespace MangoSylius\CsobPaymentGatewayPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class CsobGatewayConfigurationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('merchantId', TextType::class, [
				'label' => 'mango-sylius.csob_plugin.form.merchantId',
				'constraints' => [
					new NotBlank([
						'groups' => ['sylius'],
					]),
				],
			])
			->add('keyPrivate', TextareaType::class, [
				'label' => 'mango-sylius.csob_plugin.form.privateKey',
				'constraints' => [
					new NotBlank([
						'groups' => ['sylius'],
					]),
				],
			])
			->add('sandbox', CheckboxType::class, [
				'label' => 'mango-sylius.csob_plugin.form.sandbox',
			]);
	}
}
