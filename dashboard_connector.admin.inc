<?php

/**
 * @file
 * Admin forms for pnx_dashboard module.
 */

/**
 * Form API callback for the configuration form.
 */
function dashboard_connector_admin() {
  $form = [];

  $form['dashboard_connector_enabled'] = [
    '#title' => t('Enabled'),
    '#description' => t('Enable to send checks to the Dashboard service.'),
    '#type' => 'checkbox',
    '#default_value' => variable_get('dashboard_connector_enabled', FALSE),
  ];
  $form['dashboard_connector_base_uri'] = [
    '#title' => t('Base URI'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_base_uri'),
    '#description' => t('The base URI for the Dashboard API (e.g. https://status.previousnext.com.au/'),
  ];
  $form['dashboard_connector_client_id'] = [
    '#title' => t('Client ID'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_client_id'),
    '#description' => t('The unique client ID for this site (provided by PreviousNext).'),
  ];
  $form['dashboard_connector_site_id'] = [
    '#title' => t('Site ID'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_site_id'),
    '#description' => t('The unique site ID for this site (provided by PreviousNext).'),
  ];

  // Authentication.
  $form['auth'] = [
    '#type' => 'fieldset',
    '#title' => t('Authentication settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['auth']['dashboard_connector_username'] = [
    '#title' => t('Username'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_username'),
    '#description' => t('The username.'),
  ];
  $form['auth']['dashboard_connector_password'] = [
    '#title' => t('Password'),
    '#type' => 'password',
    '#default_value' => variable_get('dashboard_connector_password'),
    '#description' => t('The password.'),
  ];
  return system_settings_form($form);
}
