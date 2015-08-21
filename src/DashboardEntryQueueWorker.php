<?php

/**
 * @file
 * Contains DashboardEntryQueueWorker.
 */

/**
 * Defines a class for processing the queue.
 */
class DashboardEntryQueueWorker {

  /**
   * @var HttpClientInterface.
   */
  protected $client;

  /**
   * @var DashboardEntryInterface.
   */
  protected $item;

  /**
   * Sends the item.
   *
   * @param string $url
   *   URL to send to.
   */
  public function send($url) {
    return $this->client->post($url, array('body' => $this->item->asJson()));
  }

  /**
   * Factory method to create and send the item.
   *
   * @param \DashboardEntryInterface $item
   *   Item to send.
   * @param string $url
   *   URL to send to.
   *
   * @return bool
   *   TRUE on success.
   *
   * @throws \Exception
   *   When the endpoint returns an unexpected response.
   */
  public static function sendItem(DashboardEntryInterface $item, $url) {
    $client = new HttpClient();
    $worker = new static();
    $worker->client = $client;
    $worker->item = $item;
    return $worker->send($url);
  }

}
