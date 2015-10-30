<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Dashboard\Checker\DisabledModuleChecker
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;
use PNX\Dashboard\Check;

/**
 * Checks for modules which should be disabled.
 */
class DisabledModuleChecker extends BaseModuleChecker {

  protected $modules = array(
    'views_ui' => 'warning',
  );

  /**
   * {@inheritdoc}
   */
  protected function getType() {
    return 'module disabled';
  }

  /**
   * {@inheritdoc}
   */
  protected function getExpectedModuleState() {
    return FALSE;
  }

}
