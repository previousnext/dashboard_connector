<?php

/**
 * @file
 * Contains HttpClient.
 */

/**
 * Defines a class for wrapping drupal_http_request.
 */
class HttpClient implements HttpClientInterface {

  /**
   * {@inheritdoc}
   */
  public function post($url, array $options) {
    $data = $options['body'];
    $response = drupal_http_request($url, array(
      'method' => 'POST',
      'data' => is_array($data) ? drupal_http_build_query($data) : $data,
      'headers' => array(
        'Content-Type' => 'application/json',
      ),
    ));
    if (substr($response->code, 0, 1) === '2') {
      return TRUE;
    }
    throw new \Exception('Could not post data.');
  }

}
