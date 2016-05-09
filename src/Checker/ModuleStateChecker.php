<?php

namespace Drupal\dashboard_connector\Checker;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Checks for modules which should be disabled.
 * )
 */
class ModuleStateChecker implements CheckerInterface {

  /**
   * Represents a enabled module state.
   *
   * @var bool
   */
  const MODULE_ENABLED = TRUE;

  /**
   * Represents a disabled module state.
   *
   * @var bool
   */
  const MODULE_DISABLED = FALSE;

  /**
   * The enabled modules and their alert levels.
   *
   * @var array
   */
  protected $enabledModules = [
    'paranoia' => 'error',
  ];

  /**
   * The disabled modules and their alert levels.
   *
   * @var array
   */
  protected $disabledModules = [
    'php' => 'error',
    'views_ui' => 'warning',
  ];
  /**
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * ModuleStateChecker constructor.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(ModuleHandlerInterface $module_handler) {
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = [];
    foreach ($this->disabledModules as $module => $alert_level) {
      if ($this->moduleHandler->moduleExists($module) !== static::MODULE_DISABLED) {
        $checks[] = $this->buildCheck('module disabled', sprintf('%s module is enabled', $module), $module, $alert_level);
      }
    }

    foreach ($this->enabledModules as $module => $alert_level) {
      if ($this->moduleHandler->moduleExists($module) !== static::MODULE_ENABLED) {
        $checks[] = $this->buildCheck('module enabled', sprintf('%s module is disabled', $module), $module, $alert_level);
      }
    }

    return $checks;
  }

  /**
   * @param $type
   * @param $description
   * @param $module
   * @param $alert_level
   * @return array
   */
  protected function buildCheck($type, $description, $module, $alert_level) {
    return [
      'type' => $type,
      'name' => $module,
      'description' => $description,
      'alert_level' => $alert_level,
    ];
  }

}
