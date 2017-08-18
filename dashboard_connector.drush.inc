<?php

/**
 * @file
 * Dashboard Connector drush commands.
 */

use Drupal\dashboard_connector\Dashboard;

/**
 * Implementation of hook_drush_command().
 */
function dashboard_connector_drush_command() {
  $items = [];
  $items['dashboard-send'] = [
    'description' => 'Send a snapshot to the Dashboard API.',
    'aliases' => ['d-send'],
  ];
  return $items;
}

/**
 * Implements drush_hook_command().
 */
function drush_dashboard_connector_dashboard_send() {
  try {
    $snapshot = Dashboard::snapshotBuilder()->buildSnapshot();
    Dashboard::connector()->sendSnapshot($snapshot);
    \Drupal::logger('dashboard_connector')->info('Successfully sent status snapshot');
  }
  catch (\Exception $e) {
    watchdog_exception('dashboard_connector', $e);
  }
}
