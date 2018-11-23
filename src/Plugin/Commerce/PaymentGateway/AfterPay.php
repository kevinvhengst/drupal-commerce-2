<?php

namespace Drupal\commerce_multisafepay\Plugin\Commerce\PaymentGateway;

use Drupal\commerce_multisafepay\Helpers\GatewayStandardMethodsHelper;

/**
 * Provides the Off-site payment gateway.
 *
 * @CommercePaymentGateway(
 *   id = "msp_afterpay",
 *   label = "MultiSafepay (AfterPay)",
 *   display_label = "AfterPay",
 *   forms = {
 *     "offsite-payment" =
 *     "Drupal\commerce_multisafepay\PluginForm\StandardPayment\StandardPaymentForm",
 *   },
 * )
 */
class AfterPay extends GatewayStandardMethodsHelper {

}
