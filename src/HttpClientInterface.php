<?php

/**
 * @file
 * Contains HttpClientInterface.
 */

/**
 * Defines an interface for sending HTTP requests.
 *
 * Tries to maintain parity with Guzzle's HTTP client for future-adoption.
 */
interface HttpClientInterface {

  /**
   * @param string $url
   *   URL to post to.
   * @param array $options
   *   Array of options. Pass body using array('body' => $data).
   */
  public function post($url, array $options);

}
