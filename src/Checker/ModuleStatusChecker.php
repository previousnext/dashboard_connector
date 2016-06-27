<?php

namespace Drupal\dashboard_connector\Checker;

/**
 * Provides a module status checker.
 */
class ModuleStatusChecker extends CheckerBase {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = [];
    if ($available = update_get_available(TRUE)) {
      module_load_include('inc', 'update', 'update.compare');

      $modules = update_calculate_project_data($available);
      $checks = [];
      foreach ($modules as $module) {
        $check = $this->buildCheck('module', $module['name'], $this->getDescription($module), $this->getAlertLevel($module['status']));
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
        $message = $this->t('Up to date (existing_version)', [
          'existing_version' => $module['existing_version'],
        ]);
        break;

      case UPDATE_FETCH_PENDING:
        $message = $this->t('Fetch Pending');
        break;

      case UPDATE_NOT_FETCHED:
        $message = $this->t('Not fetched');
        break;

      case UPDATE_NOT_SECURE:
        $message = $this->t('Not secure (existing_version => latest_version)', [
          'existing_version' => $module['existing_version'],
          'latest_version' => $module['latest_version'],
        ]);
        break;

      case UPDATE_REVOKED:
      case UPDATE_NOT_SUPPORTED:
        $message = $this->t('Unsupported (existing_version)', ['existing_version' => $module['existing_version']]);
        break;

      case UPDATE_NOT_CHECKED:
        $message = $this->t('Not checked');
        break;

      case UPDATE_NOT_CURRENT:
        $message = $this->t('Not current (existing_version => latest_version)', [
          'existing_version' => $module['existing_version'],
          'latest_version' => $module['latest_version'],
        ]);
        break;

      default:
        $message = $this->t('Unknown');
        break;
    }
    return $message;
  }

}
