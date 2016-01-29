<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\DashboardConnector
 */

namespace Drupal\dashboard_connector;
use Drupal\Core\Config\Config;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * The dashboard connector implementation.
 */
class DashboardConnector implements DashboardConnectorInterface {

  /**
   * @var \GuzzleHttp\ClientInterface
   */
  protected $client;

  /**
   * The dashboard connector config.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * DashboardConnector constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('dashboard_connector.settings');
  }


  public function sendSnapshot($snapshot) {

    $this->client->request('POST');
  }


}
