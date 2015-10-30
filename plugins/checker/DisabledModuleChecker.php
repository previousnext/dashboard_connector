<?php

/**
 * @file
 * Contains DisabledModuleChecker
 */

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
