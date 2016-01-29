<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\SnapshotBuilder
 */

namespace Drupal\dashboard_connector;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\dashboard_connector\Checker\CheckerInterface;

/**
 * Builds a snapshot of checks.
 */
class SnapshotBuilder implements SnapshotBuilderInterface {

  /**
   * @var \Drupal\dashboard_connector\Checker\CheckerInterface[]
   */
  protected $checkers = [];

  protected $config;

  /**
   * SnapshotBuilder constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('dashboard_connector.settings');
  }

  /**
   * Adds a checker.
   *
   * This is typically called by a Service Collector in container
   * initiliazation.
   *
   * @param \Drupal\dashboard_connector\Checker\CheckerInterface $checker
   *   The checker to add.
   */
  public function addChecker(CheckerInterface $checker) {
    $this->checkers[] = $checker;
  }

  /**
   * {@inheritdoc}
   */
  public function buildSnapshot() {
    $checks = [];
    foreach ($this->checkers as $checker) {
      $checks = array_merge($checks, $checker->getChecks());
    }
    $snapshot = [
      'timestamp' => date(\DateTime::ISO8601),
      'client_id' => variable_get('dashboard_connector_client_id'),
      'site_id' => variable_get('dashboard_connector_site_id'),
      'checks' => $checks,
    ];
    return $snapshot;
  }

}
