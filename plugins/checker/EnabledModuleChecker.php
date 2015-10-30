<?php

/**
 * @file
 * Contains EnabledModuleChecker
 */

/**
 * Checker for modules which should be enabled.
 */
class EnabledModuleChecker extends BaseModuleChecker {

  protected $modules = array(
    'paranoia' => 'error',
  );

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
