<?php

namespace Drupal\commerce_multisafepay\Plugin\Commerce\PaymentGateway;

use Drupal\commerce_multisafepay\Helpers\GatewayStandardMethodsHelper;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the Off-site payment gateway.
 *
 * @CommercePaymentGateway(
 *   id = "msp_santander",
 *   label = "MultiSafepay (Santander)",
 *   display_label = "Santander",
 *   forms = {
 *     "offsite-payment" =
 *     "Drupal\commerce_multisafepay\PluginForm\StandardPayment\StandardPaymentForm",
 *   },
 * )
 */
class Santander extends GatewayStandardMethodsHelper {

  /**
   * Create unique settings form for Santander.
   *
   * @param array $form
   *   The form details.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state.
   *
   * @return array
   *   Added conditions
   */
  public function buildConfigurationForm(
    array $form,
    FormStateInterface $form_state
  ) {
    // Make the Condition.
    $orderTotalCondition = $this->mspConditionHelper->orderTotalCondition(
      '>=', '250', 'EUR'
    );
    $this->mspConditionHelper->orderCurrencyCondition('Euro');

    // Set the values.
    $form_state->setValues(
      array_merge($orderTotalCondition, $form_state->getValues())
    );

    // Build default form.
    $form = parent::buildConfigurationForm($form, $form_state);

    // Make a message.
    $form['details'] = $this->mspConditionHelper->orderConditionMessage();

    return $form;
  }

}
