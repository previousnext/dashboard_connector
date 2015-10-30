<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Dashboard\Checker\BaseModuleChecker
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;

/**
 * Provides a base class for module checkers.
 */
abstract class BaseModuleChecker implements CheckerInterface {

  /**
   * @var array
   */
  protected $modules = array();

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
    $checks = array();
    foreach ($this->getModulesToCheck() as $module => $alert_level) {
      if (module_exists($module) !== $this->getExpectedModuleState()) {
        $check = array(
          'type' => $this->getType(),
          'name' => $module,
          'description' => $this->getMessage($module),
          'alert_level' => $alert_level,
        );
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
    return t('!module module is !stateenabled', array(
      '!module' => $module,
      '!state' => $this->getExpectedModuleState() ? 'not ' : '',
    ));
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
