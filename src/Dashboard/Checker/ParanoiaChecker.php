<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Dashboard\Checker\ParanoiaChecker
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;
use PNX\Dashboard\Check;

/**
 * Provides a Paranoia module checker.
 */
class ParanoiaChecker implements CheckerInterface {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = [];
    if (!module_exists('paranoia')) {
      $check = (new Check())
        ->setType('paranoia')
        ->setName('Paranoia')
        ->setDescription('Paranoia module is not enabled.')
        ->setAlertLevel(Check::ALERT_ERROR);
      $checks[] = $check;
    }
    return $checks;
  }
}
