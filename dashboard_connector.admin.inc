<?php

/**
 * @file
 * Admin forms for pnx_dashboard module.
 */

/**
 * Form API callback for the configuration form.
 */
function dashboard_connector_admin() {
  $form = [
    'dashboard_connector_base_uri' => [
      '#title' => t('Base URI'),
      '#type' => 'textfield',
      '#default_value' => variable_get('dashboard_connector_base_uri'),
      '#description' => t('The base URI for the Dashboard API (e.g. https://status.previousnext.com.au/'),
    ],
    'dashboard_connector_client_id' => [
      '#title' => t('Client ID'),
      '#type' => 'textfield',
      '#default_value' => variable_get('dashboard_connector_client_id'),
      '#description' => t('The unique client ID for this site (provided by PreviousNext).'),
    ],
    'dashboard_connector_site_id' => [
      '#title' => t('Site ID'),
      '#type' => 'textfield',
      '#default_value' => variable_get('dashboard_connector_client_id'),
      '#description' => t('The unique site ID for this site (provided by PreviousNext).'),
    ],
  ];
  return system_settings_form($form);
}
