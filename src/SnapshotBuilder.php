<?php

namespace Drupal\dashboard_connector;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Builds a snapshot of checks.
 */
class SnapshotBuilder implements SnapshotBuilderInterface {

  protected $config;
  protected $pluginManager;

  /**
   * SnapshotBuilder constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(PluginManagerInterface $plugin_manager, ConfigFactoryInterface $config_factory) {
    $this->pluginManager = $plugin_manager;
    $this->config = $config_factory->get('dashboard_connector.settings');
  }

  /**
   * {@inheritdoc}
   */
  public function buildSnapshot() {
    $checks = [];
    foreach ($this->pluginManager->getDefinitions() as $plugin_id => $definition) {
      $checker = $this->pluginManager->createInstance($plugin_id);
      $checks = array_merge($checks, $checker->getChecks());
    }

    $snapshot = [
      'timestamp' => date(\DateTime::ISO8601),
      'client_id' => $this->config->get('client_id'),
      'site_id' => $this->config->get('site_id'),
      'checks' => $checks,
    ];
    return $snapshot;
  }

}
