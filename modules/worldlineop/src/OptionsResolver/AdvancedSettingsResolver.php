<?php
/**
 * 2021 Worldline Online Payments
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0).
 * It is also available through the world-wide-web at this URL: https://opensource.org/licenses/AFL-3.0
 *
 * @author    PrestaShop partner
 * @copyright 2021 Worldline Online Payments
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *
 */

namespace WorldlineOP\PrestaShop\OptionsResolver;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdvancedSettingsResolver
 * @package WorldlineOP\PrestaShop\OptionsResolver
 */
class AdvancedSettingsResolver extends AbstractSettingsResolver
{
    /**
     * @param OptionsResolver $resolver
     * @return mixed|void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined([
                'force3DsV2',
                'switchEndpoint',
                'testEndpoint',
                'prodEndpoint',
                'endpointLogo',
                'logsEnabled',
                'paymentFlowSettingsDisplayed',
                'advancedSettingsEnabled',
                'paymentSettings',
                'transactionType',
                'captureDelay',
                'retentionHours',
                'successOrderStateId',
                'pendingOrderStateId',
                'safetyDelay',
                'errorOrderStateId',
                'groupCardPaymentOptions',
                'threeDSExempted',
                'enforce3DS',
                'displayWhatsNew',
            ])
            ->setNormalizer(
                'displayWhatsNew',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'force3DsV2',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'switchEndpoint',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'paymentFlowSettingsDisplayed',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'logsEnabled',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'advancedSettingsEnabled',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'captureDelay',
                function (Options $options, $value) {
                    return intval($value);
                }
            )
            ->setNormalizer(
                'retentionHours',
                function (Options $options, $value) {
                    return intval($value);
                }
            )
            ->setNormalizer(
                'successOrderStateId',
                function (Options $options, $value) {
                    return intval($value);
                }
            )
            ->setNormalizer(
                'pendingOrderStateId',
                function (Options $options, $value) {
                    return intval($value);
                }
            )
            ->setNormalizer(
                'safetyDelay',
                function (Options $options, $value) {
                    return intval($value);
                }
            )
            ->setNormalizer(
                'errorOrderStateId',
                function (Options $options, $value) {
                    return intval($value);
                }
            )
            ->setNormalizer(
                'groupCardPaymentOptions',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'threeDSExempted',
                function (Options $options, $value) {
                    return boolval($value);
                }
            )
            ->setNormalizer(
                'enforce3DS',
                function (Options $options, $value) {
                    return boolval($value);
                }
            );
    }

    /**
     * @param array $array
     * @return array|mixed
     */
    public function resolve($array)
    {
        $resolvedArray = $this->resolver->resolve($array);
        if (isset($resolvedArray['paymentSettings'])) {
            $resolvedArray['paymentSettings'] = $this->resolver->resolve($array['paymentSettings']);
        }

        return $resolvedArray;
    }
}
