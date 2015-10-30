<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Dashboard\Checker\BaseModuleChecker
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;

use PNX\Dashboard\Check;

/**
 * Provides a base class for module checkers.
 */
abstract class BaseModuleChecker implements CheckerInterface {

  /**
   * @var array
   */
  protected $modules = [];

  /**
   * Gets the check type.
   *
   * @return string
   *   The type.
   */
  abstract protected function getType();

  /**
   * Gets the module enabled state.
   *
   * @return bool
   *   TRUE if the module should be enabled, FALSE otherwise.
   */
  abstract protected function getExpectedModuleState();

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = [];
    foreach ($this->getModulesToCheck() as $module => $alert_level) {
      if (module_exists($module) !== $this->getExpectedModuleState()) {
        $check = (new Check())
          ->setType($this->getType())
          ->setName($module)
          ->setDescription($this->getMessage($module))
          ->setAlertLevel($alert_level);
        $checks[] = $check;
      }
    }
    return $checks;
  }

  /**
   * Message to log.
   *
   * @param string $module
   *   The module name.
   *
   * @return string
   *   The message.
   */
  protected function getMessage($module) {
    return t('!module module is !stateenabled', [
      '!module' => $module,
      '!state' => $this->getExpectedModuleState() ? 'not ' : '',
    ]);
  }

  /**
   * Modules to check.
   *
   * @return array
   *   The array of modules to check and their alert level.
   */
  protected function getModulesToCheck() {
    return $this->modules;
  }

}
