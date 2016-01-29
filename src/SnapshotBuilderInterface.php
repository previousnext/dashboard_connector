<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Checker\SnapshotBuilderInterface
 */
namespace Drupal\dashboard_connector;

/**
 * Collects Checkers.
 */
interface SnapshotBuilderInterface {

  /**
   * Collects and returns a snapshot of checks.
   *
   * @return array
   *   The array of all checks.
   */
  public function buildSnapshot();

}
