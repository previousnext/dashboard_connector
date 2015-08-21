<?php
/**
 * @file
 * Plugin definition for update status of modules.
 */

$plugin = array(
  'class info' => array(
    'class' => 'UpdateStatus',
    'file' => 'UpdateStatus.php',
  ),
  'class' => 'UpdateStatus',
);

/**
 * Defines a class for tracking udpate status.
 */
class UpdateStatus implements DashboardCheckInterface {

 /**
  * {@inheritdoc}
  */
  public function check() {
    $entries = array();
    if ($available = update_get_available()) {
      module_load_include('inc', 'update', 'update.compare');
      $modules = update_calculate_project_data($available);
      foreach ($modules as $module) {
        $entries[] = \DashboardEntry::create(array(
          'group' => 'Module update',
          'displayName' => $module['name'],
          'alertLevel' => $this->getAlertLevel($module['status']),
          'description' => sprintf('%s. Current: %s. Latest %s.', $this->getDescription($module['status']), $module['existing_version'], isset($module['latest_version']) ? $module['latest_version'] : $module['existing_version']),
          'tags' => array('security'),
        ));
      }
    }
    return $entries;
  }

  /**
   * Helper function to determine if a module status is a pass or a fail.
   */
  protected function getAlertLevel($status) {
    $info = array(
      UPDATE_CURRENT, UPDATE_NOT_CURRENT, UPDATE_UNKNOWN
    );
    if (in_array($status, $info, TRUE)) {
      return DashboardEntryInterface::INFO;
    }
    return DashboardEntryInterface::ERROR;
  }

  /**
   * Helper function to return a human readable message.
   */
  protected function getDescription($module) {
    switch ($module['status']) {
      case UPDATE_CURRENT:
        $message = t('Up to date');
        break;
      case UPDATE_UNKNOWN:
        $message = t('No available update data was found for project');
        break;
      case UPDATE_FETCH_PENDING:
        $message = t('We need to (re)fetch available update data for this project');
        break;
      case UPDATE_NOT_FETCHED:
        $message = t('There was a failure fetching available update data for this project');
        break;
      case UPDATE_NOT_SECURE:
        $message = t('Project is missing security update(s)');
        break;
      case UPDATE_REVOKED:
        $message = t('Current release has been unpublished and is no longer available');
        break;
      case UPDATE_NOT_CHECKED:
        $message = t('Project status cannot be checked');
        break;
      case UPDATE_NOT_CURRENT:
        $message = t('Project has a new release available, but it is not a security release');
        break;
      case UPDATE_NOT_SUPPORTED:
        $message = t('Current release is no longer supported by the project maintainer.');
        break;
      default:
        $message = t('Cannot determine module status');
        break;
    }
    return $message;
  }

}
