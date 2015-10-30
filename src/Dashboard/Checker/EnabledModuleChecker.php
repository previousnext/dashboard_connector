<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Dashboard\Checker\EnabledModuleChecker
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;

use PNX\Dashboard\Check;

/**
 * Checker for modules which should be enabled.
 */
class EnabledModuleChecker extends BaseModuleChecker {

  protected $modules = [
    'paranoia' => Check::ALERT_ERROR
  ];

  /**
   * {@inheritdoc}
   */
  protected function getType() {
    return 'module enabled';
  }

  /**
   * {@inheritdoc}
   */
  protected function getExpectedModuleState() {
    return TRUE;
  }

}
