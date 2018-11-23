<?php

namespace Drupal\commerce_multisafepay\API\Object;

use Drupal\commerce_multisafepay\API\Client;
use Drupal\commerce_multisafepay\Exceptions\ExceptionHelper;

/**
 * Class Core.
 */
class Core {

  /**
   * Result.
   *
   * @var string
   */
  public $result;

  /**
   * MSP Api.
   *
   * @var \Drupal\commerce_multisafepay\API\Client
   */
  protected $mspapi;

  /**
   * Core constructor.
   *
   * @param \Drupal\commerce_multisafepay\API\Client $mspapi
   *   API client.
   */
  public function __construct(Client $mspapi) {
    $this->mspapi = $mspapi;
  }

  /**
   * Create post request.
   *
   * @param string $body
   *   JSON request posted to MultiSafepay.
   * @param string $endpoint
   *   The endpoint of the URL.
   *
   * @return mixed
   *   Process the given request
   */
  public function post($body, $endpoint = 'orders') {
    $this->result = $this->processRequest('POST', $endpoint, $body);
    return $this->result;
  }

  /**
   * Prepare request.
   *
   * @param string $http_method
   *   GET / POST / PATCH.
   * @param string $api_method
   *   Endpoint.
   * @param null|string $http_body
   *   The request.
   *
   * @return mixed
   *   The processed content
   */
  protected function processRequest(
    $http_method,
    $api_method,
    $http_body
  ) {
    $body = $this->mspapi->processApiRequest(
      $http_method, $api_method, $http_body
    );
    $exceptionHelper = new ExceptionHelper();
    if (!($object = @json_decode($body))) {
      $exceptionHelper->paymentGatewayException($body);
    }

    if (!empty($object->error_code)) {
      $exceptionHelper->paymentGatewayException(
        $object->error_info, $object->error_code
      );
    }
    return $object;
  }

  /**
   * Create PATCH request.
   *
   * @param string $body
   *   The json request.
   * @param string $endpoint
   *   Endpoint.
   *
   * @return mixed
   *   process patch request
   */
  public function patch($body, $endpoint = '') {
    $this->result = $this->processRequest('PATCH', $endpoint, $body);
    return $this->result;
  }

  /**
   * Get result.
   *
   * @return mixed
   *   Result
   */
  public function getResult() {
    return $this->result;
  }

  /**
   * Create GET request.
   *
   * @param string $endpoint
   *   Endpoint.
   * @param string $id
   *   Order id.
   * @param string $body
   *   The request.
   * @param bool $query_string
   *   How the request should be handled.
   *
   * @return mixed
   *   Process get request
   */
  public function get($endpoint, $id, $body, $query_string = FALSE) {
    if (!$query_string) {
      $url = "{$endpoint}/{$id}";
    }
    else {
      $url = "{$endpoint}?{$query_string}";
    }

    $this->result = $this->processRequest('GET', $url, $body);
    return $this->result;
  }

}
