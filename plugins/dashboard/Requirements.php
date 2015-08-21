<?php
/**
 * @file
 * Plugin definition for requirements checks.
 */

$plugin = array(
  'class info' => array(
    'class' => 'Requirements',
    'file' => 'Requirements.php',
  ),
  'class' => 'Requirements',
);

/**
 * Defines a class for tracking system requirements status errors.
 */
class Requirements implements DashboardCheckInterface {

 /**
  * {@inheritdoc}
  */
  public function check() {
    $entries = array();
    // Check run-time requirements and status information.
    $requirements = module_invoke_all('requirements', 'runtime');
    usort($requirements, '_system_sort_requirements');
    foreach ($requirements as $requirement) {
      if (isset($requirement['severity']) && $requirement['severity'] === REQUIREMENT_ERROR) {
        $entries[] = \DashboardEntry::create(array(
          'group' => 'Requirements',
          'displayName' => $requirement['title'],
          'alertLevel' => DashboardEntryInterface::ERROR,
          'description' => $requirement['description'],
          'tags' => array('requirements'),
        ));
      }
    }
    return $entries;
  }

}
