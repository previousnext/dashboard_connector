<?php

/**
 * @file
 * Contains ${NAMESPACE}\CheckerInterface
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;

/**
 * Provides an interface for status checkers.
 */
interface CheckerInterface {

  /**
   * Gets the checks.
   *
   * @return \PNX\Dashboard\Check[]
   *   An array of checks.
   */
  public function getChecks();
}
