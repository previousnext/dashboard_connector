<?php

/**
 * @file
 * Contains \Drupal\dashboard_connector\Dashboard\Checker\ModuleStatusChecker
 */

namespace Drupal\dashboard_connector\Dashboard\Checker;

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
          'description' => $this->getDescription($module['status']),
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
   * @param string $status
   *   The module status.
   *
   * @return string
   *   The check message.
   */
  protected function getDescription($status) {
    switch ($status) {
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
