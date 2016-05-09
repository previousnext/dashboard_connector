<?php

namespace Drupal\dashboard_connector\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * The CheckerPluginManager class.
 */
class CheckerPluginManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $this->alterInfo('dashboard_connector_checker_info');
    $this->setCacheBackend($cache_backend, 'dashboard_connector_checker');

    parent::__construct('Plugin/checker', $namespaces, $module_handler, 'Drupal\dashboard_connector\Plugin\CheckerInterface', 'Drupal\dashboard_connector\Annotation\Checker');
  }

}
