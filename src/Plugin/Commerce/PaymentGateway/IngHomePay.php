<?php

namespace Drupal\commerce_multisafepay\Plugin\Commerce\PaymentGateway;

use Drupal\commerce_multisafepay\Helpers\GatewayStandardMethodsHelper;
use Drupal\commerce_payment\Plugin\Commerce\PaymentGateway\SupportsRefundsInterface;

/**
 * Provides the Off-Site payment gateway.
 *
 * @CommercePaymentGateway(
 *   id = "msp_inghome",
 *   label = "MultiSafepay (ING Home'Pay)",
 *   display_label = "ING Home'Pay",
 *   modes = {
 *     "n/a" = @Translation("N/A"),
 *   },
 *   forms = {
 *     "offsite-payment" =
 *     "Drupal\commerce_multisafepay\PluginForm\StandardPayment\StandardPaymentForm",
 *   },
 * )
 */
class IngHomePay extends GatewayStandardMethodsHelper implements
    SupportsRefundsInterface {

}
