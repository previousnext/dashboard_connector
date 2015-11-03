<?php

/**
 * @file
 * Admin forms for pnx_dashboard module.
 */

/**
 * Form API callback for the configuration form.
 */
function dashboard_connector_admin() {
  $form = array();

  $form['dashboard_connector_enabled'] = array(
    '#title' => t('Enabled'),
    '#description' => t('Enable to send checks to the Dashboard service.'),
    '#type' => 'checkbox',
    '#default_value' => variable_get('dashboard_connector_enabled', FALSE),
  );
  $form['dashboard_connector_base_uri'] = array(
    '#title' => t('Base URI'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_base_uri'),
    '#description' => t('The base URI for the Dashboard API. Must be a secure (https://) URI.'),
  );
  $form['dashboard_connector_client_id'] = array(
    '#title' => t('Client ID'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_client_id'),
    '#description' => t('The unique client ID for this site (provided by PreviousNext).'),
  );
  $form['dashboard_connector_site_id'] = array(
    '#title' => t('Site ID'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_site_id'),
    '#description' => t('The unique site ID for this site (provided by PreviousNext).'),
  );

  // Authentication.
  $form['auth'] = array(
    '#type' => 'fieldset',
    '#title' => t('Authentication settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['auth']['dashboard_connector_username'] = array(
    '#title' => t('Username'),
    '#type' => 'textfield',
    '#default_value' => variable_get('dashboard_connector_username'),
    '#description' => t('The username.'),
  );
  $form['auth']['dashboard_connector_password'] = array(
    '#title' => t('Password'),
    '#type' => 'password',
    '#description' => t('The password.'),
  );
  $form['#validate'][] = 'dashboard_connector_admin_validate';
  $form['#submit'][] = 'dashboard_connector_admin_submit';
  return system_settings_form($form);
}

/**
 * Form validation handler for dashboard_connector_admin.
 */
function dashboard_connector_admin_validate($form, &$form_state) {
  if (!empty($form_state['values']['dashboard_connector_base_uri']) &&
      stripos($form_state['values']['dashboard_connector_base_uri'], 'https://') === FALSE) {
    form_set_error('dashboard_connector_base_uri', t('Base URI be a secure (https://) URI.'));
  }
}

/**
 * Form submission handler for dashboard_connector_admin.
 */
function dashboard_connector_admin_submit($form, &$form_state) {
  // Ensure whitespace is trimmed.
  $keys = array(
    'dashboard_connector_base_uri',
    'dashboard_connector_client_id',
    'dashboard_connector_site_id',
  );
  foreach ($keys as $key) {
    $form_state['values'][$key] = trim($form_state['values'][$key]);
  }
  // Don't save blank passwords.
  if (empty($form_state['values']['dashboard_connector_password'])) {
    unset($form_state['values']['dashboard_connector_password']);
  }
}
