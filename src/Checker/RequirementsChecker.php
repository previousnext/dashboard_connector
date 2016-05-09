<?php

namespace Drupal\dashboard_connector\Checker;

use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\system\SystemManager;

/**
 * Checks for requirements.
 */
class RequirementsChecker extends CheckerBase {

  /**
   * The system manager.
   *
   * @var \Drupal\system\SystemManager
   */
  protected $systemManager;

  /**
   * ModuleStateChecker constructor.
   *
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translations service.
   * @param \Drupal\system\SystemManager $system_manager
   *   The system manager.
   */
  public function __construct(TranslationInterface $string_translation, SystemManager $system_manager) {
    parent::__construct($string_translation);
    $this->systemManager = $system_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();
    // Check run-time requirements and status information.
    $requirements = $this->systemManager->listRequirements();
    foreach ($requirements as $requirement) {
      if (isset($requirement['severity']) && $requirement['severity'] === REQUIREMENT_ERROR) {
        $checks[] = $this->buildCheck('requirement', $requirement['title'], strip_tags($requirement['value'] . ': ' . $requirement['description']), 'error');
      }
    }
    return $checks;
  }

}
