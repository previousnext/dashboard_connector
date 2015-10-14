<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\ServiceContainer\ServiceProvider\DashboardConnectorServiceProvider
 */

namespace Drupal\dashboard_connector\ServiceContainer\ServiceProvider;

use Drupal\service_container\DependencyInjection\ServiceProviderInterface;

/**
 * Dashboard connector container service provider.
 */
class DashboardConnectorServiceProvider implements ServiceProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getContainerDefinition() {
    $services = [];
    // Dashboard Client.
    $services['dashboard_connector.client'] = [
      'class' => '\PNX\Dashboard\DashboardClient',
      'arguments' => [
        '@dashboard_connector.http_client',
        '%dashboard_connector.base_uri%',
        '%dashboard_connector.client_id%',
        '%dashboard_connector.site_id%',
      ]
    ];

    $services['dashboard_connector.client'] = [
      'class' => '\GuzzleHttp\Client',
    ];

    $parameters = [
      'dashboard_connector.base_uri' => variable_get('dashboard_base_uri', 'http://dashboard-api.previousnext.com.au'),
      'dashboard_connector.client_id' => variable_get('dashboard_client_id', 'test_client'),
      'dashboard_connector.site_id' => variable_get('dashboard_site_id', 'test_site'),
    ];

    return [
      'parameters' => $parameters,
      'service' => $services,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function alterContainerDefinition(&$container_definition) {
  }

}
