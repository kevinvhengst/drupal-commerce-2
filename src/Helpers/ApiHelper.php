<?php

namespace Drupal\commerce_multisafepay_payments\Helpers;

use Drupal\commerce_multisafepay_payments\API\Client;

/**
 * Class ApiHelper.
 */
class ApiHelper {

  /**
   * Set the api settings.
   *
   * @param \Drupal\commerce_multisafepay_payments\API\Client $client
   *   MSP client.
   * @param string $mode
   *   Mode the payment gateway is using (test / live /
   *   n/a)
   */
  public function setApiSettings(Client $client, $mode) {

    // Get the needed Data to set the setting.
    $testApiKey = \Drupal::config('commerce_multisafepay_payments.settings')
      ->getRawData()['test_api_key'];
    $liveApiKey = \Drupal::config('commerce_multisafepay_payments.settings')
      ->getRawData()['live_api_key'];

    // Check if the gateway is N/A.
    if ($mode === "n/a") {
      $mode = \Drupal::config('commerce_multisafepay_payments.settings')
        ->getRawData()['account_type'];
    }

    // Check if the account type is set to Test Or live.
    if ($mode === "live") {
      // Set Live URL.
      $client->setApiUrl('https://api.multisafepay.com/v1/json/');
      // Set the API key.
      $client->setApiKey($liveApiKey);
    }
    else {
      if ($mode === 'test') {
        // Set Test URL.
        $client->setApiUrl('https://testapi.multisafepay.com/v1/json/');
        // Set the API key.
        $client->setApiKey($testApiKey);
      }
    }
  }

}
