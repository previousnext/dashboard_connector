<?php

/**
 * @file
 * Contains ModuleStatusChecker
 */

/**
 * Provides a module status checker.
 */
class ModuleStatusChecker implements CheckerInterface {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();
    if ($available = update_get_available(TRUE)) {
      module_load_include('inc', 'update', 'update.compare');

      $modules = update_calculate_project_data($available);
      $checks = array();
      foreach ($modules as $module) {
        $check = array(
          'name' => $module['name'],
          'description' => $this->getDescription($module),
          'type' => 'module',
          'alert_level' => $this->getAlertLevel($module['status']),
        );
        // Special case core updates.
        if ($module['name'] === 'drupal') {
          $check['type'] = 'core';
        }
        $checks[] = $check;
      }
    }
    return $checks;
  }

  /**
   * Determine the module status alert level.
   *
   * @param string $status
   *   The module status.
   *
   * @return string
   *   The alert level.
   */
  protected function getAlertLevel($status) {
    switch ($status) {
      case UPDATE_NOT_CURRENT:
        $alert_level = 'warning';
        break;

      case UPDATE_NOT_SECURE:
      case UPDATE_NOT_SUPPORTED:
      case UPDATE_REVOKED:
        $alert_level = 'error';
        break;

      default:
        $alert_level = 'notice';
        break;
    }
    return $alert_level;
  }

  /**
   * Provide a human readable description.
   *
   * @param array $module
   *   The module status information.
   *
   * @return string
   *   The check message.
   */
  protected function getDescription($module) {
    $status = $module['status'];

    switch ($status) {
      case UPDATE_CURRENT:
        $message = t('Up to date') . ' (' . $module['existing_version'] . ')';
        break;

      case UPDATE_FETCH_PENDING:
        $message = t('Fetch Pending');
        break;

      case UPDATE_NOT_FETCHED:
        $message = t('Not fetched');
        break;

      case UPDATE_NOT_SECURE:
        $message = t('Not secure') . ' (' . $module['existing_version'] . ' => ' . $module['latest_version'] . ')';
        break;

      case UPDATE_REVOKED:
      case UPDATE_NOT_SUPPORTED:
        $message = t('Unsupported') . ' (' . $module['existing_version'] . ')';
        break;

      case UPDATE_NOT_CHECKED:
        $message = t('Not checked');
        break;

      case UPDATE_NOT_CURRENT:
        $message = t('Not current') . ' (' . $module['existing_version'] . ' => ' . $module['latest_version'] . ')';
        break;

      default:
        $message = t('Unknown');
        break;
    }
    return $message;
  }

}
