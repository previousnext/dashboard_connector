<?php

/**
 * @file
 * Contains DashboardConnectorServiceProvider
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

    $services['dashboard_connector.http_client'] = [
      'class' => '\GuzzleHttp\Client',
      'arguments' => [
        [
          'auth' => [
            '%dashboard_connector.username%',
            '%dashboard_connector.password%'
          ]
        ]
      ],
    ];

    $services['logger.channel.dashboard_connector'] = [
      'class' => 'Drupal\service_container\Logger\LoggerChannel',
      'factory_service' => 'logger.factory',
      'factory_method' => 'get',
      'arguments' => ['dashboard_connector'],
    ];

    // Dashboard Client.
    $services['dashboard_connector.client'] = [
      'class' => '\PNX\Dashboard\DashboardClient',
      'arguments' => [
        '@dashboard_connector.http_client',
        '%dashboard_connector.base_uri%',
        '%dashboard_connector.client_id%',
        '%dashboard_connector.site_id%',
        '@logger.channel.dashboard_connector'
      ]
    ];

    $parameters = [
      'dashboard_connector.base_uri' => variable_get('dashboard_connector_base_uri', 'https://status.previousnext.com.au'),
      'dashboard_connector.client_id' => variable_get('dashboard_connector_client_id'),
      'dashboard_connector.site_id' => variable_get('dashboard_connector_site_id'),
      'dashboard_connector.username' => variable_get('dashboard_connector_username'),
      'dashboard_connector.password' => variable_get('dashboard_connector_password'),
    ];

    return [
      'parameters' => $parameters,
      'services' => $services,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function alterContainerDefinition(&$container_definition) {
  }

}
