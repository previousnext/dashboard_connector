<?php

/**
 * @file
 * Contains RequirementsChecker
 */

/**
 * Checks for requirements.
 */
class RequirementsChecker implements CheckerInterface {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();
    // Check run-time requirements and status information.
    $requirements = module_invoke_all('requirements', 'runtime');
    usort($requirements, '_system_sort_requirements');
    foreach ($requirements as $requirement) {
      if (isset($requirement['severity']) && $requirement['severity'] === REQUIREMENT_ERROR) {
        $checks[] = array(
          'name' => $requirement['title'],
          'description' => strip_tags($requirement['value'] . ': ' . $requirement['description']),
          'type' => 'requirement',
          'alert_level' => 'error',
        );
      }
    }
    return $checks;
  }

}
